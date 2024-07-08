<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dimensions
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste des dimensions des bateaux</span>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Add dimension button-->
                <div class="d-flex">
                    <a href="{{ route('boats.dimensions.create', $boat->id) }}" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
                        <i class="ki-duotone ki-plus fs-2"></i>
                    </a>
                </div>
                <!--end::Add dimension button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <main class="flex-grow-1 pb-5 app-container container-xxl">
        <div class="mb-5">
            <!--begin::Table widget-->
            <div class="card card-flush border-0">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Dimensions</h2>
                    </div>
                </div>
                <!--end::Card header-->
                
                <!--begin::Card body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-6 my-0">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500">
                                    <th class="p-0 pb-3">Plage de poids</th>
                                    <th class="p-0 pb-3">Numéro de moule</th>
                                    <th class="p-0 pb-3">Longueur (cm)</th>
                                    <th class="p-0 pb-3">Forme</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody id="dimensions-table">
                                @foreach($dimensions as $dimension)
                                <tr>
                                    <td>{{ $dimension->weight_range }}</td>
                                    <td>{{ $dimension->mold_number }}</td>
                                    <td>{{ $dimension->length_cm }}</td>
                                    <td>{{ $dimension->shape }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('boats.dimensions.edit', [$boat->id, $dimension->id]) }}" class="btn btn-info btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('boats.dimensions.destroy', [$boat->id, $dimension->id]) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" id="delete-{{$dimension->id}}">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <!--end::Table-->
                    
                    <!--begin::Separator-->
                    <div class="separator separator-dashed border-gray-200 mb-n4"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Table widget-->
        </div>
    </main>
</div>

<script>
    // JavaScript for handling dynamic actions if needed
</script>

