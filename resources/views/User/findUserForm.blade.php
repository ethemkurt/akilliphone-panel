<div id="select-user-form" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select id="select-userId" class="form-control select2-ajax" required></select>
    <div class="col-12">
        <div class="mb-1 row">
            <div class="col-sm-9 mt-1">
                <button id="select-user" class="btn btn-success  waves-effect waves-float waves-light pull-end" type="button" >Kullanıcı Seç</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.select2-ajax').select2({
        ajax: {
            url: '{{ route('user.find-user-select2') }}',
            dataType: 'json'
        },
        dropdownParent: $('#select-user-form')
    });
</script>
