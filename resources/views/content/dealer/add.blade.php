@extends('layouts/contentLayoutMaster')

@section('title', 'Bayi Ekle')

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
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Basic Layout</h5> <small class="text-muted float-end">Default label</small>
      </div>
      <div class="card-body">
        <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home" aria-expanded="true">Üye Bilgileri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#profile" aria-expanded="false"
                >Adres Bilgileri</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#about" aria-expanded="false">Ödeme ve Kargo</a>
            </li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab" aria-expanded="true">
                <form id="jquery-val-form" method="post">
                    <div class="mb-1">
                      <label class="form-label" for="basic-default-name">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-default-name"
                        name="basic-default-name"
                        placeholder="John Doe"
                      />
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-default-email">Email</label>
                      <input
                        type="text"
                        id="basic-default-email"
                        name="basic-default-email"
                        class="form-control"
                        placeholder="john.doe@email.com"
                      />
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-default-password">Password</label>
                      <input
                        type="password"
                        id="basic-default-password"
                        name="basic-default-password"
                        class="form-control"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      />
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="confirm-password">Confirm Password</label>
                      <input
                        type="password"
                        id="confirm-password"
                        name="confirm-password"
                        class="form-control"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      />
                    </div>
                    <div class="mb-1">
                        <label for="flatpickr-range" class="form-label">Range Picker</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" />
                      </div>
                    <div class="mb-1">
                      <label class="form-label" for="select-country">Country</label>
                      <select class="form-select select2" id="select-country" name="select-country">
                        <option value="">Select Country</option>
                        <option value="usa">USA</option>
                        <option value="uk">UK</option>
                        <option value="france">France</option>
                        <option value="australia">Australia</option>
                        <option value="spain">Spain</option>
                      </select>
                    </div>
                    <div class="mb-1">
                      <label for="customFile" class="form-label">Profile pic</label>
                      <input class="form-control" type="file" id="customFile" name="customFile" />
                    </div>
                    <div class="mb-1">
                      <label class="d-block form-label">Gender</label>
                      <div class="form-check my-50">
                        <input type="radio" id="validationRadiojq1" name="validationRadiojq" class="form-check-input" />
                        <label class="form-check-label" for="validationRadiojq1">Male</label>
                      </div>
                      <div class="form-check">
                        <input type="radio" id="validationRadiojq2" name="validationRadiojq" class="form-check-input" />
                        <label class="form-check-label" for="validationRadiojq2">Female</label>
                      </div>
                    </div>
                    <div class="mb-1">
                      <label class="d-block form-label" for="validationBio">Bio</label>
                      <textarea class="form-control" id="validationBio" name="validationBiojq" rows="3"></textarea>
                    </div>
                    <div class="mb-1">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="validationCheck" name="validationCheck" />
                        <label class="form-check-label" for="validationCheck">Agree to our terms and conditions</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                  </form>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
              <p>
                Pudding candy canes sugar plum cookie chocolate cake powder croissant. Carrot cake tiramisu danish candy
                cake muffin croissant tart dessert. Tiramisu caramels candy canes chocolate cake sweet roll liquorice
                icing cupcake.Bear claw chocolate chocolate cake jelly-o pudding lemon drops sweet roll sweet candy.
                Chocolate sweet chocolate bar candy chocolate bar chupa chups gummi bears lemon drops.
              </p>
            </div>
            <div class="tab-pane" id="dropdown1" role="tabpanel" aria-labelledby="dropdown1-tab" aria-expanded="false">
              <p>
                Cake croissant lemon drops gummi bears carrot cake biscuit cupcake croissant. Macaroon lemon drops
                muffin jelly sugar plum chocolate cupcake danish icing. Soufflé tootsie roll lemon drops sweet roll cake
                icing cookie halvah cupcake.Chupa chups pie jelly pie tootsie roll dragée cookie caramels sugar plum.
                Jelly oat cake wafer pie cupcake chupa chups jelly-o gingerbread.
              </p>
            </div>
            <div class="tab-pane" id="dropdown2" role="tabpanel" aria-labelledby="dropdown2-tab" aria-expanded="false">
              <p>
                Chocolate croissant cupcake croissant jelly donut. Cheesecake toffee apple pie chocolate bar biscuit
                tart croissant. Lemon drops danish cookie. Oat cake macaroon icing tart lollipop cookie sweet bear claw.
                Toffee jelly-o pastry cake dessert chocolate bar jelly beans fruitcake. Dragée sweet fruitcake dragée
                biscuit halvah wafer gingerbread dessert. Gummies fruitcake brownie gummies tart pudding.
              </p>
            </div>
            <div class="tab-pane" id="about" role="tabpanel" aria-labelledby="about-tab" aria-expanded="false">
              <p>
                Carrot cake dragée chocolate. Lemon drops ice cream wafer gummies dragée. Chocolate bar liquorice
                cheesecake cookie chupa chups marshmallow oat cake biscuit. Dessert toffee fruitcake ice cream powder
                tootsie roll cake.Chocolate bonbon chocolate chocolate cake halvah tootsie roll marshmallow. Brownie
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
