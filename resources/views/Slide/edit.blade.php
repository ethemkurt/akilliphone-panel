
@extends('layouts/contentLayoutMaster')

@section('title', 'Slayt Resimleri')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ url('vendors/css/extensions/ext-component-drag-drop.css') }}?_v={{ env('ASSETS_VER') }}">
    <link rel="stylesheet" type="{{ url('vendors/css/file-uploaders/dropzone.min.css') }}">
    <style>
        .slide-image{
            border-bottom: 1px solid #cdcdcd;
        }
        .slide-image:hover{
            background-color: #f1f1f1;
        }
        .image-upload.large{

        }
        .image-upload.small{
            width: 100px;
            height: 100px;
        }
    </style>
@endsection

@section('content')
    <section class="form-control-repeater">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <div class="invoice-repeater">
                                <div id="slide-images" data-repeater-list="images">
                                    <div style="display: none">
                                        <div data-repeater-item class="slide-image p-2 ">
                                            <div class="row d-flex">
                                                <div class="col-md-1">
                                                    <label class="form-label" >Sıra</label>
                                                    <input type="text" name="images[sortOrder][]"  value="1" class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="col-12">
                                                        <div class="image-upload large" >
                                                            <input type="text" name="slide[desktopImage][]" value="">
                                                            <input type="hidden" name="slide[desktopImageFile][]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-1">
                                                        <div class="image-upload small">
                                                            <input type="text" name="slide[mobileImage][]" value="">
                                                            <input type="hidden" name="slide[mobileImageFile][]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" >Arkaplan Rengi</label>
                                                        <input type="text" name="images[bgColor][]" data-jscolor="" value="" class="form-control" />
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" >Açıklama</label>
                                                        <input type="text" name="images[title][]" value="" class="form-control" />
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" >Link</label>
                                                        <input type="text" name="images[slug][]" value="" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="mb-1">
                                                        <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($slide)
                                        @if($slide['images'])
                                            @foreach($slide['images'] as $image)
                                                <div data-repeater-item class="slide-image p-2 ">
                                                    <div class="row d-flex">
                                                        <div class="col-md-1">
                                                            <label class="form-label" >Sıra</label>
                                                            <input type="text" name="images[sortOrder][]"  value="{{ $image->sortOrder }}" class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-12">
                                                                <div class="image-upload large"  style="background-image: url({{ _CdnImageUrl($image->desktopImage) }}); background-color: {{ $image->bgColor }} ">
                                                                    <input type="text" name="slide[desktopImage][]" value="{{ $image->desktopImage }}" style="display: none">
                                                                    <input type="hidden" name="slide[desktopImageFile][]" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-1">
                                                                <div class="image-upload small" style="background-image: url({{ _CdnImageUrl($image->mobileImage) }}) ">
                                                                    <input type="text" name="slide[mobileImage][]" value="{{ $image->mobileImage }}" style="display: none">
                                                                    <input type="hidden" name="slide[mobileImageFile][]" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="col-12 mb-1">
                                                                <label class="form-label" >Arkaplan Rengi</label>
                                                                <input type="text" name="images[bgColor][]" data-jscolor="" value="{{ $image->bgColor }}" class="form-control" />
                                                            </div>
                                                            <div class="col-12 mb-1">
                                                                <label class="form-label" >Açıklama</label>
                                                                <input type="text" name="images[title][]" value="{{ $image->title }}" class="form-control" />
                                                            </div>
                                                            <div class="col-12 mb-1">
                                                                <label class="form-label" >Link</label>
                                                                <input type="text" name="images[slug][]" value="{{ $image->slug }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="mb-1">
                                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button  class="btn btn-icon btn-primary btn-repeater" type="button" data-repeater-create>
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button  class="btn btn-icon btn-info" type="submit">
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Invoice repeater -->
        </div>
    </section>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
@endsection

@section('page-script')
    <script src="{{ url('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{asset('vendors/js/file-uploaders/dropzone.min.js')}}"></script>
    <script src="{{asset('vendors/js/jscolor/jscolor.min.js')}}"></script>
    <script>
        Dropzone.autoDiscover = false;
            $('.invoice-repeater, .repeater-default').repeater({
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({ width: 14, height: 14 });
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
            var singleFile = $('#dpz-single-file');
            singleFile.dropzone({
                paramName: 'file', // The name that will be used to transfer the file
                maxFiles: 1
            });
    </script>
    <script>
        TulparUploader.createUploder();
        $('.btn-repeater').on('click', function (){
            TulparUploader.createUploder();
            jscolor.install();
        })
        $('body').on('change', '.form-control.jscolor', function () {
            let elem = $(this).parents('.slide-image').find('.image-upload.large');
            console.log( elem);
            if(elem.length){
                elem.css('background-color', $(this).val());
            }
        })
    </script>

@endsection
