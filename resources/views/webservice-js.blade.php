<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script>
    @if($flash = session()->get('flash-error'))
    toastr['error'](
        '{{$flash[0]}}',
        '{{$flash[1]}}',
    {
        closeButton: true,
        tapToDismiss: false,
        rtl: 0
    }
    );
    @endif
    @if($flash = session()->get('flash-success'))
    toastr['success'](
        '{{$flash[0]}}',
        '{{$flash[1]}}',
    {
        closeButton: true,
        tapToDismiss: false,
        rtl: 0
    }
    );
    @endif
</script>
