<?php

namespace App\Repositories\Impls;

use App\Repositories\TransactionRepository;
use App\Models\Transaction;

class TransactionRepositoryImpl extends GenericRepositoryImpl implements TransactionRepository {
    public function __construct(Transaction $model) {
        $this->model = $model;
    }
}
