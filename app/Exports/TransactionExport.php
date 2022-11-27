<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements WithHeadings, WithMapping, ShouldAutoSize, FromQuery
{
    private $transactionRepository;
    private $user;

    public function __construct(
        $transactionRepository,
        $user
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->user = $user;
    }

    public function query() {
        return $this->transactionRepository
            ->select(
                'transactions.*',
                'user.username',
            )
            ->join('users', 'users.id', 'transactions.user_id')
            ->where('users.id', $this->user->id);
    }

    /**
     * Set header columns
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Account',
            'Amount',
            'Date/Time',
            'Status',
        ];
    }

    /**
     * Mapping data
     *
     * @return array
     */
    public function map($data): array
    {
        return [
            $data->username,
            $data->amount,
            $data->created_at,
            $data->status,
        ];
    }
}
