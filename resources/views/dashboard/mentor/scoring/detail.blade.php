@extends('dashboard.mentor.app')
@section('title-mentor', 'Input Nilai')
@section('content-mentor')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            {{-- <h3>{{ $class->name }}</h3> --}}
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Materi</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="accordion" id="accordionPanelsStayOpenExample">
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
                                </div> --}}
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
