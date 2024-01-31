<div class="row g-1">
    <div class="col-md-2">
        <select name="marketplaceCode" id="marketplaceCode" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Ödeme Tipi</option>
            @foreach(\Enum::list('MarketplaceCode') as $key=>$val)
                <option value="{{ $key }}" @if($key==MarketplaceCode::AKLLPHN) selected @endif>{{ $val }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="paymentType" id="paymentType" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Ödeme Tipi</option>
            @foreach(\Enum::list('PaymentType') as $key=>$val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="orderStatus" id="orderStatus" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Sipariş Durumu</option>
            @foreach(\Enum::list('OrderStatus') as $key=>$val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="paymentStatus" id="paymentStatus" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Ödeme Durumu</option>
            @foreach(\Enum::list('PaymentStatus') as $key=>$val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <input name="startsAt" type="text" id="fp-default" class="form-control flatpickr-basic datatable-filter" placeholder="Başlama Tarihi" />
    </div>
    <div class="col-md-2">
        <input name="endsAt" type="text" id="fp-default" class="form-control flatpickr-basic datatable-filter" placeholder="Bitiş Tarihi" />
    </div>
</div>
