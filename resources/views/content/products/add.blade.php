@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Ekle')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home"
                            aria-expanded="true">Genel Tanımlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#profile"
                            aria-expanded="false">Stok Durumu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#about"
                            aria-expanded="false">Detaylar</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab"
                        aria-expanded="true">
                        <form>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Text Input"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>

                            <div class="mb-1">
                                <x-inputs.email-input name="email_input" label="Email Input"
                                    placeholder="john.doe@gmail.com" />
                            </div>

                            <div class="mb-1">
                                <x-inputs.password-input name="password_input" label="Password Input" />
                            </div>

                            <div class="mb-1">
                                <label for="flatpickr-range" class="form-label">Range Picker</label>
                                <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                    id="flatpickr-range" />
                            </div>
                            @php
                                $sarki = [
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
                                <x-inputs.select-input :items="$sarki" label="Select Input" name="sarki" />
                            </div>

                            <div class="mb-1">
                                <x-inputs.file-input label="File Input" name="file_input" />
                            </div>


                            <div class="mb-1">
                                <label class="d-block form-label">Checkbox Group</label>
                                <div class="form-check my-50">
                                    <input type="radio" id="validationRadiojq1" name="validationRadiojq"
                                        class="form-check-input" />
                                    <label class="form-check-label" for="validationRadiojq1">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="validationRadiojq2" name="validationRadiojq"
                                        class="form-check-input" />
                                    <label class="form-check-label" for="validationRadiojq2">Female</label>
                                </div>
                            </div>

                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="Text Field" rows="6" />
                            </div>

                            <div class="mb-1">
                                <x-inputs.checkbox-input label="Agree to our terms and conditions"
                                    name="terms_and_conditions" />
                            </div>

                            <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Submit" />
                        </form>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        aria-expanded="false">
                        <p>
                            Pudding candy canes sugar plum cookie chocolate cake powder croissant. Carrot cake tiramisu
                            danish candy
                            cake muffin croissant tart dessert. Tiramisu caramels candy canes chocolate cake sweet roll
                            liquorice
                            icing cupcake.Bear claw chocolate chocolate cake jelly-o pudding lemon drops sweet roll sweet
                            candy.
                            Chocolate sweet chocolate bar candy chocolate bar chupa chups gummi bears lemon drops.
                        </p>
                    </div>
                    <div class="tab-pane" id="dropdown1" role="tabpanel" aria-labelledby="dropdown1-tab"
                        aria-expanded="false">
                        <p>
                            Cake croissant lemon drops gummi bears carrot cake biscuit cupcake croissant. Macaroon lemon
                            drops
                            muffin jelly sugar plum chocolate cupcake danish icing. Soufflé tootsie roll lemon drops sweet
                            roll cake
                            icing cookie halvah cupcake.Chupa chups pie jelly pie tootsie roll dragée cookie caramels sugar
                            plum.
                            Jelly oat cake wafer pie cupcake chupa chups jelly-o gingerbread.
                        </p>
                    </div>
                    <div class="tab-pane" id="dropdown2" role="tabpanel" aria-labelledby="dropdown2-tab"
                        aria-expanded="false">
                        <p>
                            Chocolate croissant cupcake croissant jelly donut. Cheesecake toffee apple pie chocolate bar
                            biscuit
                            tart croissant. Lemon drops danish cookie. Oat cake macaroon icing tart lollipop cookie sweet
                            bear claw.
                            Toffee jelly-o pastry cake dessert chocolate bar jelly beans fruitcake. Dragée sweet fruitcake
                            dragée
                            biscuit halvah wafer gingerbread dessert. Gummies fruitcake brownie gummies tart pudding.
                        </p>
                    </div>
                    <div class="tab-pane" id="about" role="tabpanel" aria-labelledby="about-tab"
                        aria-expanded="false">
                        <p>
                            Carrot cake dragée chocolate. Lemon drops ice cream wafer gummies dragée. Chocolate bar
                            liquorice
                            cheesecake cookie chupa chups marshmallow oat cake biscuit. Dessert toffee fruitcake ice cream
                            powder
                            tootsie roll cake.Chocolate bonbon chocolate chocolate cake halvah tootsie roll marshmallow.
                            Brownie
                            chocolate toffee toffee jelly beans bonbon sesame snaps sugar plum candy canes.
                        </p>
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
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
    <script>
        var flatpickrRange = document.querySelector("#flatpickr-range");

        flatpickrRange.flatpickr({
            mode: "range"
        });
    </script>
@endsection
