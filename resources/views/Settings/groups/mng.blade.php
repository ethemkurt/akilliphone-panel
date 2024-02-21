<div class="card-header">
    <h4 class="card-title">MNG Ayarlar</h4>
    <div class="d-flex align-items-center">
        <p class="card-text font-small-2 me-25 mb-0">Mng Ayarlar</p>
    </div>
</div>
<div class="card-body statistics-body">
    <form class="form ajax-form">
        <div class="row col-8">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="cargoFixPrice">Sabit Kargo Ücreti </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="cargoFixPrice" class="form-control" name="settings[cargoFixPrice]" placeholder="Kargo Ücreti" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="cargoCodPrice1">Kapıda Ödeme Ücreti (Düşük Sepet)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="cargoCodPrice1" class="form-control" name="settings[cargoCodPrice1]" placeholder="Kapıda Ödeme Ücreti" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="cargoCodPrice2">Kapıda Ödeme Ücreti (Yüksek Sepet)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="cargoCodPrice2" class="form-control" name="settings[cargoCodPrice2]" placeholder="Kapıda Ödeme Ücreti" value="">
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Kaydet</button>
                <input type="hidden" name="group" value="shipping">
            </div>
        </div>
    </form>
</div>
