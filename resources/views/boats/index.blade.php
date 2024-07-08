@extends('admin.layouts.app')

@section('title', 'Gestion des bateaux')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Bateaux
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste de vos bateaux</span>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="d-flex">
                    <a href="{{ route('boats.create') }}" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
                        <i class="ki-duotone ki-plus fs-2"></i>
                    </a>
                </div>
                <!--end::Filter menu-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <main class="flex-grow-1 pb-5 app-container container-xxl">
        <div class="mb-5">
            <!--begin::Table widget 17-->
            <div class="card card-flush border-0">
                <!--begin::Body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-6 my-0">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500">
                                    <th class="p-0 pb-3 w-150px text-start">DESCRIPTION</th>
                                    <th class="p-0 pb-3 min-w-100px text-center">ÉTAT</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody id="boats-table">
                                @foreach ($boats as $boat)
                                <tr>

                                    <td> <span class="text-gray-800 fw-bold fs-6 d-block text-start">
                                            {{ $boat->translations->first()->description ?? 'Titre non disponible' }}
                                        </span></td>
                                    <td> <span class="text-gray-800 fw-bold fs-6 d-block text-center">
                                            {{ \App\Models\Boat::getConditionLabel($boat->condition) }}
                                        </span></td>
                                    <td class="text-end">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('boats.edit', $boat->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('boats.destroy', $boat->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit" id="delete-{{$boat->id}}"><i class="bi bi-trash3"></i></button>
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

                    @include('layouts.pagination', ['items' => $boats])


                    <!--end::Pagination-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Table widget 17-->
        </div>
</div>
</main>

<script>
    document.getElementById('search-input').addEventListener('input', function() {
        const query = this.value;
        fetch(`/admin/boats/search?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const boatsTable = document.getElementById('boats-table');
                boatsTable.innerHTML = data.html;
            });
    });
</script>

@endsection