@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}">{{ __('admin/category.main') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">
                                        {{ __('admin/product.products') }}</a>
                                     
                                </li>
                                <li class="breadcrumb-item active"> {{ __('admin/product.add_product') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{ __('admin/product.add_new_product') }}</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.products.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf



                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>{{ __('admin/product.basic_data_product_form') }}
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  {{ __('admin/product.product_name') }}
                                                            </label>
                                                            <input type="text" id="name" class="form-control"
                                                                placeholder="  " value="{{ old('name') }}" name="name">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('admin/category.slug') }}
                                                            </label>
                                                            <input type="text" class="form-control" placeholder="  "
                                                                value="{{ old('slug') }}" name="slug">
                                                            @error('slug')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('admin/product.product_description') }}
                                                            </label>
                                                            <textarea name="description" id="description" class="form-control" placeholder="  ">{{ old('description') }}</textarea>

                                                            @error('description')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('admin/product.short_description') }}
                                                            </label>
                                                            <textarea name="short_description" id="short-description" class="form-control" placeholder="">{{ old('short_description') }}</textarea>

                                                            @error('short_description')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('admin/product.select_category') }}
                                                            </label>
                                                            <select name="categories[]" class="select2 form-control"
                                                                multiple>
                                                                <optgroup label="{{ __('admin/product.please_select_category') }}">
                                                                    @if ($data['categories'] && $data['categories']->count() > 0)
                                                                        @foreach ($data['categories'] as $category)
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>

                                                            @error('categories.*')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('admin/product.select_tags') }}
                                                            </label>
                                                            <select name="tags[]" class="select2 form-control" multiple>
                                                                <optgroup label="{{ __('admin/product.please_select_tags') }}">
                                                                    @if ($data['tags'] && $data['tags']->count() > 0)
                                                                        @foreach ($data['tags'] as $tag)
                                                                            <option value="{{ $tag->id }}">
                                                                                {{ $tag->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('tags')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('admin/product.select_brand') }}
                                                            </label>
                                                            <select name="brand_id" class="select2 form-control">
                                                                <optgroup label="{{ __('admin/product.please_select_brand') }}">
                                                                    @if ($data['brands'] && $data['brands']->count() > 0)
                                                                        @foreach ($data['brands'] as $brand)
                                                                            <option value="{{ $brand->id }}">
                                                                                {{ $brand->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('brand_id')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="is_active"
                                                                id="switcheryColor4" class="switchery"
                                                                data-color="success" checked />
                                                            <label for="switcheryColor4" class="card-title ml-1">{{ __('admin/category.status') }}
                                                            </label>

                                                            @error('is_active')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                    <i class="ft-x"></i> {{ __('admin/shippingMethod.remove') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>
                                                    {{ __('admin/shippingMethod.save') }}
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop

@section('script')

    <script>
        $('input:radio[name="type"]').change(
            function() {
                if (this.checked && this.value == '2') { // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');

                } else {
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
@stop
