<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;


class CategoryFilter extends ApiFilter{

    protected $safeParams = [
        'categorie' => ['eq']
    ];

    protected $columnMap = [
    ];

    protected $operatorMap = [        
        'eq' => '=',
        'ne' => '!=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];

}
