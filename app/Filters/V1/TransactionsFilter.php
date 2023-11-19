<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class TransactionsFilter extends ApiFilter
{

    protected $safeParams = [
        'id' => ['eq'],
        'customer_id' => ['eq'],
        'debit' => ['eq'],
        'credit' => ['eq'],
        'description' => ['eq'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
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
