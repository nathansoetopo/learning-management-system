@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Kelola Blog')
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
                        <h3>Kelola Blog</h3>
                        <p class="text-subtitle text-muted">Buat, Edit dan Hapus Blog</p>
                    </div>
                    {{-- @include('dashboard.mentor.component.breadcumb') --}}
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('superadmin.blog.create') }}" class="btn btn-primary">Tambah Blog</a>
                        <a href="{{ route('superadmin.blog.category.index') }}" class="btn btn-primary">Kelola Kategori</a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Penerbit</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->user->name }}</td>
                                        <td>{{ day($blog->created_at) }}</td>
                                        <td>
                                            <a class="btn btn-warning text-white"
                                                href="{{ route('superadmin.blog.edit', ['id' => $blog->id]) }}">Edit</a>
                                            <button class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal{{$blog->id}}">Hapus</button>
                                        </td>
                                    </tr>
                                    {{-- Modal Delete --}}
                                    <div class="modal fade" id="deleteModal{{$blog->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Blog</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin hapus blog "{{$blog->title}}"
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('superadmin.blog.delete', ['id' => $blog->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" type="submit">Save changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
        </div>
    </div>
    @push('superadminscript')
        <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

        <script>
            var token = $('meta[name=csrf-token]').attr('content')
            var myTable = $('#table1').DataTable();
        </script>
    @endpush
@endsection
