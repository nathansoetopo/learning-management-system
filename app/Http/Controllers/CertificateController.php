<?php

namespace App\Http\Controllers;

use \PDF;
use App\Models\User;
use App\Models\Predicate;
use App\Models\ClassModel;
use App\Models\MasterClass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\DetachCertificate;
use Illuminate\Support\Facades\DB;
use App\Models\MasterClassMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CertificateStoreRequest;
use App\Http\Requests\CertificateUpdateRequest;
use App\Http\Resources\CertificateClassResource;
use App\Services\Certificate\CertificateService;

class CertificateController extends Controller
{
    private $certivicateService;

    public function __construct(CertificateService $certificateService)
    {
        $this->certivicateService = $certificateService;
    }

    public function index(Request $request){

        $certificates = $this->certivicateService->index();

        if($request->ajax()){

            return response()->json([
                'data' => $certificates
            ]);
        }

        return view('dashboard.superadmin.certificate.index');
    }

    public function create(){
        $masterClasses = MasterClass::where('status', 'active')->get();

        return view('dashboard.superadmin.certificate.create', compact('masterClasses'));
    }

    public function store(CertificateStoreRequest $request){
        $request = [
            'data' => $request->except(['_token', 'class_id']),
            'class' => $request->only('class_id')
        ];

        $insert = $this->certivicateService->store($request);

        return $insert ? redirect()->route('superadmin.certificate.index')->with('success', 'Sertifikat Berhasil Ditambahkan') : redirect()->back()->withErrors('Sertifikat Gagal Ditambahkan');
    }

    public function edit($id){
        $masterClasses = MasterClass::where('status', 'active')->get();
        $certificate = $this->certivicateService->show($id);

        return view('dashboard.superadmin.certificate.edit', compact('masterClasses', 'certificate'));
    }

    public function update(CertificateUpdateRequest $request, $id){
        $request = [
            'data' => $request->except(['_token', 'class_id']),
            'class' => $request->only('class_id')
        ];

        $update = $this->certivicateService->update($id, $request);

        return $update ? redirect()->route('superadmin.certificate.index')->with('success', 'Sertifikat Berhasil Diubah') : redirect()->back()->withErrors('Sertifikat Gagal Diubah');
    }

    public function delete($id){
        return $this->certivicateService->delete($id);
    }

    public function getAllClass(Request $request){

        if($request->ajax()){

            $data = ClassModel::whereHas('certificate')->with('certificate.data')->where('responsible_id', Auth::user()->id)->get();

            return response()->json([
                'status'    => 200,
                'data'      => CertificateClassResource::collection($data)
            ]);
        }

        return view('dashboard.mentor.certificate.index');
    }

    public function getMenteeByClass($id, Request $request){
        $data = ClassModel::with('certificate')->find($id);

        $mentees = User::withCount(['certificate' => function($certificate) use ($data) {
            $certificate->where('id', $data->certificate->certificate_id);
        }])->whereHas('userHasClass', function($class) use ($data){
            $class->where('id', $data->id);
        })->get();

        return view('dashboard.mentor.certificate.class', compact('data', 'mentees'));
    }

    public function attachDetach($id, Request $request){
        $data = $request->except(['_token']);
        $data['class_id'] = $id;

        $data = $this->certivicateService->attachDetach($data);

        return response()->json([
            'status'    => 200,
            'data'      => $data
        ]);
    }

    public function claim($masterClassId, $certificate_id)
    {
        $certificate = $this->certivicateService->show($certificate_id);

        $user = Auth::user();

        $data = MasterClassMaterial::where('master_class_id', $masterClassId)->with('masterClass')->getScoreByUser(Auth::user()->id)->get();

        $master_class = MasterClass::find($masterClassId);

        $final_avg = null;

        if($data->count() > 0){
            $final_avg = 0;

            foreach($data as $score){
                $final_avg += $score->score->average;
            }

            $final_avg = $final_avg / $data->count();
        }

        $pdf = PDF::loadView('certificate', compact('data', 'final_avg', 'certificate', 'user', 'master_class'))->setPaper('a3', 'landscape');
        $pdf->render();
        return $pdf->stream();
    }

    public function testDynamicValue(){
        $init = 50;

        $arr = [
            [
                'predicate' => 'A',
                'value'     => 90
            ],
            [
                'predicate' => 'B',
                'value'     => 80
            ],
            [
                'predicate' => 'C',
                'value'     => 70
            ],
            [
                'predicate' => 'D',
                'value'     => 40
            ],
            [
                'predicate' => 'E',
                'value'     => 0
            ],
        ];

        $step_1 = null;

        for ($x = 0; $x < count($arr); $x++) {
            if($init >= $arr[$x]['value']){
                $step_1 = $arr[$x]['predicate'];
                break;
            }
        }

        return $step_1;
    }

    public function dynamicPredicate(){
        $init = 83;

        $predicate = Predicate::with('predicate_score')->where('status', 'active')->latest()->first();

        $predicates = $predicate->predicate_score;

        $step_1 = null;

        for ($x = 0; $x < $predicates->count(); $x++) {
            if($init >= $predicates[$x]->score){
                $step_1 = $predicates[$x]->predicate;
                break;
            }
        }

        return $step_1;
    }

    public function testEmail(){
        $user = Auth::user();
        // Mail::to($user->email)->send(new DetachCertificate());
    }
}
