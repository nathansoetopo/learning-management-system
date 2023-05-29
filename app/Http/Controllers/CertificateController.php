<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateStoreRequest;
use App\Http\Requests\CertificateUpdateRequest;
use App\Models\Certificate;
use App\Models\MasterClass;
use App\Models\MasterClassMaterial;
use App\Services\Certificate\CertificateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function claim($masterClassId)
    {
        $data = MasterClassMaterial::where('master_class_id', $masterClassId)->with('masterClass')->getScoreByUser(Auth::user()->id)->get();

        return $data;
    }
}
