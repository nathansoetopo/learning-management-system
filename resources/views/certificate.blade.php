<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Download Sertifikat</title>
    <style>
        .outer-border {
            width: 800px;
            min-height: 600px;
            height: fit-content;
            padding: 20px;
            text-align: center;
            border: 10px solid #673AB7;
            margin-left: 21%;
        }

        .inner-dotted-border {
            width: 750px;
            min-height: 600px;
            height: fit-content;
            padding: 20px;
            text-align: center;
            border: 5px solid #673AB7;
            border-style: dotted;
        }

        .certification {
            font-size: 50px;
            font-weight: bold;
            color: #663ab7;
        }

        .certify {
            font-size: 25px;
        }

        .name {
            font-size: 30px;
            color: green;
        }

        .fs-30 {
            font-size: 30px;
        }

        .fs-20 {
            font-size: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        thead th {
            width: 25%;
        }
    </style>
</head>

<body>
    <div class="outer-border">
        <div class="inner-dotted-border">
            <span class="certification">Sertifikat</span>
            <br>
            <p>{{ $certificate->certificate_number }}</p>
            <br>
            <span class="certify"><i>Mempersembahkan sertifikat kepada</i></span>
            <br><br>
            <span class="name"><b>{{ $user->name }}</b></span><br /><br />
            <span class="certify"><i>sudah menyelesaikan kelas</i></span> <br /><br />
            <span class="fs-30">{{ $data->first()->masterClass->name }}</span> <br /><br />
            <span class="fs-20">dengan predikat <b>{{ getPredicate($final_avg) }}</b></span> <br /><br />
            <span class="certify"><i>tanggal</i></span><br>
            <span class="fs-30">{{ day($certificate->realese_date) }}</span>
        </div>
    </div>

    <div style="page-break-before: always;"></div>

    <div class="outer-border">
        <div class="inner-dotted-border">
            <div class="container-fluid">
                <caption>Laporan Nilai Mentee</caption>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Kompetensi</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Hasil</th>
                            <th scope="col">Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $material)
                            <tr>
                                <td width="40">{{ $material->name }}</td>
                                <td>{{ $material->description }}</td>
                                <td width="10">{{ $material->score->average }}</td>
                                <td width="10">{{ $material->score->predicate }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
