<?php

namespace App\Http\Controllers\Tenants\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Accounting\Transaction;
use App\Http\Requests\Tenants\Accounting\TransactionRequest;
use App\Http\Resources\Tenants\Accounting\TransactionResource;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Transaction::with('splits')->paginate(parent::DEFAULT_PAGINATION);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        return Transaction::createTransaction($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        return tap($transaction)->update($request->only(['description', 'date']));
    }
}
