<form class="ajax-form" method="post" action="{{ route('home.imageTest') }}">
    <div class="row">
        <div class="image-upload small" style="background-image: url('') ">
            <input type="text" name="slide[mobileImage]" value="" style="display: none">
            <input type="hidden" name="slide[mobileImageFile]" value="">
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Kaydet</button>

</form>

<script>
    TulparUploader.createUploder();
</script>
