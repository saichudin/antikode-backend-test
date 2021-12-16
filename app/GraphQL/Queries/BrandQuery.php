<?php

namespace App\GraphQL\Queries;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BrandQuery extends Query
{
    protected $attributes = [
        'name' => 'brand',
    ];

    public function type(): Type
    {
        return GraphQL::type('Brand');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Brand::findOrFail($args['id']);
    }
}
