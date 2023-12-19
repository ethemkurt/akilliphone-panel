
@extends('layouts/contentLayoutMaster')

@section('title', 'Hata Logları')

@section('page-style')
    {{-- Page css files --}}
@endsection
<link rel="stylesheet" href="{{ asset('vendors/jquery.json-viewer/jquery.json-viewer.css') }}" />

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="settings">
        <div class="row match-height">

            <!-- Statistics Card -->
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        @if($log)
                            <textarea style="display: none" id="json-input" >{{ json_encode($log, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)  }}</textarea>
                            <pre id="json-renderer"></pre>
                        @else
                            Log Bulunamadı
                        @endif
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
@endsection
@section('page-script')
    <script src="{{ asset('vendors/jquery.json-viewer/jquery.json-viewer.js') }}"></script>
    <script id="json-viewer">
        $(function() {
            function renderJson() {
                try {
                    var input = eval('(' + $('#json-input').val() + ')');
                }
                catch (error) {
                    return alert("Cannot eval JSON: " + error);
                }
                var options = {
                    collapsed: $('#collapsed').is(':checked'),
                    rootCollapsable: $('#root-collapsable').is(':checked'),
                    withQuotes: $('#with-quotes').is(':checked'),
                    withLinks: $('#with-links').is(':checked')
                };
                $('#json-renderer').jsonViewer(input, options);
            }

            // Generate on click
            $('#btn-json-viewer').click(renderJson);

            // Generate on option change
            $('p.options input[type=checkbox]').click(renderJson);

            // Display JSON sample on page load
            renderJson();
        });
    </script>

@endsection
