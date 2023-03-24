
@extends('layouts/contentLayoutMaster')

@section('title', 'Sipariş Listesi')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome/font-awesome.min.css') }}" />
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection



@section('content')

    <!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">

            </div>
          <!--Search Form -->
          <div class="card-body mt-2">
            <form class="dt_adv_search" method="POST">
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                    <a href="#">
                    <button class="btn btn-primary">
                            <i data-feather="save"></i>
                            <span class="align-middle">Yeni Sipariş</span>
                        </button>
                    </a>
                </div>
              </div>
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                @php
                    $orderStatus = [
                        [
                            "name" => "Beklemede",
                            "value" => "pending"
                        ],
                        [
                            "name" => "Onaylandı",
                            "value" => "approved"
                        ],
                        [
                            "name" => "Hazırlanıyor",
                            "value" => "preparing"
                        ],
                        [
                            "name" => "Kargoda",
                            "value" => "shipping"
                        ],
                        [
                            "name" => "Teslim Edildi",
                            "value" => "delivered"
                        ],
                        [
                            "name" => "İptal Edildi",
                            "value" => "canceled"
                        ],
                        [
                            "name" => "İade Edildi",
                            "value" => "returned"
                        ]
                    ]
                @endphp
                <x-inputs.select-input :items="$orderStatus" label="Sipariş Durumu" name="order_status" />
              </div>
                <div class="col-md-4">
                  {{-- <label class="form-label">Email:</label>
                  <input
                    type="text"
                    class="form-control dt-input"
                    data-column="2"
                    placeholder="demo@example.com"
                    data-column-index="1"
                  /> --}}
                  @php
                      $paymentType = [
                        [
                            "name" => "Kredi Kartı",
                            "value" => "credit_card"
                        ],
                        [
                            "name" => "Havale",
                            "value" => "transfer"
                        ],
                        [
                            "name" => "Nakit",
                            "value" => "cash"
                        ],
                      ]
                  @endphp
                    <x-inputs.select-input :items="$paymentType" label="Ödeme Tipi" name="payment_type" />
                </div>

                <div class="col-md-4">
                  @php
                      $memberType = [
                        [
                            "name" => "Müşteri",
                            "value" => "customer"
                        ],
                        [
                            "name" => "Bayi",
                            "value" => "dealer"
                        ],
                        [
                            "name" => "Üye",
                            "value" => "member"
                        ],
                      ]
                  @endphp
                    <x-inputs.select-input :items="$memberType" label="Üye Tipi" name="member_type" />
                </div>
              </div>
              <div class="row g-1 mb-md-1">
                <div class="col-md-4">
                  @php
                      $marketPlaces = [
                        [
                            "name" => "Akıllıphone (519 Sipariş)",
                            "value" => "akilliphone"
                        ],
                        [
                            "name" => "Amazon (519 Sipariş)",
                            "value" => "amazon"
                        ],
                        [
                            "name" => "Çiçeksepeti (519 Sipariş)",
                            "value" => "ciceksepeti"
                        ],
                        [
                            "name" => "Epttavm (519 Sipariş)",
                            "value" => "epttavm"
                        ],
                        [
                            "name" => "Hepsiburada (519 Sipariş)",
                            "value" => "hepsiburada"
                        ],
                        [
                            "name" => "N11 (519 Sipariş)",
                            "value" => "n11"
                        ],
                        [
                            "name" => "Trendyol (519 Sipariş)",
                            "value" => "trendyol"
                        ]
                      ]
                  @endphp
                    <x-inputs.select-input :items="$marketPlaces" label="Market Yeri" name="market_place" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Zaman Aralığı</label>
                  <div class="mb-0">
                    <input
                      type="text"
                      class="form-control dt-date flatpickr-range dt-input"
                      data-column="5"
                      placeholder="Başlangıç - Bitiş"
                      data-column-index="4"
                      name="dt_date"
                    />
                    <input
                      type="hidden"
                      class="form-control dt-date start_date dt-input"
                      data-column="5"
                      data-column-index="4"
                      name="value_from_start_date"
                    />
                    <input
                      type="hidden"
                      class="form-control dt-date end_date dt-input"
                      name="value_from_end_date"
                      data-column="5"
                      data-column-index="4"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  @php
                      $orderType = [
                        [
                            "name" => "Tümü",
                            "value" => "all"
                        ],
                        [
                            "name" => "İndirimli Sepetler",
                            "value" => "discounted_baskets"
                        ],
                        [
                            "name" => "Dropshipping",
                            "value" => "dropshipping"
                        ],
                      ]
                  @endphp
                    <x-inputs.select-input :items="$orderType" label="Sipariş Tipi" name="order_type" />
                </div>
              </div>
              <div class="row g-1">
                <div class="col-md-3">
                    <x-inputs.text-input label="Ada Göre Ara" placeholder="Ada Göre Ara" name="search_name" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Sipariş No'ya Göre Ara" placeholder="Sipariş No'ya Göre Ara" name="search_order_no" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Fatura No'ya Göre Ara" placeholder="Fatura No'ya Göre Ara" name="search_receipt_no" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Ürün Koduna Göre Ara" placeholder="Ürün Koduna Göre Ara" name="search_product_code" />
                </div>
              </div>
            </form>
          </div>
          <hr class="my-0" />
          <div class="card-datatable">
            <table class="dt-advanced-search table">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th>Tümünü Seç</th>
                  <th>Sıra No</th>
                  <th>Sipariş No</th>
                  <th>Ad Soyad</th>
                  <th>Tarih</th>
                  <th>Ödeme Tipi</th>
                  <th>Tutar</th>
                  <th>Kargo Firması</th>
                  <th>Sipariş Durumu</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Advanced Search -->

@endsection


@section('vendor-script')
{{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
