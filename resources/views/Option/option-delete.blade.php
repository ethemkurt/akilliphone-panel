@if($attribute)
    <form class="ajax-form" method="post" action="{{ route('attribute.delete', $attribute['attributeId']) }}">
        <div class="col-12">
            <p>
                <b>{{ $attribute['name'] }}</b> Özelliği Silinecek. Emin misiniz?</p>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-danger me-1 waves-effect waves-float waves-light">Evet Sil</button>
        </div>
        <input type="hidden" name="attributeId" value="{{isset($attribute['attributeId'])?$attribute['attributeId']:''}}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
@else
    Özellik bulunamadı
@endif
