<?php
$dt = isset($dataTable)?$dataTable:null;
?>
@if($dt)
    <style>
        .dataTables_wrapper .row:first-child{
            padding: 1.5rem 1.5rem!important;
        }
        .dataTables_wrapper .row:last-child{
            padding: 1.5rem 1.5rem!important;
        }
        .action-buttons{
            text-align: right;
        }
    </style>
    {!!  $dt->filters() !!}
    <div class="card-datatable table-responsive pt-0">
        <table id="{{ $dt->tableId() }}" class="table-{{ $dt->tableId() }}{{ $dt->tableId() }} table">
            <thead class="table-light">
            <tr>
                @foreach($dt->cols() as $key=>$col)
                    <th class="col-{{$key}}">{{$col['title']}}</th>
                @endforeach
            </tr>
            </thead>
        </table>
    </div>
    @section('dataTable-script')
        <script>
            var manageTable ;
            $(document).ready(function(){

                let args = {
                    searching: true,
                    columns               : [@foreach($dt->cols() as $key => $col){data: "{{$key}}", className:"{{$col["className"]}}"},@endforeach],
                    columnDefs            : [
                            @php $int=0;@endphp
                            @foreach($dt->cols() as $key => $col){
                            targets  : [{{$int++}}],
                            className: "{{$col["className"]}}",
                            orderable: !!{{intval($col["orderable"])}},
                        },@endforeach],
                    ajax_url: '{{$dt->url()}}',


                    /*ajax_data: function(d){
                        if($('.datatable-filer').length){
                            $('.datatable-filer').each(function(){
                                console.log(d);
                            });
                        }
                    },*/
                    ajax_success : function(json){
                        return json.data;
                    },
                    initComplete : function () {
                    },
                };
                createDataTable($('#{{ $dt->tableId() }}'), args);
                function createDataTable(elem, args) {
                    if (elem.length) {
                        manageTable = elem.DataTable({
                            columns: args.columns,
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: '{{$dt->url()}}',
                                data: function (d) {
                                    d['where'] = {};
                                    if($('.datatable-filter').length){
                                        $('.datatable-filter').each(function(){
                                            if (typeof $(this).attr('name') !== "undefined") {
                                                d['where'][$(this).attr('name')] = $(this).val();
                                            }
                                        });
                                    }
                                }
                            },
                            lengthMenu: [
                                [25, 50, 100],
                                [25, 50, 100]
                            ],
                            initComplete: function () {

                            },
                        })
                        $('.datatable-filter').on('change', function(){
                            elem.DataTable().ajax.reload();
                        });
                    }
                }
            });
            $.fn.dataTable.ext.buttons.reload = {
                text: 'Reload',
                action: function ( e, dt, node, config ) {
                    dt.ajax.reload();
                }
            };
        </script>
    @endsection
@else
    <div class="p-3">Data table oluşturulamadı</div>
@endif

