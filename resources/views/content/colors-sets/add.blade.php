@extends('layouts/contentLayoutMaster')

@section('title', 'Renk Seti Ekle')

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
                        <x-inputs.text-input name="product_name" label="Sıra no"
                            placeholder="" />
                    </div>
                    @php
                    $colors = [
                        [
                            'name' => "Renk 1",
                            'value' => 'color1',
                        ],
                        [
                            'name' => "Renk 2",
                            'value' => 'color2',
                        ],
                    ];
                @endphp
                <div class="mb-1">
                    <x-inputs.select-input :items="$colors" label="Renk Grubu" name="color" />
                </div>
                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Renk Adı"
                            placeholder="" />
                    </div>

                    <div class="mb-1">
                        <x-inputs.text-input name="product_name" label="Renk Kodu Oranı"
                            placeholder="" />
                    </div>

                    <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                </form>
            </div>
        </div>
    </div>
@endsection



@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
