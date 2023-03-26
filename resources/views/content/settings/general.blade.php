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
              <a class="nav-link" id="localeSettings-tab" data-bs-toggle="pill" href="#localeSettings" aria-expanded="false">Bölgesel Ayarlar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="cargo-tab" data-bs-toggle="pill" href="#cargo" aria-expanded="false">Kargo Genel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ups-tab" data-bs-toggle="pill" href="#ups" aria-expanded="false">Ups Kargo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="yurtici-tab" data-bs-toggle="pill" href="#yurtici" aria-expanded="false">Yurtiçi Kargo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="yango-tab" data-bs-toggle="pill" href="#yango" aria-expanded="false">Yango</a>
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
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                  </form>
            </div>
            <div class="tab-pane" id="localeSettings" role="tabpanel" aria-labelledby="localeSettings-tab" aria-expanded="false">
                <form class="needs-validation" novalidate>
                    <div class="mb-1">
                        <label class="form-label" for="select-theme">Dil Seçeneği</label>
                        <select class="form-select" id="select-theme" required>
                          <option value="tr">Türkçe</option>
                          <option value="en">İngilizce</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Dil seçiniz.</div>
                      </div>

                    <div class="mb-1">
                        <label class="form-label" for="select-theme">Para Birimi</label>
                        <select class="form-select" id="select-theme" required>
                          <option value="tl">TL</option>
                          <option value="usd">USD</option>
                          <option value="eur">EUR</option>
                        </select>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Tema seçiniz.</div>
                      </div>
                    <div class="mb-1">
                      <label class="form-label" for="company-name">Sabit Kur</label>
                      <input
                        type="text"
                        id="company-name"
                        class="form-control"
                        aria-label="Name"
                        aria-describedby="company-name"
                        required
                      />
                      <div class="valid-feedback">Looks good!</div>
                      <div class="invalid-feedback">Sabir kur giriniz.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="company-name">Ziyaretçi Fiyat Katsayısı</label>
                        <input
                          type="text"
                          id="company-official-name"
                          class="form-control"
                          aria-label="Name"
                          aria-describedby="company-official-name"
                          required
                        />
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                      </div>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                  </form>
            </div>
            <div class="tab-pane" id="cargo" role="tabpanel" aria-labelledby="cargo-tab" aria-expanded="false">
              <form class="needs-validation" novalidate>
                <div class="mb-1">
                    <label class="form-label" for="select-theme">Ürün Sayfasında Kargoya Verilme Uyarısı</label>
                    <select class="form-select" id="select-theme" required>
                      <option value="1">Evet</option>
                      <option value="0">Hayır</option>
                    </select>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Dil seçiniz.</div>
                  </div>
                <div class="mb-1">
                    <label class="form-label" for="company-name">Sabit Kargo Ücreti</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Düşük Sepet) </label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Yüksek Sepet) </label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Kapıda Ödeme Kargo İndirim Barajı</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı (Pazartesi)</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı (Salı)</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı (Çarşamba)</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı (Perşembe)</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı (Cuma)</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı (Cumartesi)</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="company-name">Ücretsiz Kargo Sınırı (Pazar)</label>
                    <input
                      type="text"
                      id="company-official-name"
                      class="form-control"
                      aria-label="Name"
                      aria-describedby="company-official-name"
                      required
                    />
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                  </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
              </form>
            </div>
            <div class="tab-pane" id="ups" role="tabpanel" aria-labelledby="ups-tab" aria-expanded="false">
              <form class="needs-validation" novalidate>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Sabit Kargo Ücreti</label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Düşük Sepet) </label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Yüksek Sepet) </label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
              </form>
            </div>
            <div class="tab-pane" id="yurtici" role="tabpanel" aria-labelledby="yurtici-tab" aria-expanded="false">
              <form class="needs-validation" novalidate>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Sabit Kargo Ücreti</label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Düşük Sepet) </label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Yüksek Sepet) </label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
              </form>
            </div>
            <div class="tab-pane" id="yango" role="tabpanel" aria-labelledby="yango-tab" aria-expanded="false">
              <form class="needs-validation" novalidate>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Sabit Kargo Ücreti</label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Düşük Sepet) </label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="company-name">Kapıda Ödeme Kargo (Yüksek Sepet) </label>
                  <input
                    type="text"
                    id="company-official-name"
                    class="form-control"
                    aria-label="Name"
                    aria-describedby="company-official-name"
                    required
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Ziyaretçi fiyat katsayısı giriniz.</div>
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
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
