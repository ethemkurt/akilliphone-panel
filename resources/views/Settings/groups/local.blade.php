<div class="card-header">
    <h4 class="card-title">Bölgesel Ayarlar</h4>
</div>
<div class="card-body statistics-body">
    <form class="form ajax-form">
        <div class="row col-8">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="language">Dil Seçeneği </label>
                    </div>
                    <div class="col-sm-9">
                        <select id="language" class="form-select" name="settings[language]" placeholder="Dil Seçeneği">
                            <option value="tr"> Türkçe </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="webCurrencySymbol">Para Birimi </label>
                    </div>
                    <div class="col-sm-9">
                        <select  id="webCurrencySymbol" class="form-select" name="settings[webCurrencySymbol]" placeholder="Para Birimi">
                            <option value="YTL"> TL </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="sabitKur">Sabit Kur </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="sabitKur" class="form-control" name="settings[sabitKur]" placeholder="Sabit Kur" value="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="ziyaretciKatsayi">Ziyaretçi Katsayısı </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="ziyaretciKatsayi" class="form-control" name="settings[ziyaretciKatsayi]" placeholder="Yetkili Kişi" value="">
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Kaydet</button>
                <input type="hidden" name="group" value="local">
            </div>
        </div>
    </form>
</div>
