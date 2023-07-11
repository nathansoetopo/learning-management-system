@extends('dashboard.mentor.app')
@section('title-mentor', 'Management Materi')
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
                        <h3>Kelola Penugasan</h3>
                    </div>
                    @include('dashboard.mentor.component.breadcumb')
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-success" href="{{route('mentor.tasks.create')}}">Buat Tugas</a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tugas</th>
                                    <th>Kelas</th>
                                    <th>Materi</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{$task->name}}</td>
                                        <td>{{$task->has_class->name}}</td>
                                        <td>{{$task->material->name}}</td>
                                        <td>{{$task->start_date}}</td>
                                        <td>{{$task->end_date}}</td>
                                        <td>
                                            <a href="{{route('mentor.tasks.evaluation', ['id' => $task->id])}}" class="btn btn-info">Nilai</a>
                                            <a class="btn btn-warning" href="{{route('mentor.tasks.edit', ['id' => $task->id])}}">Edit</a>
                                            <button class="btn btn-danger delete" data-title="{{$task->name}}" data-id="{{$task->id}}">Hapus</button>
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
@push('mentorscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        var myTable = $('#table1').DataTable();
    </script>

    @include('dashboard.superadmin.component.script.delete')
@endpush
