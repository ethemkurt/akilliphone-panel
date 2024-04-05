@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Listesi')

@section('page-style')
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection
@section('nav-buttons')
    <a class="btn btn-primary" href="{{ route('product.new','new') }}">
        <i data-feather="save"></i>
        <span class="align-middle">Kaydet</span>
    </a>
@endsection
@section('content')
    <style>
        /* Eklenen CSS */
        #renkTablosu {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        #renkTablosu th, #renkTablosu td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        #renkTablosu th {
            background-color: #f2f2f2;
        }
        .tab{
            width: 100%;
            background-color: white;
        }
        .tab ul li{
            display: inline-block;
            padding: 15px;
            font-weight: bold;
        }
        .tab ul li a{
            text-decoration: none;
            color: #5E5873;
        }

    </style>
    <?php
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $urlComponents = parse_url($currentUrl);
    $path = $urlComponents['path'];
    $segments = explode('/', $path);
    $productID = end($segments);


    ?>
    <section>
        <div class="row">
            <!-- Default Wizard -->
            <div class="col-12 mb-4">
                <?php
                $forms = [
                    'product-basic'=>[
                        'code'=>'product-basic',
                        'title'=>'Temel Özellikler',
                        'description'=>'Ürüne Ait Temel Özellikler',
                        'icon'=>'',
                        'file'=>'product-basic',
                    ],
                    'product-stock'=>[
                        'code'=>'product-stock',
                        'title'=>'Stok Bilgileri',
                        'description'=>'Ürüne Ait Stok ve Kategori Bilgileri',
                        'icon'=>'',
                        'file'=>'product-stock'
                    ],
                    'product-detail'=>[
                        'code'=>'product-detail',
                        'title'=>'Detay Bilgisi',
                        'description'=>'Ürüne Ait Detay Bilgileri',
                        'icon'=>'',
                        'file'=>'product-detail'
                    ],
                    'product-pazaryerleri'=>[
                        'code'=>'product-pazaryerleri',
                        'title'=>'Pazaryerleri',
                        'description'=>'Ürüne Ait Pazaryerleri Ayarları',
                        'icon'=>'',
                        'file'=>'product-pazaryerleri'
                    ],
                ];
                $sira = 1;
                ?>
                @if($forms)

                    <div class="bs-stepper wizard-numbered mt-2">
                        <div class="bs-stepper-header">
                            @foreach($forms as $form)
                                <div class="step" data-target="#{{ $form['code'] }}">
                                    <button type="button" class="step-trigger" id="{{$sira}}">
                                        <span class="bs-stepper-circle">{{ $sira++ }}</span>
                                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">{{ $form['title'] }}</span>
                            <span class="bs-stepper-subtitle">{{ $form['description'] }}</span>
                          </span>
                                    </button>
                                </div>

                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                            @endforeach
                        </div>
                        <div class="bs-stepper-content">
                            @foreach($forms as $form)
                                @include('Product.tabs.'.$form['file'])
                            @endforeach
                        </div>
                    </div>
                @endif
                <input type="text" value="" id="productControl" style="display: none">
            </div>
            <!-- /Default Wizard -->
        </div>
    </section>
@endsection

@section('vendor-script')
@endsection

@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        TulparUploader.createUploder();
    </script>
    <script src="{{ _Asset('vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ _Asset('js/form-wizard-numbered.js') }}"></script>
    <script>
        $('body').on('click', '.load-product-specs', function(){
            $.ajax( $(this).data('url') )
                .done(function(response) {
                    $('#product-specs').html(response.html)
                })
                .fail(function() {
                    $('#product-specs').html('error')
                });
        });
    </script>
    <script>
        window.onload = function() {
            var buttonIds = ["4"];

            for (var i = 0; i < buttonIds.length; i++) {
                document.getElementById(buttonIds[i]).disabled = true;
            }
        };
    </script>
    <script>

        $('#productBasicForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize()
            }).done(function (response) {
                if (response.status) {
                    document.getElementById("2").disabled = false;
                    $('#productControl').val(response.html);
                    $('#stockId').val(response.html);
                    $('#categoryId').val(response.html);
                    Swal.fire({
                        title:  "Ürün Başarıyla Oluşturuldu.",
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        icon: 'success',
                        showConfirmButton: false,
                    });

                } else {
                    Swal.fire({
                        title:  "Ürün  Oluşturulamadı.",
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        icon: 'error',
                        showConfirmButton: false,
                    });
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
            });
            return false;
        });


    </script>
    <script>
        $('#productCategoryForm').submit(function(event) {
            // Formun normal submit işlemini engelliyoruz
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize()
            }).done(function (response) {
                if (response.status) {

                } else {
                    //$('body .ajax-form-result').html(response.errors);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
            });
            return false;
        });


    </script>
    <script>

        // Form submit olduğunda bu fonksiyon çalışacak
        $('#productStockForm').submit(function(event) {
            // Formun normal submit işlemini engelliyoruz
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize()
            }).done(function (response) {
                if (response.status) {
                    var variantsColors = response.html.variants;
                    for (var i = 0; i < variantsColors.length; i++) {
                        var color = variantsColors[i];
                        // Her bir rengi istediğiniz şekilde işleyin
                        // Örneğin, bir metin kutusuna eklemek için:
                        $('#variantsColorTextBox').append(color + ' ');
                    }

                } else {
                    //$('body .ajax-form-result').html(response.errors);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
            });
            return false;
        });


    </script>
    <script>

        $('body').on('change', '.main-category-select select', function(){
            $(this).parents('.category-row').nextAll('.category-row').remove();

            $.ajax( {
                url: '{{ route('category.category-select') }}?categoryId=' + $(this).val(),
                target:$(this).parents('.category-row')[0],
            } )
                .done(function(select) {
                    $(this.target).after(select)
                })
                .fail(function() {
                    //alert( "error" );
                });
        });
        $('body').on('click', '.select-categories', function(){
            $('.main-category-select option:selected').each(function() {
                if(!$('body').find('#selected-'+$(this).val()).length){
                    $('#selected-categories').append( get_selected_category($(this)) );
                }
            });
        });
        function get_selected_category(el){
            console.log(el.text(), el.val(), el.html());
            let id = 'selected-' + el.val();
            let value = el.val();
            let text = el.text();
            let html = `<div class="col-sm-4 mb-1"><input id="${id}" name="productCategories[]" type="hidden" value="${value}"><div class="input-group input-group-merge"><input type="text" disabled class="form-control"  value="${text}"><button class="btn btn-danger" type="button"><i class="tf-icons ti ti-minus" style="color: #FFFFFF"></i></button></div></div>`;
            return html;
        }
    </script>
    <script>
        $('body').on('change', '.nextselect', function(){
            $(this).nextAll().remove();
            $.ajax( {
                url:$(this).data('nexturl')+ '?categoryId=' + $(this).val(),
                target:$(this)[0],
            } )
                .done(function(select) {
                    console.log(this);
                    $(this.target).after(select)
                })
                .fail(function() {
                    alert( "error" );
                });
        })
    </script>
    <script>
        $('body').on('change', '.nextselect', function(){
            // Belirtilen sınıfa sahip tüm select elementlerini seç
            var selects = $(".nextselect");


            // En sonuncu select elementini seç
            var lastSelect = selects.last();
            $("#catalogid").val(lastSelect.val());
            // Seçili olan select elementinin values'ını ekrana yaz
            console.log("Values: " + lastSelect.val());



        });
    </script>

    <script>
        // Etkinlik dinleyicisi ekleme
        document.addEventListener('change', function (event) {
            var target = event.target;

            // Eğer değişiklik olan element bir select ise
            if (target.tagName.toLowerCase() === 'select' && target.classList.contains('form-select') && target.classList.contains('spec-value')) {
                // Seçili olan option elementlerini kontrol etme
                var options = target.querySelectorAll('option');
                var selectedOptions = [];

                options.forEach(function (option) {
                    if (option.selected) {
                        selectedOptions.push({
                            name: target.getAttribute('name'),
                            value: option.value,
                            text: option.textContent
                        });
                    }
                });

                // Sonuçları yazdırma veya istediğiniz başka bir işlemi gerçekleştirme
                console.log(selectedOptions);
            }
        });

    </script>


    <script>

        var selectInfoArray = [];
        $('body').on('change', '.form-select.spec-value', function() {
            // Tüm form-select spec-value elementlerini seç
            var selectElements = document.querySelectorAll('.form-select.spec-value');

            // Her bir select elementi için bilgileri topla
            selectElements.forEach(function (selectElement) {
                var option = selectElement.querySelector('option:selected');

                var selectInfo = {
                    attributeId: selectElement.getAttribute('name'),
                    attributeName: option.getAttribute('value'),
                    attributeValueId: option.getAttribute('data-value-id'),
                    attributeValueName: option.textContent
                };

                // Oluşturulan bilgileri diziye ekle
                selectInfoArray.push(selectInfo);
            });

            // Oluşturulan JSON'u göster
            console.log(JSON.stringify(selectInfoArray, null, 2));
        });
    </script>
    <script>
        document.getElementById('renkbtn').addEventListener('click', function () {
            var selectedOptions = document.getElementById('renkler').selectedOptions;
            var renkTablosuBody = document.getElementById('renkTablosu').getElementsByTagName('tbody')[0];
            var dynamicSelect = document.getElementById('dynamicSelect');

            // Renk listesini tabloya ve dinamik seçim kutusuna ekle
            for (var i = 0; i < selectedOptions.length; i++) {
                var renk = selectedOptions[i].value + " - " + selectedOptions[i].text;

                var row = renkTablosuBody.insertRow();
                var cellRenk = row.insertCell(0);
                var cellResim = row.insertCell(1);
                var cellMiktar = row.insertCell(2);
                var cellBarkod = row.insertCell(3);
                console.log(selectedOptions[i].value)
                cellRenk.innerHTML = '<input type="text"  name="variants['+i+'][variantOptions][0][optionValueId]" value="'+selectedOptions[i].value+'" style="display: none">'+renk;


                cellResim.innerHTML = '<div class="image-upload small brand" style="background-image: url({{ _CdnImageUrl($product["featuredImage"]?? "" , 200,200) }}); width:100px;height:100px;">' +
                    '<input type="text"  value="" style="display: none">' +
                    '<input type="hidden" name="variants['+i+'][variantImages][image]" value="['+selectedOptions[i].value+']">' +
                    '<input type="file" onchange="TulparUploader.loadImageFile(event, this)">' +
                    '</div>';

                cellMiktar.innerHTML = '<input type="text" class="form-control" style="width: 200px" name="variants['+i+'][variantOptions][0][stock]" >';
                cellBarkod.innerHTML = '<div style="margin:5px;display: flex"><span>Barcode : </span><input type="text" class="form-control" style="width: 170px;height: 30px;" name="variants['+i+'][variantOptions][0][barcode]" ></div>' +
                    '<div style="margin:5px;display: flex"><span>Stok : </span><input type="text" class="form-control" style="width: 170px;height: 30px;" name="variants['+i+'][variantOptions][0][stock]" ></div>' +
                    '<div style="margin:5px;display: flex"><span>Mpn  : </span><input type="text" class="form-control" style="width: 170px;height: 30px; margin: 5px;" name="variants['+i+'][variantOptions][0][mpn]" ></div>' +
                    '<div style="margin:5px;display: flex"><span>Sku  : </span><input type="text" class="form-control" style="width: 170px;height: 30px; margin: 5px;" name="variants['+i+'][variantOptions][0][sku]" ></div>' +
                    '<div style="margin:5px;display: flex"><span>Gtin  : </span><input type="text" class="form-control" style="width: 170px;height: 30px; margin: 5px;" name="variants['+i+'][variantOptions][0][gtin]" ></div>';


                var option = document.createElement("option");
                option.text = selectedOptions[i].text;
                option.value = selectedOptions[i].value;
                dynamicSelect.add(option);
            }
        });
    </script>
    <script>
        var counter = 1;
        var select = document.querySelector("#select1");
        document.addEventListener('DOMContentLoaded', function() {

            var button = document.getElementById('3'); // id'si 3 olan düğmeyi seç
            button.addEventListener('click', function() {

                $.ajax({
                    url: "{{route('product.variants',$productID)}}",
                    method: "GET",
                    data: $(this).serialize()
                }).done(function (response) {
                    if (response.status) {
                        var variants = response.html;
                        for (var i = 0; i < variants.length; i++) {

                            var optionElement = document.createElement("option");
                            optionElement.value = variants[i]["variantOptionId"]+'-'+variants[i]["optionValueId"];
                            optionElement.text = variants[i]["colorName"];
                            select.appendChild(optionElement);
                        }

                        select.setAttribute("name", "options["+counter+"][variantOptionId]");

                    } else {

                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {

                });

            });
        });


        function addSelect() {
            counter++;
            var container = document.getElementById('container');
            var newDiv = document.createElement('div');
            newDiv.className = 'col-sm-2';
            newDiv.id = 'col' + counter;

            var newDivContent = select.outerHTML + '<div class="image-upload small brand" style="background-image: url({{ _CdnImageUrl($product["featuredImage"]?? "" , 200,200) }}); margin-top:15px ">' +
                '<input type="text"  value="" style="display: none">' +
                '<input type="hidden" name="option['+counter+'][image]">' +
                '<input type="file" onchange="TulparUploader.loadImageFile(event, this)">' +
                '</div>';;

            newDiv.innerHTML = newDivContent;

            container.appendChild(newDiv);
        }






    </script>
@endsection
