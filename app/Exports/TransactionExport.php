<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromQuery, WithStyles, ShouldAutoSize, WithHeadings, WithMapping, WithChunkReading
{
    use Exportable;

    private $exportService;

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function query()
    {
        $data = DB::table('transaction_log')
        ->select([
            'transaction_log.id',
            'transaction_log.invoice_number',
            'transaction_log.status',
            'transaction_log.created_at',
            'master_class.name as master_class_name',
            'users.name as user_name',
            'users.email as user_email'
        ])
        ->join('master_class', 'transaction_log.master_class_id', '=', 'master_class.id')
        ->join('users', 'transaction_log.user_id', '=', 'users.id')
        ->orderBy('transaction_log.created_at', 'desc')
        ->get();  

        return $data;
    }
    // ()
    // {
    //     return Transaction::with(['master_class', 'user'])->get();
    // }

    public function map($data): array
    {
        return [
            $data->invoice_number,
            $data->user_name,
            $data->created_at,
            $data->master_class_name,
            0,
            $data->status
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Invoice',
            'Nama Pembeli',
            'Tanggal Transaksi',
            'Nama Master Class',
            'Harga',
            'Status',
        ];
    }

    public function batchsize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
