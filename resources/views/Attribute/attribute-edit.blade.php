@if($attribute)
    <form class="ajax-form" method="post" action="{{ route('attribute.save', isset($attribute['attributeId'])?$attribute['attributeId']:'new') }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Kodu </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="attribute[code]" placeholder="Kodu" value="{{isset($attribute['code'])?$attribute['code']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Adı </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="name"  class="form-control" name="attribute[name]" placeholder="Adı" value="{{isset($attribute['name'])?$attribute['name']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Kaydet</button>
                <input type="hidden" name="attribute[attributeId]" value="{{isset($attribute['attributeId'])?$attribute['attributeId']:''}}" />
            </div>
        </div>

    </form>
@else
    Yorum bulunamadı
@endif
