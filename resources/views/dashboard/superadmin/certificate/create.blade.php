@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Buat Voucher Baru')
@push('superadminheadscript')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.css">
@endpush
@section('content')
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
                        <h3>Buat Sertifikat Baru</h3>
                        <p class="text-subtitle text-muted">Masukkan data sertifikat</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('certificate.create') }}
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buat Sertifikat</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('superadmin.certificate.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Nomor Sertifikat</label>
                                        <input type="text" name="certificate_number" class="form-control" id="basicInput"
                                            required placeholder="Masukkan nomor sertifikat harus unik" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Tanggal dan Waktu Sertifikat</label>
                                        <input type="datetime-local" name="realese_date" class="form-control"
                                            id="basicInput" required placeholder="Tanggal dan waktu sertifikat" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="masterClass">Pilih Master Class</label>
                                        <select name="master_class_id" id="masterClass" class="form-control">
                                            <option value="">Pilih Master Class</option>
                                            @foreach ($masterClasses as $masterClass)
                                                <option value="{{ $masterClass->id }}">{{ $masterClass->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="class">Pilih Kelas</label>
                                    <div class="form-group mt-2">
                                        <select class="form-control" id="class" name="class_id[]" multiple="multiple">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success float-end" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @push('superadminscript')
        <script src="{{ asset('dashboard') }}/assets/js/pages/form-element-select.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#class').select2();
                $('#masterClass').select2();
            })

            $('#masterClass').on('change', function() {
                var masterClassId = $(this).val()

                getClass(masterClassId)
            })

            function getClass(masterClassId) {
                $.ajax({
                    type: "GET",
                    url: '{{ url('superadmin/class') }}?id=' + masterClassId + '&certified=1',
                    success: function(response) {
                        $('#class').empty();
                        $('#class').append($('<option>', {
                            value: '',
                            text: 'Pilih Kelas'
                        }));
                        $.each(response, function(i, res) {
                            $('#class').append($('<option>', {
                                value: res.id,
                                text: res.name
                            }));
                        });
                    },
                })
            }
        </script>
    @endpush
@endsection
