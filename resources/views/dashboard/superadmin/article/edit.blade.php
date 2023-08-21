@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Edit Blog Baru')
@push('superadminheadscript')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ asset('dashboard') }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/pages/filepond.css">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
@endpush
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Edit Blog</h3>
                        <p class="text-subtitle text-muted">Ubah nama blog, deskripsi dan thumbnail</p>
                    </div>
                    {{-- @include('dashboard.mentor.component.breadcumb') --}}
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Blog</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('superadmin.blog.update', ['id' => $blog->id])}}" class="row" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="basicInput">Judul Blog</label>
                                <input type="text" name="title" class="form-control" id="basicInput" required
                                    placeholder="Masukkan judul blog" value="{{ old('title', $blog->title) }}" autofocus>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="inputCity" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" value="{{ old('image') }}" name="image" id="inputCity">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="inputState" class="form-label">Kategori</label>
                                <select id="inputState" class="form-select" name="category">
                                    <option selected>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{ old('category', $blog->categories->first()->id) == $category->id ? 'selected' : '' }}>{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 pt-3">
                                <label>Konten</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3">{{old('content', $blog->content)}}</textarea>
                            </div>
                            <button class="btn btn-success float-end mt-4" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @push('superadminscript')
        <script src="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/filepond.js"></script>
        <script>
            CKEDITOR.replace( 'content' );
        </script>
    @endpush
@endsection
