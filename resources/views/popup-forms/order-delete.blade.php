@if($order)
<form class="ajax-form" method="post" action="{{ route('order.delete', $order['orderId']) }}">
    <div class="col-12">
        <p><b>{{ $order['orderCustomer']['firstName'] }} {{ $order['orderCustomer']['lastName'] }}</b> Siparişi Silinecek. Emin misiniz?</p>
    </div>
    <div class="col-12 text-end">
                <button type="submit" class="btn btn-danger me-1 waves-effect waves-float waves-light">Evet Sil</button>
        </div>

    <input type="hidden" name="orderId" value="{{isset($order['orderId'])?$order['orderId']:''}}" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
@else
    Sipariş bulunamadı
@endif
