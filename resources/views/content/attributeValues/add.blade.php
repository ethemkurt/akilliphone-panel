@extends('layouts/contentLayoutMaster')

@section('title', 'Özellik Değeri Ekle')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
@endsection

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <form>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Sıra no" placeholder="" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Özellik Adı" placeholder="" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Anahtar Kelimeler" placeholder="" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-field name="product_name" label="Açıklama" rows="3" />
                    </div>

                    <x-button type="submit" buttonType="primary mt-3" value="Submit" name="submit" label="Kaydet" />
                </form>
            </div>
        </div>
    </div>
@endsection



@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js')) }}"></script>
    <script>
        var flatpickrRange = document.querySelector("#flatpickr-range");

        flatpickrRange.flatpickr({
            mode: "range"
        });
    </script>
@endsection
