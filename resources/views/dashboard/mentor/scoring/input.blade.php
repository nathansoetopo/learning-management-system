@extends('dashboard.mentor.app')
@section('title-mentor', 'Penilaian')
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
                        <h3>{{$user->name}}</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('mentor-scoring.user', $class_id, $user, $id) }}
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Masukkan nilai mentee
                    </div>
                    <div class="card-body">
                        <div class="table-resposive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Materi</th>
                                        <th>Deskripsi</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materials as $material)
                                        <tr>
                                            <td width="20%">{{ $material->name }}</td>
                                            <td width="60%">{{ $material->description }}</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                data-material="{{ $material->id }}" id="input"
                                                placeholder="{{ $data->contains('material_id', $material->id) ? $data->where('material_id', $material->id)->first()->task_score : 0 }}" value="{{$material->score->average ?? ''}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
        </div>
    </div>
@endsection
@push('mentorscript')
    <script>
        var token = $('meta[name=csrf-token]').attr('content')

        $(document).on('keyup', '#input', function() {
            var material_id = $(this).data('material')
            var score = $(this).val()

            storeScore(material_id, score)
        })

        function storeScore(material_id, score) {
            $.ajax({
                type: "POST",
                url: '{{route('mentor.scoring.store')}}',
                data: {
                    '_token': token,
                    'material_id': material_id,
                    'score': score,
                    'user_id': '{{$user_id}}',
                    'class_id': '{{$class_id}}'
                },
                success: function(response){
                    console.log(response)
                }
            })
        }
    </script>
@endpush
