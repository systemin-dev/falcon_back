@extends('admin.layouts.app')

@section('title', isset($boatRange) ? 'Modifier une Gamme' : 'Ajouter une Gamme')

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
                    {{ isset($boatRange) ? 'Modifier une Gamme' : 'Ajouter une Gamme' }}
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
            <form method="POST" action="{{ isset($boatRange) ? route('boats.ranges.update', [$boat, $boatRange]) : route('boats.ranges.store', $boat) }}" class="form fv-plugins-bootstrap5 fv-plugins-framework">

                <div class="card mb-5 mb-xl-10">
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        @csrf
                        @if(isset($boatRange))
                        @method('PUT')
                        @endif

                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Informations sur la Gamme</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group name-->
                            <div class="row mb-6">
                                <label for="name" class="col-lg-4 col-form-label required fw-semibold fs-6">Nom</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" id="name" name="name" class="form-control form-control-lg form-control-solid" placeholder="Nom" value="{{ old('name', isset($boatRange) ? $boatRange->name : '') }}" required>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Input group name-->

                            <!--begin::Input group weight-->
                            <div class="row mb-6">
                                <label for="weight" class="col-lg-4 col-form-label required fw-semibold fs-6">Poids</label>
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" id="weight" name="weight" class="form-control form-control-lg form-control-solid" placeholder="Poids" value="{{ old('weight', isset($boatRange) ? $boatRange->weight : '') }}" required>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Input group weight-->

                        </div>
                        <!--end::Card body-->
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('boats.edit', $boat->id) }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Retour</a>
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
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
@endsection