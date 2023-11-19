<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'email' => ['eq'],
        'mobile' => ['eq'],
        'address' => ['eq'],
        'lastPurchaseAt' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'lastPurchaseAmount' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'lastPaymentAt' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'lastPaymentAmount' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $columnMap = [
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
        'deletedAt' => 'deleted_at',
        'lastPurchaseAt' => 'last_purchase_at',
        'lastPurchaseAmount' => 'last_purchase_amount',
        'lastPaymentAt' => 'last_payment_at',
        'lastPaymentAmount' => 'last_payment_amount',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $param  => $operators) {
            $query = $request->query($param);
            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
