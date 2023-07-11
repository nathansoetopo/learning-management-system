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
                    @include('dashboard.mentor.component.breadcumb')
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
                                            <td><a href="#" id="recapbtn" data-user="{{$mentee->id}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">{{ $mentee->name }}</a></td>
                                            <td>{{ $mentee->username }}</td>
                                            <td>{{ $mentee->email }}</td>
                                            <td>{{ $mentee->gender }}</td>
                                            <td>
                                                @if ($mentee->certificate_count < 1)
                                                    <button class="btn btn-success btn-attach-{{ $mentee->id }} attach"
                                                        data-id="{{ $mentee->id }}">Beri Sertifikat</button>
                                                @else
                                                    <button class="btn btn-danger btn-attach-{{ $mentee->id }} attach"
                                                        data-id="{{ $mentee->id }}">Tarik Sertifikat</button>
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
    {{-- Detail Modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Rekapitulasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Presensi = <span id="pres"></span></p>
                    <div class="container-fluid" id="recappresence"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('mentorscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script>
        var token = $('meta[name=csrf-token]').attr('content')

        $(document).on('click', '#recapbtn', function(){
            var user_id = $(this).data('user')
            var class_id = '{{$data->id}}'

            $.ajax({
                type: "GET",
                url: '{{ url('mentor/presence') }}/'+user_id+'/'+class_id+'/recap',
                success: function(data) {
                    $('#pres').text(data.result+'%')
                    $('#recappresence').html(data.data)
                }
            })
        })

        $(document).on('click', '.attach', function() {
            var id = $(this).data('id');
            var certificate_id = '{{ $data->certificate->certificate_id }}';

            $.ajax({
                type: "POST",
                url: '{{ route('mentor.certificate.attach', ['id' => $data->id]) }}',
                data: {
                    '_token': token,
                    'user_id': id,
                    'certificate_id': certificate_id
                },
                success: function(data) {
                    console.log(data)
                    if (data.data == 'attach') {
                        $('.btn-attach-' + id).removeClass('btn-success').addClass('btn-danger');
                        $('.btn-attach-' + id).text('Tarik Sertifikat');
                    } else {
                        $('.btn-attach-' + id).removeClass('btn-danger').addClass('btn-success');
                        $('.btn-attach-' + id).text('Beri Sertifikat');
                    }
                }
            })
        })
    </script>
@endpush
