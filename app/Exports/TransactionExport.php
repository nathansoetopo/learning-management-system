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

class TransactionExport implements FromCollection, WithStyles, ShouldAutoSize, WithHeadings, WithMapping, WithChunkReading
{
    use Exportable;

    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function collection()
    {
        $data = Transaction::with(['master_class', 'user']);

        if(!empty($this->start_date)){
            $data = $data->whereDate('created_at', '>=', $this->start_date);
        }

        if(!empty($this->end_date)){
            $data = $data->whereDate('created_at', '<=', $this->start_date);
        }

        $data = $data->orderBy('created_at', 'DESC')->get();

        return $data;
    }

    public function map($data): array
    {
        return [
            $data->invoice_number,
            $data->user->name,
            day($data->created_at),
            $data->master_class->name,
            'Rp. '.rupiah($data->pay) ?? 0,
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
