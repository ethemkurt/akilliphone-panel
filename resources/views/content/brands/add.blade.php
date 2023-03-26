@extends('layouts/contentLayoutMaster')

@section('title', 'Marka Ekle')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
@endsection

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
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home"
                            aria-expanded="true">Marka Tanımları</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#profile"
                            aria-expanded="false">Seo Tanımları</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab"
                        aria-expanded="true">
                        <form>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Sıra no"
                                    placeholder="" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Marka Kodu"
                                    placeholder="" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Marka Adı"
                                    placeholder="" />
                            </div>
                            @php
                            $amazon = [
                                [
                                    'name' => "I've dug two graves for us my dear",
                                    'value' => 'Revenge - Prasewon',
                                ],
                                [
                                    'name' => "Can't pretend that I was perfect, leavin' you in fear",
                                    'value' => 'Revenge - Prasewon',
                                ],
                                [
                                    'name' => 'Oh, man, what a world, the things I hear',
                                    'value' => 'Revenge - Prasewon',
                                ],
                            ];
                        @endphp
                        <div class="mb-1">
                            <x-inputs.select-input :items="$amazon" label="Üst Marka" name="sarki" />
                        </div>
                        <div class="mb-1" id="full-wrapper">
                            <label class="form-label">Açıklama</label>
                            <div id="full-container">
                              <div class="editor">
                              </div>
                            </div>
                          </div>
                        <div class="mb-1">
                                <label class="d-block form-label">Durumu</label>
                                <div class="form-check my-50">
                                    <input type="radio" id="validationRadiojq1" name="validationRadiojq"
                                        class="form-check-input" checked/>
                                    <label class="form-check-label" for="validationRadiojq1">Aktif</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="validationRadiojq2" name="validationRadiojq"
                                        class="form-check-input" />
                                    <label class="form-check-label" for="validationRadiojq2">Pasif</label>
                                </div>
                        </div>


                            <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                        </form>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        aria-expanded="false">
                        <form>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Sayfa Başlık"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="Anahtar Kelimeler" rows="6" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="Açıklama" rows="6" />
                            </div>
                            <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                        </form>
                    </div>
                </div>
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
