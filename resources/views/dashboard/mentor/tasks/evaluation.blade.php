@extends('dashboard.mentor.app')
@section('title-mentor', 'Penilaian Tugas')
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
                        <h3>Penilaian Tugas {{ $task->name }}</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">DataTable Jquery</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Input Nilai
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Attachment</th>
                                    <th>Submit Date</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($task->users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->pivot->status }}</td>
                                        <td><a href="{{ $user->pivot->url }}" target="_blank">Lihat</a></td>
                                        <td>{{ $user->pivot->submit_date }}</td>
                                        <td>
                                            <input type="number" data-user="{{ $user->id }}" min="0"
                                                max="100" class="form-control" id="score"
                                                value="{{ $user->pivot->score }}">
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

        $(document).on('keyup', '#score', function() {
            var score = $(this).val()
            var user_id = $(this).data('user')

            $.ajax({
                type: "PUT",
                url: '{{route('mentor.tasks.scoring', ['id' => $task->id])}}',
                data: {
                    '_token': token,
                    'score' : score,
                    'user_id': user_id
                },
                success: function(response){
                    console.log(response)
                }
            })
        })
    </script>
@endpush
