<?php

namespace App\Http\Controllers\Superadmin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Export;
use App\Services\Export\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExportController extends Controller
{
    private $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    public function transactionView(Request $request)
    {
        if($request->ajax()){
            $data = $this->exportService->transaction($request->all());

            return response()->json([
                'status'    => 200,
                'data'      => $data
            ]);
        }

        return view('dashboard.superadmin.export.transaction');
    }

    public function transaction(Request $request)
    {
        (new TransactionExport($request->start_date, $request->end_date))->queue('transaction.xlsx')->chain([
            Export::create(['name' => 'transaction', 'url' => asset('storage/transaction.xlsx')])
        ]);

        return redirect()->back()->with('success', 'Data Export Sedang Di Proses');
    }
}
