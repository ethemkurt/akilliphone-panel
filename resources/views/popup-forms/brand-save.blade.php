<form  method="post" action="{{ route('product.brand-save') }}" enctype="multipart/form-data" >
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Marka Adı </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code"  class="form-control" name="brand[name]" value="{{isset($brand['name'])?$brand['name']:''}}" placeholder="{{isset($brand['name'])?$brand['name']:'Marka Adı Giriniz'}}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Marka Kodu </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code"  class="form-control" name="brand[code]" value="{{isset($brand['code'])?$brand['code']:''}}" placeholder="{{isset($brand['code'])?$brand['code']:'Marka Kodu Giriniz'}}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Marka Slug </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code"  class="form-control" name="brand[slug]" value="{{isset($brand['slug'])?$brand['slug']:' '}}" placeholder="{{isset($brand['slug'])?$brand['slug']:'Marka Slug Giriniz'}}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Açıklaması</label>
                </div>
                <div class="col-sm-9">

                    <input type="text" id="name"  class="form-control" name="brand[description]" value="{{isset($brand['description'])?$brand['description']:' '}}" placeholder="{{isset($brand['description'])?$brand['description']:'Marka Açıklaması Giriniz'}}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Meta Başlık</label>
                </div>
                <div class="col-sm-9">

                    <input type="text" id="name"  class="form-control" name="brand[metaTitle]" value="{{isset($brand['metaTitle'])?$brand['metaTitle']:' '}}" placeholder="{{isset($brand['metaTitle'])?$brand['metaTitle']:'Marka Meta Başlık Giriniz'}}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Meta Açıklaması</label>
                </div>
                <div class="col-sm-9">

                    <input type="text" id="name"  class="form-control" name="brand[metaDescription]" value="{{isset($brand['metaDescription'])?$brand['metaDescription']:' '}}" placeholder="{{isset($brand['metaDescription'])?$brand['metaDescription']:'Marka Meta Açıklaması Giriniz'}}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Marka Logosu</label>
                </div>
                <div class="col-sm-9">

                    <input type="file" id="image"  class="form-control" name="brand[image]" placeholder="Marka logosu Yükle"  >
                </div>
            </div>
        </div>
        <div class="col-sm-9 offset-sm-3">
            <input type="hidden" name="image_default" value="{{isset($brand['image'])?$brand['image'] : "111212" }}">
            @if(isset($brand['brandId']))
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
            @else
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Oluştur</button>
            @endif
        <input type="hidden" name="brand[brandId]" value="{{isset($brand['brandId'])?$brand['brandId']:'new'}}" />
        </div>
    </div>

</form>
