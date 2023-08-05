@extends('dashboard.mentee.app')
@section('title-mentee', 'Daftar Presensi')
@section('content-mentee')
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
                        <h3>Semua Presensi</h3>
                        <p class="text-subtitle text-muted">Hi, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('mentee-presence') }}
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4>Presensi Tersedia</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($presences as $presence)
                                @if ($presence->users->count() > 0)
                                    <div class="col-sm-4">
                                        <div class="card bg-light-danger">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $presence->name }}</h5>
                                                <p class="card-text">{{ $presence->class->name }}</p>
                                                <small>{{ $presence->open_clock }} - {{ $presence->closed_clock }}</small>
                                                <br><br>
                                                <button type="button" id="presence" data-id="{{ $presence->id }}"
                                                    data-name="{{ $presence->name }}"
                                                    class="btn btn-danger">Presensi</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade text-left" id="modalpresence" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Absensi</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" method="POST" id="presenceform">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label>Presensi: </label>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" required readonly>
                        </div>
                        <label>Masukkan Catatan Pertemuan: </label>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" form="presenceform" class="btn btn-warning ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
@endsection
@push('menteescript')
    <script>
        $(document).on('click', '#presence', function() {
            var id = $(this).data('id')
            var name = $(this).data('name')

            var url = '{{ route('mentee.presence.submit', ':presenceId') }}'

            url = url.replace(':presenceId', id);

            $('input[name=name]').val(name);
            $('#presenceform').attr('action', url)

            $('#modalpresence').modal('show')
        })
    </script>
@endpush
