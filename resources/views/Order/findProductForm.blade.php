<form id="add-product-to-order" method="POST" action="{{ route('order.add-product-to-order') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control select2-ajax" required></select>
    <div id="prodcut-options"></div>
</form>

<script>
    $('.select2-ajax').select2({
        ajax: {
            url: '{{ route('order.find-product-select2') }}',
            dataType: 'json'
        },
        dropdownParent: $('#poupForm'),
        templateResult: function(opt){
            if (!opt.id) {
                return opt.text;
            }
            return opt = $(
                '<span class="userName"><img src="' + opt.image + '" class="userPic" /> ' + opt.text + '</span>'
            );
        },
        templateSelection: function(opt){
            $('#prodcut-options').html('');
            let html = '<div class="demo-inline-spacing">';
            $(opt.variants).each(function(){
                html += '<div class="form-check form-check-success"><input type="radio" name="variantId" required class="form-check-input" id="colorCheck'+$(this)[0].variantId+'" value="'+$(this)[0].variantId+'"> <label class="form-check-label" for="colorCheck'+$(this)[0].variantId+'">'+$(this)[0].name+'</label> </div>'
            });
            html += '</div><div class="col-12 mt-1 text-end"><button type="submit" class="btn btn-danger add-product-to-order" ><i class="feather icon-plus"></i></button></div>';
            $('#prodcut-options').html(html);
            return opt.text;
        }
    });

</script>
