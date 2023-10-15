<form class="ajax-form" method="post" action="{{ route('order.status-save') }}">
    <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Add New Address</h1>
    <p class="address-subtitle text-center mb-2 pb-75">Add address for billing address</p>
    <div class="col-12">
        <div class="row custom-options-checkable">
            <div class="col-md-6 mb-md-0 mb-2">
                <input class="custom-option-item-check" id="homeAddressRadio" type="radio" name="newAddress" value="HomeAddress" checked="">
                <label for="homeAddressRadio" class="custom-option-item px-2 py-1">
                                                    <span class="d-flex align-items-center mb-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home font-medium-4 me-50"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                                        <span class="custom-option-item-title h4 fw-bolder mb-0">Home</span>
                                                    </span>
                    <span class="d-block">Delivery time (7am – 9pm)</span>
                </label>
            </div>
            <div class="col-md-6 mb-md-0 mb-2">
                <input class="custom-option-item-check" id="officeAddressRadio" type="radio" name="newAddress" value="OfficeAddress">
                <label for="officeAddressRadio" class="custom-option-item px-2 py-1">
                                                    <span class="d-flex align-items-center mb-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase font-medium-4 me-50"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                                        <span class="custom-option-item-title h4 fw-bolder mb-0">Office</span>
                                                    </span>
                    <span class="d-block">Delivery time (10am – 6pm)</span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label" for="modalAddressCountry">Country</label>
        <div class="position-relative">
            <div class="position-relative">
                <input class="form-control" value="" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="fas fas-save"></i> Kaydet</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
