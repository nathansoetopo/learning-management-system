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
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>{{ $class->name }}</h3>
                        <p class="text-subtitle text-muted">Hi, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('mentee-class.detail', $class) }}
                        </nav>
                    </div>
                </div>
            </div>
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
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Materi dan Tugas</h4>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    @foreach ($class->masterClass->materials as $material)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                <button class="accordion-button fw-bold" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-{{ $loop->iteration }}"
                                                    aria-expanded="true"
                                                    aria-controls="panelsStayOpen-{{ $loop->iteration }}">
                                                    {{ $material->name }}
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-{{ $loop->iteration }}"
                                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="panelsStayOpen-headingOne">
                                                <div class="accordion-body">
                                                    <p class="text-secondary">{{ $material->description }}</p>
                                                    <div class="container">
                                                        @if (!empty($material->sub_materials))
                                                            <p class="text-primary fw-bold">Bahan Ajaran</p>
                                                            <div class="list-group">
                                                                @foreach ($material->sub_materials as $sub_material)
                                                                    <a href="{{ $sub_material->asset }}" target=”_blank”
                                                                        class="list-group-item list-group-item-action"
                                                                        aria-current="true">
                                                                        {{ $sub_material->name }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        @if (!empty($material->tasks))
                                                            <p class="text-primary fw-bold mt-4">Tugas</p>
                                                            <div class="list-group">
                                                                @foreach ($material->tasks as $task)
                                                                    <a href="{{ route('mentee.tasks.show', ['id' => $task->id]) }}"
                                                                        class="list-group-item list-group-item-action"
                                                                        aria-current="true">
                                                                        {{ $task->name }} / {{ $task->start_date }} -
                                                                        {{ $task->end_date }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tugas Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-lg" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Presensi</th>
                                            <th>Kelas</th>
                                            <th>Ditutup</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Content --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="{{ Auth::user()->avatar }}" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <p class="fw-bold">Mentor</p>
                                    <h5 class="font-bold">{{ $class->mentor->name }}</h5>
                                    <h6 class="text-muted mb-0"><b></b>{{ $class->mentor->email }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Tugas Tersedia</h4>
                        </div>
                        <div class="card-content pb-4">
                            @foreach ($class->tasks as $task)
                                <div class="recent-message d-flex px-4 py-3">
                                    <a href="{{ route('mentee.tasks.show', ['id' => $task->id]) }}">
                                        <div class="name ms-4">
                                            <h5 class="mb-1">{{ $task->name }}</h5>
                                            <h6 class="text-muted mb-0">
                                                {{ day($task->end_date) }}/{{ $task->end_date->toTimeString() }}
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <div class="px-4">
                                <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Lihat Semua</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar" class="container h-100"></div>
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
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script>
        $(document).ready(function() {
            var task_url = "{{ route('mentee.tasks.index') }}"
            loadTasks(task_url)
            loadCalendar()
            loadPresence()
        })

        function loadPresence() {
            myTable = $('#table1').DataTable({
                paging: false,
                info: false,
                lengthChange: false,
                searching: false,
                destroy: true,
                ajax: '{{ route('mentee.presence.index') }}',
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'class'
                    },
                    {
                        data: 'closed_at',
                    },
                    {
                        data: 'url',
                        render: function(data, type, row) {
                            return '<a href="' + data + '" class="btn btn-success">Presensi</a>'
                        }
                    }
                ],
            });
        }
    </script>
    @include('dashboard.mentee.component.calendar-script')
@endpush
