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
                        <h3>Buat Voucher Baru</h3>
                        <p class="text-subtitle text-muted">Masukkan data voucher</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Input</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buat Voucher</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('superadmin.vouchers.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Kode Voucher</label>
                                        <input type="text" name="voucher_code" class="form-control" id="basicInput"
                                            required placeholder="Masukkan kode voucher unik" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Kapasitas Klaim</label>
                                        <input type="number" name="capacity" class="form-control" id="basicInput" required
                                            placeholder="Jumlah maksimal klaim voucher" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Tipe Discount</label>
                                        <select name="discount_type" id="discount_type" class="form-control">
                                            <option value="%">% (Persen)</option>
                                            <option value="-">- (Pengurang)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Nominal Discount</label>
                                        <input type="number" name="nominal" class="form-control" id="nominal" required
                                            placeholder="Nominal Discount" min="0" max="" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-md-4">
                                    <label for="">Tanggal Mulai Berlaku</label>
                                    <div class="form-group mt-2">
                                        <input type="datetime-local" name="start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tanggal Akhir Berlaku</label>
                                    <div class="form-group mt-2">
                                        <input type="datetime-local" name="end_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pilih Master Class</label>
                                    <div class="form-group mt-2">
                                        <select class="form-control" id="master" name="master_class[]"
                                            multiple="multiple">
                                            
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
                $('#master').select2();
                getMasterClass()
            })

            $('#discount_type').on('change', function(){
                var value = $(this).val()
                
                if(value == '%'){
                    $('#nominal').attr({
                        "max" : 100
                    })
                }else{
                    $('#nominal').attr({
                        "max" : null
                    })
                }
            })
        </script>
        @include('dashboard.superadmin.component.script.get-master-class')
    @endpush
@endsection
