@if($optionValue)
    <form class="ajax-form" method="post" action="{{ route('option.value.save', [$optionValue['optionId'], $optionValue['optionValueId']] ) }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Seçenek Kodu </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="optionValue[code]" value="{{isset($optionValue['code'])?$optionValue['code']:''}}" placeholder="Kod">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Seçenek Adı </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="value"  class="form-control" name="optionValue[value]" value="{{isset($optionValue['value'])?$optionValue['value']:''}}" placeholder="Ad">
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
                <input type="hidden" name="optionValue[optionId]" value="{{isset($optionValue['optionId'])?$optionValue['optionId']:''}}" />
                <input type="hidden" name="optionValue[optionValueId]" value="{{isset($optionValue['optionValueId'])?$optionValue['optionValueId']:''}}" />
                <input type="hidden" name="optionValue[image]" value="{{isset($optionValue['image'])?$optionValue['image']:'none'}}" />

            </div>
        </div>
    </form>
@else
    Seçenek bulunamadı
@endif
