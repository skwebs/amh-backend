<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreCustomerRequest;
use App\Http\Requests\API\UpdateCustomerRequest;
use App\Http\Resources\V1\Customer\CustomerResource;
use App\Http\Resources\V1\Customer\CustomerCollection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return Customer::all();
        $filter = new CustomersFilter();
        $queryItems = $filter->transform($request); // [[column, operator, value]]
        if (count($queryItems) == 0) {
            return new CustomerCollection(Customer::paginate());
        }
        $customers = Customer::where($queryItems)->paginate();
        return new CustomerCollection($customers->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Customer added successfully',
            // 'data' => $customer,
            // 'token' => $customer->createToken(config("app.key"))->plainTextToken,

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return response()->json([
            "success" => true,
            "message" => "Record updated successfully",
            // "data" => $customer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([
            "success" => true,
            "statusCode" => 204,
            "message" => "Record deleted"
        ], 204);
    }

    public function trashed()
    {
        return Customer::onlyTrashed()->get();
    }

    public function restore($id)
    {
        if ($customer = Customer::onlyTrashed()->find($id)) {
            $customer->restore();
            return response()->json([
                "success" => true,
                "message" => "Record restored",
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => 'No trashed record found'
            ]);
        }
    }
}
