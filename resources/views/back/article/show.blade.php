@extends('back.layout.template')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@section('title', 'List Article - Admin')

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Detail Article</h1>
                </div>
            </div><!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <td>: {{ $article->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>: {{ $article->Category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>: {{ $article->desc }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gambar</th>
                                        <td>
                                            <a href="{{ asset('storage/back/' . $article->img) }}" target="_blank"
                                                rel="noopener noreferrer"><img
                                                    src="{{ asset('storage/back/' . $article->img) }}" alt=""
                                                    width="50%"></a>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Views</th>
                                        <td>: {{ $article->views }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        @if ($article->status == 1)
                                            <td>: <span class="badge bg-success">Published</span></td>
                                        @else
                                            <td>: <span class="badge bg-danger">Private</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>Tanggal Publish</th>
                                        <td>: {{ $article->publish_date }}</td>
                                    </tr>
                                    <div class="float-end">
                                        <a href="{{ url('article') }}" class="btn btn-secondary">Kembali</a>
                                    </div>

                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
@endsection
