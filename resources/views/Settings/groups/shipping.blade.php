<div class="card-header">
    <h4 class="card-title">Kargo Ayarlar</h4>
</div>
<div class="card-body statistics-body">
    <form class="form ajax-form">
        <div class="row col-8">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="kargoGunuUyarisi">Ürün Sayfasında Kargoya verilme Uyarisi </label>
                    </div>
                    <div class="col-sm-9">
                        <select id="kargoGunuUyarisi" class="form-select" name="settings[kargoGunuUyarisi]" placeholder="KArgo Günü Uyarısı">
                            <option value="1"> Evet </option>
                            <option value="0"> Hayır </option>
                        </select>
                    </div>
                </div>
            </div>
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
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="cargoCodPriceLimit">Yüksek Sepet Başlangıcı</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="cargoCodPriceLimit" class="form-control" name="settings[cargoCodPriceLimit]" placeholder="Yüksek Sepet Başlangıcı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="cargoFreeBorder">Ücretsiz Kargo Sınırı</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="cargoFreeBorder" class="form-control" name="settings[cargoFreeBorder]" placeholder="Ücretsiz Kargo Sınırı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="day1free">Kargo Sınırı (Pazartesi)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="day1free" class="form-control" name="settings[day1free]" placeholder="Pazartesi Kargo Sınırı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="day2free">Kargo Sınırı (Salı)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="day2free" class="form-control" name="settings[day2free]" placeholder="Salı Kargo Sınırı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="day3free">Kargo Sınırı (Çarşamba)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="day3free" class="form-control" name="settings[day3free]" placeholder="Çarşamba Kargo Sınırı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="day4free">Kargo Sınırı (Perşembe)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="day4free" class="form-control" name="settings[day4free]" placeholder="Perşembe Kargo Sınırı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="day5free">Kargo Sınırı (Cuma)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="day5free" class="form-control" name="settings[day5free]" placeholder="Cuma Kargo Sınırı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="day6free">Kargo Sınırı (Cumartesi)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="day6free" class="form-control" name="settings[day6free]" placeholder="Cumartesi Kargo Sınırı" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="day0free">Kargo Sınırı (Pazar)</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="day0free" class="form-control" name="settings[day0free]" placeholder="Pazar Kargo Sınırı" value="">
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
