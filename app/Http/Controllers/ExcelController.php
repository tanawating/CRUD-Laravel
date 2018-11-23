<?php

// created by => tanawat.info
// form source code => https://github.com/tanawating

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Excel;
use Log;
use Auth;

class ExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function import(Request $request)
    {
        $check_column = false;
        $file = $request->file('file');

        Excel::load($file, function($reader) use (&$check_column)
        {
            $column = $reader->first()->toArray();

            if (isset($column['prefix']) && isset($column['firstname']) && isset($column['lastname']) && isset($column['sex']) && isset($column['email']) && isset($column['phonenumber'])) 
            {
                $rows = $reader->toArray();

                foreach ($rows as $key => $value) 
                {
                    $member = new member;
                    $member->prefix         = $value['prefix'];
                    $member->firstname      = $value['firstname'];
                    $member->lastname       = $value['lastname'];
                    $member->sex            = $value['sex'];
                    $member->email          = $value['email'];
                    $member->phonenumber    = $value['phonenumber'];
                    $member->created_by     = Auth::id();
                    $member->created_date   = date('Y-m-d H:i:s');
                    $member->save();
                }   
                $check_column = true;
            }
            
        });

        if ($check_column) 
        {
            return response(['response' => 'success']);
        }
        else
        {
            return response(['response' => 'fail']);
        }
    }

    public function export()
    {
        $query  = Member::orderBy('id','DESC')->get();
        $result = array();

        foreach ($query as $key => $value) 
        {
            $return_array['fullname']     = $value->prefix.' '.$value->firstname.' '.$value->lastname;
            $return_array['email']        = $value->email;
            $return_array['phonenumber']  = $value->phonenumber;
            array_push($result,$return_array);
        }

        $result = json_decode(json_encode($result), FALSE);
        Excel::create('Report Members', function($excel) use ($result) 
        {
            $excel->sheet('List Members', function($sheet) use ($result) 
            {
                $sheet->loadView('excel',array
                (
                    'result' => $result
                ));
            });
        })->download('xlsx');
    }

    public function download()
    {
        return response()->download(storage_path('files/template.xlsx'));
    }
}
