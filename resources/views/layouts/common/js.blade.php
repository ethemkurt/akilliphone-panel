<!-- Core JS -->
<!-- build:js {{ _Asset('vendor/js/core.js') }} -->

<script src="{{ _Asset('vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ _Asset('vendor/libs/popper/popper.js') }}"></script>
<script src="{{ _Asset('vendor/js/bootstrap.js') }}"></script>
<script src="{{ _Asset('vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ _Asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ _Asset('vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ _Asset('vendor/js/menu.js') }}"></script>

<script src="{{ _Asset('vendor/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ _Asset('vendor/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ _Asset('vendor/libs/validation/jquery.validate.min.js') }}"></script>
<script src="{{ _Asset('vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ _Asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
<script src="{{ _Asset('vendor/libs/select2/select2.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ url('js/akilliphone.js') }}?_v={{ time() }}"></script>
<script src="{{ _Asset('js/main.js') }}"></script>
<script src="{{ url('js/tulpar-uploader.js') }}?_v={{ time() }}"></script>
<script src="{{ url('js/ckeditor.js') }}"></script>
<script>
    class NewcartFileUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            xhr.open( 'POST', "{{route('upload.cke', ['_token' => csrf_token() ])}}", true );
            xhr.responseType = 'json';
        }

        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                resolve( response );
            } );

            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        _sendRequest( file ) {
            const data = new FormData();

            data.append( 'upload', file );

            this.xhr.send( data );
        }
    }
    function NewcartFileUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new NewcartFileUploadAdapter( loader );
        };
    }
</script>

<!-- Page JS -->
