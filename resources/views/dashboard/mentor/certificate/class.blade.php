@extends('dashboard.mentor.app')
@section('title-mentor', 'Kelola Sertifikat')
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
                        <h3>Menampilkan daftar kelas dan sertifikat</h3>
                        <p class="text-subtitle text-muted">Klik pilih mentee untuk memberikan sertifikat</p>
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mentees as $mentee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mentee->name }}</td>
                                            <td>{{ $mentee->username }}</td>
                                            <td>{{ $mentee->email }}</td>
                                            <td>{{ $mentee->gender }}</td>
                                            <td>
                                                @if ($mentee->certificate_count < 1)
                                                    <button class="btn btn-success btn-attach-{{$mentee->id}} attach" data-id="{{ $mentee->id }}">Beri Sertifikat</button>
                                                @else
                                                    <button class="btn btn-danger btn-attach-{{$mentee->id}} attach" data-id="{{ $mentee->id }}">Tarik Sertifikat</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('mentorscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script>
        var token = $('meta[name=csrf-token]').attr('content')

        $(document).on('click', '.attach', function() {
            var id = $(this).data('id');
            var certificate_id = '{{$data->certificate->certificate_id}}';
            
            $.ajax({
                type: "POST",
                url: '{{route('mentor.certificate.attach', ['id' => $data->id])}}',
                data: {
                    '_token': token,
                    'user_id': id,
                    'certificate_id': certificate_id
                },
                success: function(data) {
                    console.log(data)
                    if(data.data == 'attach'){
                        $('.btn-attach-'+id).removeClass('btn-success').addClass('btn-danger');
                        $('.btn-attach-'+id).text('Tarik Sertifikat');
                    }else{
                        $('.btn-attach-'+id).removeClass('btn-danger').addClass('btn-success');
                        $('.btn-attach-'+id).text('Beri Sertifikat');
                    }
                }
            })
        })
    </script>
@endpush
