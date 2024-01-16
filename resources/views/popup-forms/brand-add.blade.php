<form class="ajax-form" method="post" action="{{ route('product.brand-add') }}" enctype="multipart/form-data" >
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Marka Adı </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code" required class="form-control" name="brand[name]" value="" placeholder="Marka Adı Giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Marka Kodu </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code" required class="form-control" name="brand[code]" value="" placeholder="Marka Kodu Giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Marka Slug </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code" required class="form-control" name="brand[slug]" value="" placeholder="Marka Slug Giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Açıklaması</label>
                </div>
                <div class="col-sm-9">

                    <input type="text" id="name" required class="form-control" name="brand[description]" value="" placeholder="Marka Açıklaması Giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Meta Başlık</label>
                </div>
                <div class="col-sm-9">

                    <input type="text" id="name" required class="form-control" name="brand[metaTitle]" value="" placeholder="Marka Meta Başlık Giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Meta Açıklaması</label>
                </div>
                <div class="col-sm-9">

                    <input type="text" id="name" required class="form-control" name="brand[metaDescription]" value="" placeholder="Marka Meta Açıklaması Giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Logosu</label>
                </div>
                <div class="col-sm-9">

                    <input type="file" id="image" required class="form-control" name="brand[image]" placeholder="Marka logosu Yükle">
                </div>
            </div>
        </div>
        <div class="col-sm-9 offset-sm-3">

            @if(isset($brand['brandId']))
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
            @else
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Oluştur</button>
            @endif

        </div>
    </div>

</form>
