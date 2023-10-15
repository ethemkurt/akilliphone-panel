var Akilliphone = {
    init: function(){
        console.log('AkilliPhone runing...');
        this.documentReady();
    },
    documentReady: function(){
        $(document).ready(function(){
            Akilliphone.poupForms();
            Akilliphone._openPopupFormEvent();
            Akilliphone._ajaxFormEvent();
            Akilliphone._confirmPopupEvent();
        });
    },
    poupForms: function(){
        let html = `<div class="modal fade" id="poupForm" tabindex="-1" aria-labelledby="poupFormTitle" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                            <h4 class="modal-title"></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"></div>
                        <div class="modal-footer ajax-form-result"></div>
                        </div>
                    </div>
                </div>`;
        html += `<div class="modal fade" id="confirmPopup" tabindex="-1" aria-labelledby="confirmPopupTitle" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                            <h4 class="modal-title"></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                            <div class="col-12 ask mb-2"></div>
                            <button class="btn btn-danger cancel">Hayır</button> <a class="btn btn-success action" href="">Evet</a>
</div>
                        </div>
                    </div>
                </div>`;
        $('body').append(html);
        $('#confirmPopup').modal();
    },
    _openPopupFormEvent: function (){
        $('body').on('click', '.btn-popup-form', function(){
            $('#poupForm .modal-header .modal-title').html($(this).data('title'));
            $('#poupForm .modal-body').html('<i class="fas fa-circle-notch fa-spin"></i>');
            $('body .ajax-form-result').html('');
            $.ajax( $(this).data('url') ).done(function(response) {
                if(response.status){
                    $('#poupForm .modal-body').html(response.html);
                }  else {
                    $('#poupForm .modal-body').html(response.errors);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                $('#poupForm .modal-body').html('Oluşan hatalar için konsola bakınız');
                console.log(jqXHR.responseText);
            }).always(function() {

            });
        });
    },
    _ajaxFormEvent: function (){
        $('body').on('submit', '.ajax-form', function(e){
            e.preventDefault();
            $('body .ajax-form-result').html('<i class="fas fa-circle-notch fa-spin"></i>');
            $.ajax( {
                url: $(this).data('url'),
                method: $(this).attr('method')
            } ).done(function(response) {
                if(response.status){
                    $('body .ajax-form-result').html(response.html);
                }  else {
                    $('body .ajax-form-result').html(response.errors);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                $('body .ajax-form-result').html('Oluşan hatalar için konsola bakınız');
                console.log(jqXHR.responseText);
            }).always(function() {

            });

            return false;
        })
    },
    _confirmPopupEvent: function(){
        $('body').on('click', 'a.confirm-popup', function(e){
            e.preventDefault();
            $('#confirmPopup a.action').attr('href', $(this).attr('href'));
            $('#confirmPopup .ask').html($(this).attr('title'));
            $('#confirmPopup').modal('show');
        });
        $('body').on('click', '#confirmPopup .cancel', function(e){
            e.preventDefault();
            $('#confirmPopup').modal('hide');
        });
        return false;
    }

}
Akilliphone.init();
