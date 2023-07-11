@extends('dashboard.mentor.app')
@section('title-mentor', 'Penilaian')
@section('content-mentor')
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
                        <h3>Kelola Penilaian</h3>
                    </div>
                    @include('dashboard.mentor.component.breadcumb')
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Pilih kelas untuk melihat daftar siswa
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Kelas</th>
                                    <th>Master Class</th>
                                    <th>Kelas Mulai</th>
                                    <th>Kelas Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                    <tr>
                                        <td>{{ $class->name }}</td>
                                        <td>{{ $class->masterClass->name }}</td>
                                        <td>{{ day($class->start_time) }}</td>
                                        <td>{{ day($class->end_time) }}</td>
                                        <td>
                                            <a href="{{ route('mentor.scoring.mentee', ['id' => $class->id]) }}"
                                                class="btn btn-info">Penilaian</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
        </div>
    </div>
@endsection
