@extends('dashboard.mentee.app')
@section('title-mentee', 'Track Saldo')
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
                        <h3>Tracking Kode</h3>
                        <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery
                            required)</p>
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
                        Jquery Datatable
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Saldo</th>
                                    <th>Waktu</th>
                                    <th>Total Komisi</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $saldo)
                                    <tr>
                                        <td>{{$saldo->username}}</td>
                                        <td>Rp. @money($saldo->total_running)</td>
                                        <td>{{$saldo->created_at}}</td>
                                        <td>Rp. @money($saldo->amount)</td>
                                        <td>
                                            <a href="detail-track.html" style="color: lightgray;"><i
                                                    class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;
                                            <a href="#" style="color: lightgray;"><i
                                                    class="fa fa-trash fa-lg"></i></a>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>

            <script src="assets/js/bootstrap.js"></script>
            <script src="assets/js/app.js"></script>

            <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
            <script src="assets/extensions/jquery/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
            <script src="assets/js/pages/datatables.js"></script>
            <script>
                function openFormTrack1() {
                    document.getElementById("myFormTrack1").style.display = "block";
                }

                function closeFormTrack1() {
                    document.getElementById("myFormTrack1").style.display = "none";
                }
            </script>
            <script>
                function openFormTrack2() {
                    document.getElementById("myFormTrack2").style.display = "block";
                }

                function closeFormTrack2() {
                    document.getElementById("myFormTrack2").style.display = "none";
                }
            </script>
        </div>
    </div>
@endsection
