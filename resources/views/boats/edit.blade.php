@extends('admin.layouts.app')

@section('title', isset($boat) ? 'Modifier un Bateau' : 'Ajouter un Bateau')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ isset($boat) ? 'Modifier un Bateau' : 'Ajouter un Bateau' }}
                </h1>
            </div>
        </div>
    </div>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form method="POST" action="{{ isset($boat) ? route('boats.update', $boat->id) : route('boats.store') }}" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework mb-5 mb-xl-10" enctype="multipart/form-data" id="kt_account_profile_details_submit">
                        @csrf
                        @if (isset($boat))
                        @method('PUT')
                        @endif

                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Image</h2>
                                    </div>
                                </div>
                                <div class="card-body text-center pt-0">
                                    <style>
                                        .image-input-placeholder {
                                            background-image: url("{{ isset($boat) ? asset('storage/' . $boat->image) : asset('/assets/media/svg/files/blank-image.svg') }}");
                                        }

                                        [data-bs-theme="dark"] .image-input-placeholder {
                                            background-image: url("{{ isset($boat) ? asset('storage/' . $boat->image) : asset('/assets/media/svg/files/blank-image-dark.svg') }}");
                                        }
                                    </style>
                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px"></div>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                            <input type="file" name="image" id="image">
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                        </span>
                                    </div>
                                    <div class="text-muted fs-7">Ajouter l'image du bateau</div>
                                </div>
                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Catégorie</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <select class="form-select mb-2" id="category" name="category" required>
                                        <option value="">Sélectionnez la catégorie du bateau</option>
                                        @foreach(\App\Models\Boat::CATEGORIES as $key => $label)
                                        <option value="{{ $key }}" {{ old('category', isset($boat) && $boat->category == $key ? $key : '') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="text-muted fs-7">Ajouter une catégorie au bateau</div>
                                </div>

                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>État</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <select class="form-select mb-2" id="condition" name="condition" required>
                                        <option value="">Sélectionnez l'état</option>
                                        <option value="new" {{ old('condition', isset($boat) && $boat->condition == 'new' ? 'new' : '') == 'new' ? 'selected' : '' }}>Neuf</option>
                                        <option value="used" {{ old('condition', isset($boat) && $boat->condition == 'used' ? 'used' : '') == 'used' ? 'selected' : '' }}>Utilisé</option>
                                        <option value="needs repair" {{ old('condition', isset($boat) && $boat->condition == 'needs repair' ? 'needs repair' : '') == 'needs repair' ? 'selected' : '' }}>À réparer</option>
                                    </select>
                                    <div class="text-muted fs-7">Sélectionner l'état du bateau</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2" role="tablist">
                                @foreach ($locales as $locale)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4 {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_ecommerce_add_product_{{ $locale }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" role="tab" id="{{$locale}}">
                                        {{ strtoupper($locale) }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($locales as $locale)
                                @php
                                $translation = isset($boat) ? $boat->translations->where('locale', $locale)->first() : null;
                                @endphp
                                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="kt_ecommerce_add_product_{{ $locale }}" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10" style="max-width: 927.5px;">
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>{{ strtoupper($locale) }}</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Description</label>
                                                    <input type="text" id="description_{{ $locale }}" name="translations[{{ $locale }}][description]" class="form-control mb-2" placeholder="Description" value="{{ old('translations.'.$locale.'.description', $translation ? $translation->description : '') }}">
                                                    <div class="text-muted fs-7">Description du bateau</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Base</label>
                                                    <input type="text" id="base_{{ $locale }}" name="translations[{{ $locale }}][base]" class="form-control mb-2" placeholder="Base" value="{{ old('translations.'.$locale.'.base', $translation ? $translation->base : '') }}">
                                                    <div class="text-muted fs-7">Base du bateau</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Type de Construction</label>
                                                    <input type="text" id="construction_type_{{ $locale }}" name="translations[{{ $locale }}][construction_type]" class="form-control mb-2" placeholder="Type de Construction" value="{{ old('translations.'.$locale.'.construction_type', $translation ? $translation->construction_type : '') }}">
                                                    <div class="text-muted fs-7">Type de construction du bateau</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">Plat Bord</label>
                                                    <input type="text" id="flat_board_{{ $locale }}" name="translations[{{ $locale }}][flat_board]" class="form-control mb-2" placeholder="Plat Bord" value="{{ old('translations.'.$locale.'.flat_board', $translation ? $translation->flat_board : '') }}">
                                                    <div class="text-muted fs-7">Plat bord du bateau</div>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="">
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('boats.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Retour</a>
                                    <button type="submit" id="{{ isset($boat) ? 'update' : 'store' }}" class="btn btn-primary">
                                        <span class="indicator-label">Enregistrer</span>
                                        <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!--begin::Dimensions-->
        @if(isset($boat) )
        @include('boats.dimensions.index' , ['dimensions' => $boat->dimensions])
        @endif

        <!--begin::BoatRanges-->
        @if(isset($boat))
        @include('boats.boat_ranges.index' , ['boatRanges' => $boat->boatRanges])
        @endif
        <!--end::BoatRanges-->
    </div>
</div>
@endsection