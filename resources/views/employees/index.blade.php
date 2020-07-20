@extends('adminlte::page')
@extends('layouts.sweetalert')

@section('title', 'Employee Page')

@section('plugins.Datatables', true)

@section('content_header')
    <h5>Employee's Information</h5>
@endsection

@section('css')
    <link href="{{asset('dataTables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables/css/responsive.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
@include('sweetalert::alert')
    <!-- start your content here ... -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <div>
                            <button type="button"
                                    class="btn btn-info"
                                    data-toggle="modal"
                                    data-target="#addModal">Create New Employee's Data
                            </button>
                        </div><br/>

                        <div class="boostrap-modal">
                            <div class="modal face" id="addModal" tabindex="-1" role="dialog" aria-labelled="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Create New Employee's Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body" style="height:300px; width:380px;">
                                            <form class="form-validate" action="{{route('employees.store')}}" method="post">
                                            {{csrf_field()}}
                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Firstname <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="firstname" name="firstname" placeholder="e.g. John" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Lastname <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="lastname" name="lastname" placeholder="e.g. Smith" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                       <select class="form-control is-valid" id="company" name="company">
                                                            <option value="">Please select company name</option>
                                                            @foreach($companies as $company)
                                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                                            @endforeach
                                                       </select>
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="email" class="form-control is-valid" id="email" name="email" placeholder="e.g. company_abc@abc.com" required>
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Phone Number <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="phone" class="form-control is-valid" id="phone" name="phone" placeholder="e.g. (02) 345-4555" required>
                                                    </div>
                                                </div>

                                           
                                        </div>
                                        <div class="modal-footer">
                                            <div class="toastr form-group row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <table id="employee" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                @foreach($employees as $employee)
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href=""
                                               class="btn btn-info"
                                               onclick="editFunction('{{$employee->firstname}}',
                                                                     '{{$employee->lastname}}',
                                                                     '{{$employee->company}}',
                                                                     '{{$employee->email}}',
                                                                     '{{$employee->phone}}',
                                                                      {{$employee->id}});"
                                               data-toggle="modal"
                                               data-target="#editModal">Edit</a>

                                            <a href="{{route('employees.destroy', ['id' => $employee->id])}}" 
                                               onclick="return confirm('Are you sure?')"
                                               class="btn mb-1 btn-danger">Delete</a>
                                            
                                        </td>
                                        <td>{{$employee->firstname}}</td>
                                        <td>{{$employee->lastname}}</td>
                                        <td>{{$employee->companies->name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->phone}}</td>
                                    </tr>
                                </tbody>
                                @endforeach

                                <div class="boostrap-modal">
                                    <div class="modal face" id="editModal" tabindex="-1" role="dialog" aria-labelled="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModallabel">Edit Employee's Information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" style="height:300px; width:400px;">
                                                    <form class="form-validate" action="" method="post" id="updateForm">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-lg-6 col-form-label" for="validateService01">Firstname <span class="text-danger">*</span></label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control is-valid" id="edit_firstname" name="firstname" placeholder="e.g. John" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Lastname <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="edit_lastname" name="lastname" placeholder="e.g. Smith" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                       <select class="form-control is-valid" id="edit_company" name="company">
                                                            <option value="">Please select company name</option>
                                                            @foreach($companies as $company)
                                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                                            @endforeach
                                                       </select>
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="email" class="form-control is-valid" id="edit_email" name="email" placeholder="e.g. company_abc@abc.com" required>
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Phone Number <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="phone" class="form-control is-valid" id="edit_phone" name="phone" placeholder="e.g. (02) 345-4555" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <div class="toastr form-group row">
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script  type="text/javascript">
    $(document).ready(function(){
        var table = $('#employee').DataTable({
            lengthChange: false,
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });

    function editFunction(firstname,lastname,company,email,phone,id)
    {
        document.getElementById('edit_firstname').value = firstname;
        document.getElementById('edit_lastname').value = lastname;
        document.getElementById('edit_company').valaue = company;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone').value = phone;

        document.getElementById('updateForm').action = "employees.update/"+id;
    }
    </script>
@endsection
