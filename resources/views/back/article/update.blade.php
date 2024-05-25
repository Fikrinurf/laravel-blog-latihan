@extends('back.layout.template')

@section('title', 'Update Article - Admin')

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Update Articles</h1>
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
            </div><!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body p-3">
                            <form action="{{ url('article/' . $article->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="oldImg" value="{{ $article->img }}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="title"><b>Title</b></label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title', $article->title) }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="category_id"><b>Category</b></label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                @foreach ($categories as $item)
                                                    @if ($item->id == $article->category_id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @else
                                                    @endif
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="desc">Deskripsi</label>
                                    <textarea name="desc" id="desc" cols="30" rows="10" class="form-control">{{ old('desc', $article->desc) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="img">Image (Max 2MB)</label>
                                    <input type="file" id="img" name="img" class="form-control">
                                    <div class="mt-2">
                                        <small>Gambar Lama</small><br>
                                        <img src="{{ asset('storage/back/' . $article->img) }}" alt=""
                                            width="80px">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="" hidden>-- Pilih --</option>
                                                <option value="1" {{ $article->status == 1 ? 'selected' : null }}>
                                                    Publish</option>
                                                <option value="0" {{ $article->status == 0 ? 'selected' : null }}>
                                                    Private</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="publish_date">Tanggal Publish</label>
                                            <input type="date" name="publish_date" id="publish_date" class="form-control"
                                                value="{{ old('publish_date', $article->publish_date) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <button type="submit" class="btn btn-success text-white">Tambah</button>
                                </div>
                            </form>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endpush
