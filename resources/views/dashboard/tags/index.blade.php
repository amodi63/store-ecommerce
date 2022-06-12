
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin/tag.tags')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin/category.main')}}</a>
                                </li>
                                <li class="breadcrumb-item active">  {{__('admin/tag.tags')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('admin/tag.all_tags')}}</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>id </th>
                                                <th>{{__('admin/tag.name')}} </th>
                                                <th>{{__('admin/category.slug')}}</th>
                                                <th>{{__('admin/category.measures')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($tags)
                                                @foreach ($tags as $tag)
                                                <tr>
                                                    <td>{{$tag->id}}</td>
                                                    <td>{{$tag->name}}</td>
                                                    <td>{{$tag->slug}}</td>

                                                    <td>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic example">
                                                            <a href="{{route('admin.tags.edit',[ $tag -> id])}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\category.edit')}}</a>
                                                            <form action="{{route('admin.tags.destroy', [$tag->id])}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{__('admin\category.delete')}}</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    @stop
