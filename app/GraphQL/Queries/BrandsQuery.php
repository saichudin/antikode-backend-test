<?php

namespace App\graphql\Queries;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BrandsQuery extends Query
{
    protected $attributes = [
        'name' => 'brands',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Brand'));
    }

    public function resolve($root, $args)
    {
        return Brand::all();
    }
}
