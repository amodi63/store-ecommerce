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
                                <li class="breadcrumb-item active"> {{ __('admin/product.product_stock') }}
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
                                {{-- <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">
                                        {{ __('admin/category.add_main_category') }} </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                                
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.products.stock.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id", value="{{ $product->id }}">

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>
                                                    {{ __('admin/product.about_inventory') }} </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sku"> {{ __('admin/product.sku') }}
                                                            </label>
                                                            <input type="text" id="sku" class="form-control"
                                                                placeholder="" value="{{ old('sku', $product->sku) }}" name="sku">
                                                            @error('sku')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">
                                                                {{ __('admin/product.manage_stock') }}
                                                            </label>
                                                            <select name="manage_stock"  class="select2 form-control"
                                                                id="selectId">
                                                                <optgroup label="{{ __('admin/product.please_select') }}">
                                                                    <option value=""></option> 
                                                                    <option value="1"  >{{ __('admin/product.yes') }}
                                                                    </option>
                                                                    <option value="0"  selected>{{ __('admin/product.no') }}
                                                                    </option>
                                                                </optgroup>
                                                            </select>
                                                            @error('manage_stock')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row hidden" id="qtyRow">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="qty">
                                                                {{ __('admin/product.qty') }}
                                                            </label>
                                                            <input type="number" class="form-control" placeholder=""
                                                                value="{{ old('qty', $product->qty) }}" name="qty" id="qty">
                                                            @error('qty')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="in_stock"
                                                                id="switcheryColor4" class="switchery" data-color="success"
                                                               @if ($product->in_stock == 1) checked @endif />
                                                            <label for="switcheryColor4"
                                                                class="card-title ml-1">{{ __('admin/product.in_stock') }}
                                                            </label>

                                                            @error('in_stock')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @error('is_active')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-actions" style="padding:20px">
                                        <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
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
        // $('option:checked[name="yes"]').change(
        //     function() {
        //         if (this.checked && this.value == '2') { // 1 if main cat - 2 if sub cat
        //             $('#cats_list').removeClass('hidden');

        //         } else {
        //             $('#cats_list').addClass('hidden');
        //         }
        //     });
        $('#selectId').on('change', function() {
            var selectVal = $("#selectId option:selected").val();
             console.log(selectVal);
            if (selectVal ==1) {
                $('#qtyRow').removeClass('hidden');
            } else {
                $('#qtyRow').addClass('hidden');
            }
        });
    </script>
@stop
