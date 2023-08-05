@extends('dashboard.mentee.app')
@section('title-mentee', 'Dashboard Mentee')
@section('content-mentee')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>{{ $class->name }}</h3>
        </div>
        <div class="page-content">
            <section class="row">
                @if (!empty($certificate))
                    <div class="alert alert-success"><i class="bi bi-check-circle"></i> Selamat!!! kamu sudah menyelesaikan
                        kelas, <a
                            href="{{ route('mentee.certificate', ['master_class_id' => $certificate->master_class_id, 'certificate_id' => $certificate->id]) }}"
                            target="_blank">Klik
                            disini</a> untuk sertifikat</div>
                @endif
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Webinar</h4>
                            </div>
                            <div class="card-body">
                                @if ($presences->count() > 0)
                                    <h6>Presensi</h6>
                                    @foreach ($presences as $presence)
                                    @if ($presence->users->count())
                                    <div class="alert alert-warning" role="alert">
                                        Presensi {{$presence->name}} tersedia, <a href="{{route('mentee.presence.index')}}" class="alert-link">klik disini</a>.
                                    </div>
                                    @endif
                                    @endforeach
                                @endif

                                <h6>Deskripsi {{ $class->masterClass->name }}</h6>
                                <p>{{ $class->masterClass->name }}</p>

                                <h6>Topik</h6>
                                <p>{{ $class->description }}</p>

                                <h6>Link Pertemuan</h6>
                                @if ($class->start_time >= now())
                                    <span class="badge bg-danger">Link Belum Tersedia</span>
                                @elseif ($class->end_time <= now())
                                    <span class="badge bg-danger">Webinar Sudah Selesai</span>
                                @else
                                    <a href="{{ $class->link }}">{{ $class->link }}</a>
                                @endif

                                <h6 class="mt-3">Tanggal</h6>
                                <p>{{ day($class->start_time) }} / {{ $class->start_time->format('H:i') }} WIB</p>

                                <h6 class="mt-3">Waktu</h6>
                                <p>{{ $class->start_time->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="https://saugi.me">Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
@endsection
@push('menteescript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
@endpush
