@extends('layouts.admin')
@section('content')
    <!-- users list start -->
    <div class="container " style="margin-left: 20% !important;">
        <div class="row">
            <div class="col-12">
                <div class="content-body">
                
                    <table class="table table-striped"  >
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- users list ends -->
@endsection
@section('style')
    <link rel="stylesheet"
        href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/app-assets/css/pages/page-users.min.css">
    {{-- <script src="{{asset('assets/admin/js/scripts/pages/users.min.js')}}" type="text/javascript"></script> --}}
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/scripts/pages/users.min.js') }}" type="text/javascript"></script>
@endsection
