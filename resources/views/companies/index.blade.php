@extends('adminlte::page')
@extends('layouts.sweetalert')

@section('title', 'Company Page')

@section('content_header')
    <h5>Compay's Information</h5>
@endsection

@section('css')
    <link href="{{asset('dataTables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables/css/responsive.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
@include('sweetalert::alert')
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
                                    data-target="#addModal">Create New Company's Detail
                            </button>
                        </div><br/>

                        <div class="bootstrap-modal">
                            <div class="modal face" id="addModal" tabindex="-1" role="dialog" aria-labelled="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel"></h5>Create New Company's Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                                        </div>

                                        <div class="modal-body" style="height:450px; width:380px;">
                                            <form class="form-validate" action="{{route('companies.store')}}" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="company_name" name="company_name" placeholder="e.g. ABCCompany" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="company_email" name="company_email" placeholder="e.g. ABCCompany@company.com" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Logo <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <img id="logo"
                                                             class="img-responsive circle img-thumbnail"
                                                             src="/images/default.png"
                                                             style="width:150px;height:150px;border-radius:50%;"><br/>
                                                        <input id="files"
                                                               type="file"
                                                               class="form-control"
                                                               onchange="document.getElementById('logo').src=window.URL.createObjectURL(this.files[0])"
                                                               name="company_logo">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Website <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="company_website" name="company_website" placeholder="e.g. www.companyabc.com" required>
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

                            <table id="company" class="table table-striped table-bordered zero-configurations">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Company Name</th>
                                        <th>Company Email</th>
                                        <th>Company Logo</th>
                                        <th>Company Website</th>
                                    </tr>
                                </thead>
                                @foreach($companies as $company)
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href=""
                                               class="btn btn-info"
                                               onclick="editFunction('{{$company->name}}',
                                                                     '{{$company->email}}',
                                                                     '{{$company->logo}}',
                                                                     '{{$company->website}}',
                                                                      {{$company->id}});"
                                               data-toggle="modal"
                                               data-target="#editModal">Edit</a>

                                            <a href="{{route('companies.destroy', ['id' => $company->id])}}" 
                                               onclick="return confirm('Are you sure?')"
                                               class="btn mb-1 btn-danger">Delete</a>
                                        </td>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->email}}</td>
                                        <td><center><img src="{{asset('/storage/'.$company->logo)}}" 
                                                         style="width:80px;height:80px;border-radius: 50%;" 
                                                         id="edit_image"></center></td>
                                        <td>{{$company->website}}</td>
                                    </tr>
                                </tbody>
                                @endforeach

                                <div class="bootstrap-modal">
                                    <div class="modal face" id="editModal" tabindex="-1" role="dialog" aria-labelelled="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModallabel">Edit Company's Detail</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" style="height:450px; width:400px;">
                                                    <form class="form-validate" action="" method="post" id="updateForm">
                                                    @method('put')
                                                    @csrf 
                                                    
                                                    <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="edit_company_name" name="company_name" placeholder="e.g. ABCCompany" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="edit_company_email" name="company_email" placeholder="e.g. ABCCompany@company.com" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Logo <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <img id="logo"
                                                             class="img-responsive circle img-thumbnail"
                                                             src="/images/default.png"
                                                             style="width:150px;height:150px;border-radius:50%;"><br/>
                                                        <input id="files"
                                                               type="file"
                                                               class="form-control"
                                                               onchange="document.getElementById('logo').src=window.URL.createObjectURL(this.files[0])"
                                                               name="edit_company_logo">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-6 col-form-label" for="validateService01">Company Website <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control is-valid" id="edit_company_website" name="company_website" placeholder="e.g. www.companyabc.com" required>
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
    </div>

@endsection

@section('script')
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="{{asset('dataTables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dataTables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dataTables/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dataTables/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dataTables/js/jszip.min.js')}}"></script>
    <script src="{{asset('dataTables/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('dataTables/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('dataTables/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('dataTables/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('dataTables/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('dataTables/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dataTables/js/responsive.bootstrap4.min.js')}}"></script>

    <script  type="text/javascript">
    $(document).ready(function(){
        var table = $('#company').DataTable({
            lengthChange: false,
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });

    function editFunction(name,email,logo,website,id)
    {
        document.getElementById('edit_company_name').value = name;
        document.getElementById('edit_company_email').value = email;
        document.getElementById('edit_company_logo').valaue = logo;
        document.getElementById('edit_company_website').value = website;

        document.getElementById('updateForm').action = "companies.update/"+id;
    }
    </script>
@endsection