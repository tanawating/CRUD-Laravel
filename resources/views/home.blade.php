<!-- created by => tanawat.info -->
<!-- form source code => https://github.com/tanawating -->

@extends('layouts.master')

@section('content')
<style type="text/css">

    .input-error{
        border: 2px solid #dc3545;
        border-radius: 4px;
    }

    .input-success{
        border: 2px solid  #28a745;
        border-radius: 4px;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <b>Manage Members</b>
                        </div>
                        <div class="col-6" align="right">
                            <button class="btn btn-sm btn-primary" id="btn_add" data-toggle="modal" data-target="#modal"><i class="fas fa-user-plus"></i> Add Member</button>
                        </div>
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <input type="hidden" id="type" value="add">
                                    <input type="hidden" id="id_member">
                                    <div class="modal-body">
                                        <div class="row form-group">
                                            <input type="hidden" id="type" value="add">
                                            <div class="col-md-2" align="right">
                                                <p>Prefix :</p>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" id="prefix">
                                                    <option value=""></option>
                                                    <option value="นาย">นาย</option>
                                                    <option value="นาง">นาง</option>
                                                    <option value="นางสาว">นางสาว</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2" align="right">
                                                <p>Sex :</p>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" id="sex">
                                                    <option value=""></option>
                                                    <option value="ชาย">ชาย</option>
                                                    <option value="หญิง">หญิง</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-2" align="right">
                                                <p>Firstname :</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="firstname">
                                            </div>
                                            <div class="col-md-2" align="right">
                                                <p>Lastname :</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="lastname">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-2" align="right">
                                                <p>Email :</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="email">
                                            </div>
                                            <div class="col-md-2" align="right">
                                                <p>Phone :</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="phonenumber">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btn_save"><i class="fas fa-save"></i> Save</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Sex</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script type="text/javascript">

        var Table = $('#table').DataTable({
            "targets": 'no-sort',
            "bSort": false,
            "order": [],
            "searching": false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! URL::to("member/getData") !!}',
                method: 'POST',
                data: function(d) 
                {
                    d._token         =      "{{ csrf_token() }}";
                    // d.name_news      =      $('#name').val();
                }
            },
            columns: [
                        { data: function(a,b,c,d){ return (Table.page.info().start+d.row+1); } , name: 'id' },
                        { data: 'full_name'      ,   name: 'full_name'    },
                        { data: 'sex'            ,   name: 'sex'          },
                        { data: 'email'          ,   name: 'email'        },
                        { data: 'phonenumber'    ,   name: 'phonenumber'  },
                        { data: 'action'         ,   name: 'action'       },
                    ],
        });

        $('#btn_add').click(function(e) 
        {
            $('.modal-title').text('Add member');
            $('#type').val('add');
            reset_input();
        });

        $('#btn_save').click(function(e) 
        {
            var check_validate = validate($('#prefix').val(),$('#sex').val(), $('#firstname').val(),$('#lastname').val());

            if(check_validate)
            {
                var url         = ($('#type').val() == 'add' ? "{!! URL::to('member/create') !!}" : "{!! URL::to('member/update') !!}")
                var text_alert  = ($('#type').val() == 'add' ? "Add member complete" : "Edit member complete")

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { 
                            _token      : "{{ csrf_token() }}",
                            id          : $('#id_member').val(),
                            prefix      : $('#prefix').val(),
                            sex         : $('#sex').val(),
                            firstname   : $('#firstname').val(),
                            lastname    : $('#lastname').val(),
                            email       : $('#email').val(),
                            phonenumber : $('#phonenumber').val(),
                        },
                })
                .done(function(response) 
                {
                    if (response.result == 'success') 
                    {
                        $('#modal').modal('hide')
                        reset_input();
                        swal({
                                title: "Success!",
                                text : text_alert,
                                type : "success",
                            }).then(function()
                            {
                                Table.draw();
                            });
                    }
                });
            }
        });

        function btn_edit(id)
        {
            $('.modal-title').text('Edit member');
            $('#type').val('edit');
            $.ajax({
                url: '{!! URL::to("member/edit") !!}/'+id,
                type: 'GET',
            })
            .done(function(response) 
            {   
                reset_input();
                $('#id_member').val(response.result.id)
                $('#prefix').val(response.result.prefix)
                $('#sex').val(response.result.sex)
                $('#firstname').val(response.result.firstname)
                $('#lastname').val(response.result.lastname)
                $('#email').val(response.result.email)
                $('#phonenumber').val(response.result.phonenumber)
                $('#modal').modal('show')
            });
        }

        function btn_delete(id)
        {
            swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {

                                            $.ajax({
                                                url: '{!! URL::to("member/delete") !!}/'+id,
                                                type: 'GET',
                                            })
                                            .done(function()
                                            {
                                                swal(
                                                  'Deleted!',
                                                  'Member has been deleted.',
                                                  'success'
                                                ).then(function()
                                                {
                                                    Table.draw();
                                                });
                                            })   
                        }
                    })
        }

    </script>

@endsection