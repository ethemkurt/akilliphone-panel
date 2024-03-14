<div id="product-basic" class="content">
    <div class="row equal mb-3">

            <div class="col-md-6">
                <div class="card full-height mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Ürün Bilgileri</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün kodu</label></div>
                                <div class="col-sm-9">

                                    <input value="{{ $product['code'] ?? '' }}" type="text" class="form-control" name="product[code]" placeholder="Ürün kodu" >
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ana Ürün kodu</label></div>
                                <div class="col-sm-9">
                                    <input value="" type="text" class="form-control" name="" placeholder="Ana Ürün kodu">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Adı</label></div>
                                <div class="col-sm-9">
                                    <input value="{{$product['name']?? '' }}" type="text" class="form-control" name="product[name]" placeholder="Ürün Adı">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Meta Başlık</label></div>
                                <div class="col-sm-9">
                                    <input value="{{$product['metaTitle']?? '' }}" type="text" class="form-control" name="product[metaTitle]" placeholder="Meta Başlık">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Meta Açıklama</label></div>
                                <div class="col-sm-9">
                                    <input value="{{$product['metaDescription']?? '' }}" type="text" class="form-control" name="product[metaDescription]" placeholder="Meta Açıklama">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Seçenek Etiketi</label></div>
                                <div class="col-sm-9">

                                    <input value="" type="text" class="form-control" name="" placeholder="Ürün Etiketi">


                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Seçenek Türü</label></div>
                                <div class="col-sm-9">

                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                        <option value="">Renk </option>
                                        <option value="">Beden  </option>
                                        <option value="">Numara </option>
                                        <option value="">Malzeme </option>


                                    </select>


                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Bölümü</label></div>
                                <div class="col-sm-9">

                                    <input value="" type="text" class="form-control" name="" placeholder="Ürün Bölümü">


                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Tagı Çekme</label></div>
                                <div class="col-sm-9">

                                    <input value="" type="text" class="form-control" name="" placeholder="Ürün Tagı Çekme">

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Markası</label></div>
                                <div class="col-sm-9">
                                    <select id="" class="select-with-name form-select" data-nametarget="" name="product[brandId]">
                                        <option value="">Marka Seçiniz </option>

                                        @foreach($brand['items'] as $brands)
                                            @if($product!=null)
                                                <option value="{{$brands['brandId']}}" {{ $brands['brandId'] ==  $product['brandId']  ? 'selected' : '' }}>
                                                    {{$brands['name']}}
                                                </option>
                                            @else
                                                <option value="{{$brands['brandId']}}">
                                                    {{$brands['name']}}
                                                </option>
                                            @endif


                                        @endforeach


                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Birimi</label></div>
                                <div class="col-sm-9">
                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                        <option value="">Adet</option>
                                        <option value="">Kg</option>
                                        <option value="">Metre</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="code">Ürün Ana Fotoğrafı </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="image-upload small brand" style="background-image: url({{ _CdnImageUrl($product['featuredImage']?? '' , 200,200) }}) ">
                                        <input type="text" name="" value="" style="display: none">
                                        <input type="hidden" name="featuredImage" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-height mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Fiyat Bilgileri </h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Para Birimi</label></div>
                                <div class="col-sm-9">
                                    <select id="" class="select-with-name form-select" data-nametarget="" name="product[currency]">
                                        @if(isset($product['currency']))
                                            @foreach($currency['currency'] as $currency )
                                                <option value="{{$currency}}" {{ $currency ==  $product['currency']  ? 'selected' : '' }}>{{$currency}} </option>
                                            @endforeach
                                        @else
                                            @foreach($currency['currency'] as $currency )
                                                <option value="{{$currency}}"> {{$currency}} </option>
                                            @endforeach
                                        @endif



                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Satış Fiyatı</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="" placeholder="Satış Fiyatı" value="{{$product['variants'][0]['price']?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Bayi Fiyatı</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product[price]" placeholder="Bayi Fiyatı">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Alış Fiyatı</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="" placeholder="Alış Fiyatı">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">KDV</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product[vatRate]" placeholder="KDV % olmadan" value="00.0">

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İndirim Oranı (%)</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product[discountRate]" placeholder="İndirim Oranı (%)" value="{{$product['discountRate']?? 0 }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Kampanya Fiyatı</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="" placeholder="Kampanya Fiyatı">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">İndirimsiz Fiyat</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="" placeholder="İndirimsiz Fiyat" value="{{$product['variants'][0]['oldPrice']?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-3"><label class="col-form-label" for="contact-info">Sepet Limiti</label></div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="" placeholder="Sepet Limiti">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
