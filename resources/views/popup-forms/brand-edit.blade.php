@if($brand)
    <form class="ajax-form" method="post" action="{{ route('product.brand-delete', $brand['brandId']) }}">
        <div class="col-12">
            <p>
                @if($brand['name'])<b>{{ $brand['name']}}</b> @endif
                Markası Silinecek. Emin misiniz?</p>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-danger me-1 waves-effect waves-float waves-light">Evet Sil</button>
        </div>

        <input type="hidden" name="orderId" value="{{isset($brand['brandId'])?$brand['brandId']:''}}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
@else
    Marka bulunamadı
@endif
