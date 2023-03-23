@extends('layouts/contentLayoutMaster')

@section('title', 'Genel Ayarlar')

@section('vendor-style')
  {{-- Vendor Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<div class="col-xl">
    <div class="card mb-4">
      <div class="card-body">

        <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home" aria-expanded="true">Genel Ayarlar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#profile" aria-expanded="false">Bölgesel Ayarlar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#about" aria-expanded="false">Kargo Genel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#about" aria-expanded="false">Ups Kargo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#about" aria-expanded="false">Yurtiçi Kargo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#about" aria-expanded="false">Yango</a>
              </li>
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab" aria-expanded="true">
                {{-- <form id="jquery-val-form" method="post">
                    <div class="mb-1">
                      <label class="form-label">Firma Adı</label>
                      <input
                        type="text"
                        class="form-control"
                        id="company-name"
                        name="basic-default-name"
                      />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Firma Resmi Adı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="company-name"
                          name="basic-default-name"
                        />
                      </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-email">Site Adresi</label>
                        <input
                          type="text"
                          id="basic-default-name"
                          name="basic-default-name"
                          class="form-control"
                        />
                      </div>
                      <div class="mb-1">
                        <label class="form-label">Yetkili Kişi</label>
                        <input
                          type="text"
                          id="basic-default-name"
                          name="basic-default-name"
                          class="form-control"
                        />
                      </div>
                    <div class="mb-1">
                      <label class="form-label" for="select-country">Country</label>
                      <select class="form-select select2" id="select-country" name="select-country">
                        <option value="">Tema Seçiniz</option>
                        <option value="usa">Tema 1</option>
                      </select>
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
                  </form> --}}
                  <form class="needs-validation" novalidate>
                    <div class="mb-1">
                      <label class="form-label" for="company-name">Firma Adı</label>
                      <input
                        type="text"
                        id="company-name"
                        class="form-control"
                        aria-label="Name"
                        aria-describedby="company-name"
                        required
                      />
                      <div class="valid-feedback">Looks good!</div>
                      <div class="invalid-feedback">Firma adını giriniz.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="company-name">Firma Resmi Adı</label>
                        <input
                          type="text"
                          id="company-official-name"
                          class="form-control"
                          aria-label="Name"
                          aria-describedby="company-official-name"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Firma resmi adını giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="site-name">Site adresi</label>
                        <input
                          type="text"
                          id="site-name"
                          class="form-control"
                          aria-label="Name"
                          aria-describedby="site-name"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Site adresini giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="person-in-charge">Yetkili kişi</label>
                        <input
                          type="text"
                          id="person-in-charge"
                          class="form-control"
                          aria-label="Name"
                          aria-describedby="person-in-charge"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Yetkili kişi giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="phone-1">Telefon-1</label>
                        <input
                          type="text"
                          id="phone-1"
                          class="form-control"
                          aria-label="Name"
                          aria-describedby="phone-1"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Telefon numarası giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="phone-2">Telefon-2</label>
                        <input
                          type="text"
                          id="phone-2"
                          class="form-control"
                          aria-label="Name"
                          aria-describedby="phone-2"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">2.Telefon numarası giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="fax">Faks</label>
                        <input
                          type="text"
                          id="fax"
                          class="form-control"
                          aria-label="Name"
                          aria-describedby="fax"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Faks numarası giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control" aria-label="email" required />
                        <div class="valid-feedback"> Looks good! </div>
                        <div class="invalid-feedback">Email adresi giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="d-block form-label" for="address">Adres</label>
                        <textarea
                          class="form-control"
                          id="address"
                          name="address"
                          rows="3"
                          required
                        ></textarea>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="tax-office">Vergi Dairesi</label>
                        <input
                          type="text"
                          id="tax-office"
                          class="form-control"
                          aria-label="tax-office"
                          aria-describedby="tax-office"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Vergi dairesini giriniz.</div>
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="tax-no">Vergi No</label>
                        <input
                          type="text"
                          id="tax-no"
                          class="form-control"
                          aria-label="tax-no"
                          aria-describedby="tax-no"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Vergi numarası giriniz.</div>
                      </div>
                    <div class="mb-1">
                      <label class="form-label" for="select-theme">Tema Seçeneği</label>
                      <select class="form-select" id="select-theme" required>
                        <option value="">Tema seçin</option>
                        <option value="usa">Tema 1</option>
                      </select>
                      <div class="valid-feedback">Looks good!</div>
                      <div class="invalid-feedback">Tema seçiniz.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
  <script>
    var bsValidationForms = document.querySelectorAll(".needs-validation");

// Loop over them and prevent submission
Array.prototype.slice.call(bsValidationForms).forEach(function(form) {
  form.addEventListener(
    "submit",
    function(event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      } else {
        // Submit your form
        alert("Submitted!!!");
      }

      form.classList.add("was-validated");
    },
    false
  );
});
  </script>
@endsection
