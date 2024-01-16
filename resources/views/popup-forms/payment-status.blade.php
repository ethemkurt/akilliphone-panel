<form class="ajax-form" method="post" action="{{ route('order.payment-status-save') }}">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Durum Kodu</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code" required class="form-control" name="paymentStatus[code]" value="{{isset($paymentStatus['code'])?$paymentStatus['code']:''}}" placeholder="Benzersiz bir kod giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Durum Adı</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="name" required class="form-control" name="paymentStatus[name]" value="{{isset($paymentStatus['name'])?$paymentStatus['name']:''}}" placeholder="Durum adı giriniz">
                </div>
            </div>
        </div>
        <div class="col-sm-9 offset-sm-3">
            @if(isset($paymentStatus['paymentStatusId']))
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
            @else
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Oluştur</button>
            @endif
        </div>
    </div>
    <input type="hidden" name="paymentStatus[paymentStatusId]" value="{{isset($paymentStatus['paymentStatusId'])?$paymentStatus['paymentStatusId']:'new'}}" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
