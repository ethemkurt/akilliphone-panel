@extends('layouts/contentLayoutMaster')

@section('title', 'Slide Ekle')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/css/file-uploaders/dropzone.min.css')}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice.css')}}">
@endsection

@section('content')
<section class="invoice-add-wrapper">
  <div class="row invoice-add">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <form id="jquery-val-form" method="post">

                <div class="mb-1">
                  <label class="form-label" for="basic-default-name">Sıra No</label>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-default-name"
                    name="basic-default-name"
                  />
                </div>

                <div class="mb-1">
                    <label class="form-label" for="select-country">Slayt Tipi</label>
                    <select class="form-select select2" id="select-value" name="select-value">
                      <option value="">Tip Seçin</option>
                      <option value="val1">Value 1</option>
                      <option value="val2">Value 2</option>
                    </select>
                  </div>
                  <div class="mb-1">
                    <label for="flatpickr-range" class="form-label">Geçerlilik Tarihi</label>
                    <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" />
                  </div>

                  <div class="mb-1">
                    <label class="form-label" for="basic-default-name">Açıklama</label>
                    <input
                      type="text"
                      class="form-control"
                      id="basic-default-name"
                      name="basic-default-name"
                      placeholder="John Doe"
                    />
                  </div>
                  <div class="mb-1">
                    <label class="form-label" for="basic-default-name">Link</label>
                    <input
                      type="text"
                      class="form-control"
                      id="basic-default-name"
                      name="basic-default-name"
                      placeholder="John Doe"
                    />
                  </div>

                <div class="mb-1">
                    <label class="form-label" for="basic-default-name">Resim</label>
                    <div action="/upload" class="dropzone needsclick" id="dropzone-basic">
                        <div class="dz-message needsclick">
                          Drop files here or click to upload
                          <span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                        </div>
                        <div class="fallback">
                          <input name="file" type="file" />
                        </div>
                      </div>
                </div>
                <div class="mb-1">
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">Kaydet</button>
                </div>

              </form>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('vendors/js/file-uploaders/dropzone.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
<script>
    const myDropzone = new Dropzone('#dropzone-basic', {
    previewTemplate: previewTemplate,
    parallelUploads: 1,
    maxFilesize: 1,
    uploadMultiple: false,
    addRemoveLinks: true,
    maxFiles: 1
    });
</script>
<script>
    var flatpickrRange = document.querySelector("#flatpickr-range");

    flatpickrRange.flatpickr({
    mode: "range"
    });
  </script>
@endsection
