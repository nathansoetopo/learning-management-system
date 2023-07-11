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
                        Pilih mentee untuk input nilai
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($class->mentee as $mentee)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$mentee->name}}</td>
                                        <td>{{$mentee->email}}</td>
                                        <td>{{day($mentee->pivot->created_at)}}</td>
                                        <td>
                                            <a href="{{route('mentor.scoring.mentee.input', ['masterClass_id' => $class->masterClass->id, 'mente_id' => $mentee->id, 'class_id' => $class->id])}}" class="btn btn-primary">Input Nilai</a>
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
