<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Transaction\TransactionCollection;
use App\Models\Transaction;
use App\Http\Requests\API\StoreTransactionRequest;
use App\Http\Requests\API\UpdateTransactionRequest;
use App\Http\Resources\V1\Transaction\TransactionResource;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TransactionCollection(Transaction::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();
            // Your API logic goes here
            // create a new transaction record
            $transaction = Transaction::create($request->validated());
            // update the customer balance
            $customer = Customer::find($request->validated()['customer_id']);
            $customer->balance +=  $transaction->debit - $transaction->credit;
            $customer->save();
            // If everything is successful, commit the transaction
            DB::commit();
            // Return your API response
            // return response()->json(['success' => true, 'message' => 'Transaction completed successfully']);
            return response()->json([
                'success' => true,
                "message" => "Transaction saved successfully",
                // "data" => $transaction,
                // "balance" => $customer->balance
            ], 201);
        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            // Return an error response
            return response()->json(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);
        }
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
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        // return $transaction;
        try {
            // Start a database transaction
            DB::beginTransaction();
            // Your API logic goes here
            // create a new transaction
            $transaction->update($request->validated());
            // update the customer balance
            $customer = Customer::find($request->validated()['customer_id']);
            $customer->balance +=  $transaction->debit - $transaction->credit;
            $customer->save();
            // If everything is successful, commit the transaction
            DB::commit();
            // Return your API response
            // return response()->json(['success' => true, 'message' => 'Transaction completed successfully']);
            return response()->json([
                'success' => true,
                "message" => "Transaction updated successfully",
                // "data" => $transaction,
                // "balance" => $customer->balance
            ]);
        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            // Return an error response
            return response()->json(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // return $transaction->delete();
        return response()->json([
            'success' => true,
            "message" => "Transaction trashed successfully",
            "data" => $transaction->delete(),
        ]);
    }
}
