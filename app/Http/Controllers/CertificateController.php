<?php

namespace App\Http\Controllers;

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

    public function index(){
        $certificates = $this->certivicateService->index();

        return view('dashboard.superadmin.certificate.index', compact('certificates'));
    }

    public function create(){
        $masterClasses = MasterClass::where('status', 'active')->get();

        return view('dashboard.superadmin.certificate.create', compact('masterClasses'));
    }

    public function claim($masterClassId)
    {
        $data = MasterClassMaterial::where('master_class_id', $masterClassId)->with('masterClass')->getScoreByUser(Auth::user()->id)->get();

        return $data;
    }
}
