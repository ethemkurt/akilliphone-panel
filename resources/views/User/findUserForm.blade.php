<div id="select-user-form" method="POST" action="">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <select class="form-control select2-ajax" required></select>
    <div id="prodcut-options"></div>
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
