@extends('adminlte::page')
@section('title', 'Employee Page')

@section('content_header')
    <h5>Employee's Information</h5>
@endsection

@section('css')
    <link href="{{asset('dataTables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('dataTables/css/responsive.bootstrap4.min.css')}}" rel="stylesheet">
@endsection


@section('content')
    <!-- start your content here ... -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered zero-configuration">
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
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
    <script>
    $(document).ready(function(){
        var table = $('#example').DataTable({
            lengthChange: false,
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
    </script>
@endsection
