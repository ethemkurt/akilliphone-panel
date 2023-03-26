@extends('layouts/contentLayoutMaster')

@section('title', 'Yetki Ekle')

@section('vendor-style')
    {{-- Vendor Css files --}}
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <form>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Yetki Kodu"
                            placeholder="" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Yetki Adı"
                            placeholder="" />
                    </div>
                    <div class="form-check mt-1">
                        <input name="default-radio-1" class="form-check-input" type="radio" value=""
                            id="active" checked />
                        <label class="form-check-label" for="active">
                            Aktif
                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input name="default-radio-1" class="form-check-input" type="radio" value=""
                            id="passive" />
                        <label class="form-check-label" for="passive">
                            Pasif
                        </label>
                    </div>
                    <x-button type="submit" buttonType="primary mt-1" value="Submit" name="submit" label="Kaydet" />
                </form>
            </div>
        </div>
    </div>
@endsection



@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
