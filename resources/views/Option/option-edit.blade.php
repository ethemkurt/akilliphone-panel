@if($option)
    <form class="ajax-form" method="post" action="{{ route('option.save', isset($option['optionId'])?$option['optionId']:'new') }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Kodu </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="option[code]" placeholder="Kodu" value="{{isset($option['code'])?$option['code']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Adı </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="name"  class="form-control" name="option[name]" placeholder="Adı" value="{{isset($option['name'])?$option['name']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Kaydet</button>
                <input type="hidden" name="option[optionId]" value="{{isset($option['optionId'])?$option['optionId']:''}}" />
            </div>
        </div>

    </form>
@else
    Yorum bulunamadı
@endif
