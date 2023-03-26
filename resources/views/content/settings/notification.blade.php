@extends('layouts/contentLayoutMaster')

@section('title', 'Push Notification Ayarları')

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
                        <x-inputs.text-field name="product_name" label="Mesaj"
                            rows="2" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-field name="product_name" label="Mesaj 2"
                            rows="2" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Geridönüş URL'si"
                            placeholder="https://api.akilliphone.com" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Resim Boyutu (Genişlik)"
                            placeholder="120" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Resim Boyutu (Uzunluk)"
                            placeholder="120" />
                    </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Çekilecek Ürün Limiti"
                            placeholder="30" />
                    </div>
                    <div class="mb-1">
                        <label class="form-check-label">Yayın Kodunu Değiştir</label>
                        <x-inputs.checkbox-input label="Evet" name="stream_code" />
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
