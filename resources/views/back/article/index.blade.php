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
                    <h1 class="app-page-title mb-0">Articles</h1>
                    <a href="{{ 'article/create' }}" class="btn btn-success text-white mt-4">Tambah</a>
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
                                <table class="table app-table-hover mb-0 text-left" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="cell">No</th>
                                            <th class="cell">Title</th>
                                            <th class="cell">Category</th>
                                            <th class="cell">Views</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Publish Date</th>
                                            <th class="cell">Function</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($articles as $item)
                                            <tr>
                                                <td class="cell">{{ $loop->iteration }}</td>
                                                <td class="cell">{{ $item->title }}</td>
                                                <td class="cell">{{ $item->Category->name }}</td>
                                                <td class="cell">{{ $item->views }}</td>
                                                @if ($item->status == 0)
                                                    <td class="cell">
                                                        <span class="badge bg-danger">Private</span>
                                                    </td>
                                                @else
                                                    <td class="cell">
                                                        <span class="badge bg-success">Published</span>
                                                    </td>
                                                @endif

                                                <td class="cell">{{ $item->publish_date }}</td>
                                                <td class="cell">
                                                    <a href="" class="btn btn-secondary text-white">Detail</a>
                                                    <a href="" class="btn btn-primary text-white">Edit</a>
                                                    <a href="" class="btn btn-danger text-white">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverside: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',

                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'views',
                        name: 'views'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'publish_date',
                        name: 'publish_date'
                    },
                    {
                        data: 'button',
                        name: 'button'
                    },
                ]
            });
        });
    </script>
@endpush
