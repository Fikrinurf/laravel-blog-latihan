@extends('back.layout.template')
@section('title', 'List Category - Admin')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Category</h1>
                    <button class="btn btn-success text-white mt-4" data-bs-toggle="modal"
                        data-bs-target="#modalCreate">Tambah</button>
                </div>
                @if ($errors->any())
                    <div class="mt-3">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mt-3">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
            </div><!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">No</th>
                                            <th class="cell">Name</th>
                                            <th class="cell">Slug</th>
                                            <th class="cell">Created At</th>
                                            <th class="cell">Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td class="cell">{{ $loop->iteration }}</td>
                                                <td class="cell">{{ $item->name }}</td>
                                                <td class="cell">{{ $item->slug }}</td>
                                                <td class="cell">{{ $item->created_at }}</td>
                                                <td class="cell">
                                                    <button class="btn btn-info text-white" data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdate{{ $item->id }}">Edit</button>
                                                    <button class="btn btn-danger text-white" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete{{ $item->id }}">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->



        </div><!--//container-fluid-->
    </div><!--//app-content-->

    {{-- modal untuk Create --}}
    @include('back.category.create-modal')

    {{-- modal untuk Update --}}
    @include('back.category.update-modal')

    {{-- modal untuk delete --}}
    @include('back.category.delete-modal')

@endsection
