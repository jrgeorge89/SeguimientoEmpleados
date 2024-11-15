<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;


class EmployeeFilter extends ApiFilter{

    protected $safeParams = [
        'name' => ['eq','lk'],
        'email' => ['eq','lk'],
        'area' => ['eq','lk'],
        'categorieId' => ['eq'],
        'companie' => ['eq','lk'],
        'satisfaction' => ['eq','lt','lte','gt','gte'],
        'favorite' => ['eq']
    ];

    protected $columnMap = [        
        'categorieId' => 'categorie_id'
    ];

    protected $operatorMap = [        
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'lk' => 'LIKE'
    ];

}
