<div id="product-detail" class="content">
    <div class="row g-3">
            <div class="col-md-12">
                <div class="card full-height mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Açıklama </h5>
                    </div>
                    <div class="card-body">

                        <div class="col-sm-12">
                            <x-textarea-editor id="description" name="product[description]" placeholder="Açıklama" value="{{isset($product['description'])?$product['description']:''}}" />
                        </div>
                        <div id="froala"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card full-height mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Fotoğraflar </h5>
                    </div>
                    <div class="card-body">

                        <div class="row" id="container">
                            <!-- İlk select ve image-upload kısmı -->
                            <div class="col-sm-2" id="col1">
                                <select class="select-with-name form-select" data-nametarget="" name="" id="select1">

                                </select>
                                <div class="image-upload small brand" style="margin-top: 15px;">
                                    <input type="text" name="" value="" style="display: none">
                                    <input type="hidden" name="imageFile" value="">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" onclick="addSelect()" style="margin-top: 25px">
                            <i data-feather="save"></i>
                            <span class="align-middle">Yeni Fotoğraf Ekle</span>
                        </button>

                    </div>
                </div>
            </div>



        </div>

</div>
