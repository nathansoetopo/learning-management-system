@extends('dashboard.mentor.app')
@section('title-mentor', 'Detail Presensi')
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
                        <h3>Semua Absensi</h3>
                        <p class="text-subtitle text-muted">Update status presensi mentee</p>
                    </div>
                    @include('dashboard.mentor.component.breadcumb')
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="detail-track">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Waktu Presensi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presence->users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="#" id="detail" data-name="{{ $user->name }}"
                                                        data-detail="{{ $user->pivot->description }}">{{ $user->name }}</a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->pivot->created_at }}</td>
                                                <td>
                                                    <select name="status" data-user="{{ $user->id }}" id="status"
                                                        class="form-control">
                                                        <option value="">Pilih Aksi</option>
                                                        <option value="done">Setujui</option>
                                                        <option value="reject">Tolak</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    {{-- Modal Detail --}}
    <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-name">
                        <!--Username-->
                    </h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-detail">
                        <!--Detail-->
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Detail --}}
@endsection
@push('mentorscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        var myTable = $('#table1').DataTable();

        $(document).on('click', '#detail', function() {
            var detail = $(this).data('detail')
            var name = $(this).data('name')

            $('.user-name').text(name)
            $('.text-detail').text(detail)

            $('#border-less').modal('show')
        })

        $(document).on('change', '#status', function() {
            var status = $(this).val()
            var user_id = $(this).data('user')

            var url = '{{route('mentor.presence.update.status', ['id' => $presence->id])}}'

            $.ajax({
                type: "PUT",
                url: url,
                data: {
                    '_token': token,
                    'status': status,
                    'user_id': user_id
                },
                success: function(response){
                    console.log(response)
                }
            })
        })
    </script>
@endpush
