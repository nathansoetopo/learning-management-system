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
                        <h3>Daftar kelas dan sertifikat</h3>
                        <p class="text-subtitle text-muted">Klik pilih mentee untuk memberikan sertifikat</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('mentor-certificate') }}
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
                                        <th>Nama Kelas</th>
                                        <th>Nama Master Class</th>
                                        <th>Nomor Sertifikat</th>
                                        <th>Tanggal Sertifikat</th>
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
            </section>
        </div>
    </div>
@endsection
@push('mentorscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script>
        $(document).ready(function() {
            getCertificate();
        })

        function getCertificate() {
            myTable = $('#table1').DataTable({
                destroy: true,
                ajax: '{{ route('mentor.certificate.index') }}',
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'master_class'
                    },
                    {
                        data: 'certificate_number',
                    },
                    {
                        data: 'realese_date'
                    },
                    {
                        data: 'id',
                        render: function(data, type){
                            return '<a class="btn btn-primary" href="{{url('mentor/certificate')}}/'+data+'">Pilih Mentee</a>';
                        }
                    }
                ],
            });
        }
    </script>
@endpush
