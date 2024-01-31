@if($attributeValue)
    <form class="ajax-form" method="post" action="{{ route('attribute.value.save', [$attributeValue['attributeId'], $attributeValue['attributeValueId']] ) }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Seçenek Kodu </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="attributeValue[code]" value="{{isset($attributeValue['code'])?$attributeValue['code']:''}}" placeholder="Kod">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Seçenek Adı </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="value"  class="form-control" name="attributeValue[value]" value="{{isset($attributeValue['value'])?$attributeValue['value']:''}}" placeholder="Ad">
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
                <input type="hidden" name="attributeValue[attributeId]" value="{{isset($attributeValue['attributeId'])?$attributeValue['attributeId']:''}}" />
                <input type="hidden" name="attributeValue[attributeValueId]" value="{{isset($attributeValue['attributeValueId'])?$attributeValue['attributeValueId']:''}}" />

            </div>
        </div>
    </form>
@else
    Yorum bulunamadı
@endif
