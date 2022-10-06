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
                                <li class="breadcrumb-item active"> {{ __('admin/product.images') }}
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
                                    <h4 class="card-title" id="basic-layout-form">
                                        {{ __('admin/product.add_images') }} </h4>
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
                                        <form class="form" action="{{ route('admin.products.images.store.db') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="product_id", value="{{ $product->id }}">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>
                                                    {{ __('admin/product.about_images') }} </h4>


                                                <div class="form-group" style="margin-bottom: -0.5rem;">
                                                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                        <div class="dz-message">{{ __('admin/product.drop_to_upload') }}
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                </div>
                                                @error('documents')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="form-actions" style="padding: 20px">
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
            <div class="card">
                <div class="card-content collapse show">    
                    <div class="card-body">
                        <div class="card-text">
                            <p>{{ __('admin/slider.current_imgs') }}.</p>
                        </div>
                    </div>
                    <div class="card-body  my-gallery" itemscope="" itemtype="http://schema.org/ImageGallery"
                        data-pswp-uid="1">
                        <div class="row">
                            @isset($product->images)
                                @forelse($product->images as $img )
                                    <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope=""
                                        itemtype="http://schema.org/ImageObject">
                                        <a href="{{  $product->getPhotoAttr($img->photo) }}" itemprop="contentUrl" data-size="480x360">
                                            <img class="img-thumbnail img-fluid" src="{{  $product->getPhotoAttr($img->photo) }}" itemprop="thumbnail"
                                                alt="Image description">
                                        </a>
                                        <figcaption >
                                            <form method="POST"
                                                            action="{{ route('admin.products.images.destroy', [$img->product_id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <input type="hidden" name="id"
                                                                value="{{ $img->id }}">
                                                            <div class="form-group d-flex">
                                                                <input type="submit" class="btn btn-danger" style='margin:15px auto;'
                                                                    style="margin:6% 0  0 25%;padding: 8px 20px;"
                                                                    value="{{ __('admin/product.delete') }}">
                                                            </div>
                                            </form>
                                        </figcaption>
                                    </figure>
                                @empty
                                {{ __('admin/slider.no_pic') }}
                                @endforelse
                            @endisset
                        </div>

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
@section('style')
<style>
    img.img-thumbnail.img-fluid {
        width:261px;
        height: 261px;
    }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/file-uploaders/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/file-uploaders/dropzone.min.css') }}">
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/scripts/extensions/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        var uploadedDocumentMap = {};
        Dropzone.options.dpzMultipleFiles = {
            paramName: "dzfile", // The name that will be used to transfer the file
            // autoProcessQueue: false,
            // uploadMultiple: true,    
            maxFilesize: 5, // MB
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            dictFallbackMessage: "{{ __('admin/product.browser_support_msg') }}",
            dictInvalidFileType: "{{ __('admin/product.file_type_msg') }}",
            dictCancelUpload: "{{ __('admin/product.cancel_upload') }}",
            dictCancelUploadConfirmation: "{{ __('admin/product.confirm_cancle_upload') }}",
            dictRemoveFile: "{{__('admin/product.delete_image')}}",
            dictMaxFilesExceeded: "{{ __('admin/product.cant_upload_more') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "{{ route('admin.products.images.store') }}", // Set the url


            success: function(file, response) {
                $('form').append('<input type="hidden" name="documents[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name

            },
            removedfile: function(file) {
                file.previewElement.remove();
                file.removeLink;
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="documents[]"][value="' + name + '"]').remove()
            },
            // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
            init: function() {
                @if (isset($event) && $event->document)
                    var files =
                        {!! json_encode($event->document) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="documents[]" value="' + file.file_name + '">')
                    }
                @endif
            }
        }
    </script>
@stop

                                                