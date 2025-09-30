<?php

namespace App\Exports;

use App\Models\PointHistory;
use App\Models\RedeemHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class HistoryExport implements FromCollection, WithHeadings, WithMapping
{
    protected array $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        // Query dasar
        $pointQuery = PointHistory::with('customer');
        $redeemQuery = RedeemHistory::with(['customer', 'redeemOption']);

        // Terapkan filter
        if (!empty($this->filters['customer_id'])) {
            $pointQuery->where('customer_id', $this->filters['customer_id']);
            $redeemQuery->where('customer_id', $this->filters['customer_id']);
        }
        if (!empty($this->filters['start_date'])) {
            $pointQuery->whereDate('created_at', '>=', $this->filters['start_date']);
            $redeemQuery->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $pointQuery->whereDate('created_at', '<=', $this->filters['end_date']);
            $redeemQuery->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        // Ambil data
        $pointHistories = $pointQuery->get();
        $redeemHistories = $redeemQuery->get();

        // Gabungkan dan urutkan. Method ini akan selalu mengembalikan sebuah Collection.
        return $pointHistories->merge($redeemHistories)->sortByDesc('created_at');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Pelanggan',
            'Deskripsi',
            'Perubahan Poin',
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        if ($row instanceof PointHistory) {
            return [
                $row->created_at->format('d-m-Y H:i:s'),
                $row->customer->name ?? 'N/A',
                'Penambahan Poin dari Belanja Rp ' . number_format($row->purchase_amount),
                '+' . $row->points_earned,
            ];
        }

        if ($row instanceof RedeemHistory) {
            return [
                $row->created_at->format('d-m-Y H:i:s'),
                $row->customer->name ?? 'N/A',
                'Redeem: ' . ($row->redeemOption->name ?? 'N/A'),
                '-' . $row->points_spent,
            ];
        }

        return [];
    }
}
