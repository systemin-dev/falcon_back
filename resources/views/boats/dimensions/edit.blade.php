@extends('admin.layouts.app')

@section('title', isset($dimension) ? 'Modifier une Dimension' : 'Ajouter une Dimension')

@section('content')
<div class="d-flex flex-column flex-column-fluid">

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ isset($dimension) ? 'Modifier' : 'Ajouter' }} une Dimension pour {{ $boat->getCategoryLabel($boat->category) }}
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Basic info-->
            <form method="POST" action="{{ isset($dimension) ? route('boats.dimensions.update', ['boat' => $boat, 'dimension' => $dimension]) : route('boats.dimensions.store', $boat) }}" class="form fv-plugins-bootstrap5 fv-plugins-framework" id="kt_account_profile_details_submit">

                <div class="card mb-5 mb-xl-10">
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        @csrf
                        @if(isset($dimension))
                        @method('PUT')
                        @endif

                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group weight_range-->
                            <div class="row mb-6">
                                <label for="weight_range" class="col-lg-4 col-form-label required fw-semibold fs-6">Plage de poids</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="weight_range" id="weight_range" class="form-control form-control-lg form-control-solid" value="{{ old('weight_range', isset($dimension) ? $dimension->weight_range : '') }}" required>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Input group weight_range-->

                            <!--begin::Input group mold_number-->
                            <div class="row mb-6">
                                <label for="mold_number" class="col-lg-4 col-form-label required fw-semibold fs-6">Numéro de moule</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="mold_number" id="mold_number" class="form-control form-control-lg form-control-solid" value="{{ old('mold_number', isset($dimension) ? $dimension->mold_number : '') }}" required>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Input group mold_number-->

                            <!--begin::Input group length_cm-->
                            <div class="row mb-6">
                                <label for="length_cm" class="col-lg-4 col-form-label required fw-semibold fs-6">Longueur (cm)</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="length_cm" id="length_cm" class="form-control form-control-lg form-control-solid" value="{{ old('length_cm', isset($dimension) ? $dimension->length_cm : '') }}" required>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Input group length_cm-->

                            <!--begin::Input group boat_type-->
                            <!-- <div class="row mb-6">
                                <label for="boat_type" class="col-lg-4 col-form-label required fw-semibold fs-6">Type de bateau</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="boat_type" id="boat_type" class="form-control form-control-lg form-control-solid" value="{{ old('boat_type', isset($boat->category) ? $boat->category : '') }}" required>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div> -->
                            <input type="hidden" name="boat_type" id="boat_type" value="{{ old('boat_type', isset($boat->category) ? $boat->category : '') }}" required>

                            <!--end::Input group boat_type-->

                            <!--begin::Input group shape-->
                            <div class="row mb-6">
                                <label for="shape" class="col-lg-4 col-form-label required fw-semibold fs-6">Forme</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="shape" id="shape" class="form-control form-control-lg form-control-solid" value="{{ old('shape', isset($dimension) ? $dimension->shape : '') }}" required>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Input group shape-->
                        </div>
                        <!--end::Card body-->

                        <!--begin::Actions-->

                        <!--end::Actions-->

                        <!--end::Form-->
                    </div>

                    <!--end::Content-->
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('boats.edit', $boat) }}" class="btn btn-light me-5">Retour</a>
                    <button type="submit" id="{{ isset($dimension) ? 'update' : 'store' }}" class="btn btn-primary">
                        <span class="indicator-label">Enregistrer</span>
                        <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
            <!--end::Basic info-->
        </div>

        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<script>
    document.getElementById('kt_account_profile_details_submit').addEventListener('submit', function() {
        let weightRangeInput = document.getElementById('weight_range');
        weightRangeInput.value = weightRangeInput.value.replace(',', '.');
    });
</script>

@endsection