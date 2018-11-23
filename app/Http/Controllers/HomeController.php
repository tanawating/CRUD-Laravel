<?php

// created by => tanawat.info
// form source code => https://github.com/tanawating

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use DataTables;
use Log;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function edit($id)
    {
        $data = Member::where('id',$id)->first();

        return response()->json(['result' => $data]);
    }

    public function create(Request $request)
    {
        $member = new member;
        $member->prefix         = $request->prefix;
        $member->firstname      = $request->firstname;
        $member->lastname       = $request->lastname;
        $member->sex            = $request->sex;
        $member->email          = $request->email;
        $member->phonenumber    = $request->phonenumber;
        $member->created_by     = Auth::id();
        $member->created_date   = date('Y-m-d H:i:s');
        $member->save();

        return response()->json(['result' => 'success']);
    }

    public function update(Request $request)
    {
        Member::where('id',$request->id)
              ->update([
                            'prefix'        => $request->prefix,
                            'firstname'     => $request->firstname,
                            'lastname'      => $request->lastname,
                            'sex'           => $request->sex,
                            'email'         => $request->email,
                            'phonenumber'   => $request->phonenumber,
                            'updated_by'    => Auth::id(),
                            'updated_date'  => date('Y-m-d H:i:s'),
                       ]);

        return response()->json(['result' => 'success']);
    }

    public function delete($id)
    {
        $member = Member::where('id',$id);

        $member->update([
                            'deleted_by'    => Auth::id(),
                            'deleted_date'  => date('Y-m-d H:i:s'),
                        ]);

        $member->delete();

        return response()->json(['result' => 'success']);
    }

    public function getData(Request $request)
    {
        $data = Member::orderBy('id','DESC');

        return Datatables::of($data)

        ->filter(function($data) use ($request) 
        {
            // if ($request->has('name')) 
            // {
            //     $data->where('name', 'like', '%'.$request->get('name').'%');
            // }
        })
        ->addColumn('full_name', function ($data)
        {
            return $data->prefix.' '.$data->firstname.' '.$data->lastname;
        })
        ->addColumn('action', function ($data)
        {
            return '<a href="#" role="button" onclick="btn_edit('.$data->id.')" class="btn btn-outline-dark btn-sm"><i class="fas fa-pencil-alt s-button-table"></i></a>
                    <a href="#" role="button" onclick="btn_delete('.$data->id.')" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt s-button-table"></i></a>';
        })

        ->rawColumns(['address_full','action'])
        ->make(true);
    }
}
