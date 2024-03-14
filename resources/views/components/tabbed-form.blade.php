<?php
$forms = isset($forms)?$forms:[]
?>
@if($forms)
    <div class="bs-stepper wizard-numbered mt-2">
        <div class="bs-stepper-header">
            @foreach($forms as $form)
                <div class="step" data-target="#{{ $form['code'] }}">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">1</span>
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
            <form onSubmit="return false">
                <!-- Account Details -->
                @foreach($forms as $form)
                    @include('Product.tabs.'.$form['file'])
                @endforeach
            </form>
        </div>
    </div>
@endif

