<?php

namespace App\graphql\Mutations;

use App\Models\Brand;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateBrandMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createBrand'
    ];

    public function type(): Type
    {
        return GraphQL::type('Brand');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'logo' => [
                'name' => 'logo',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'banner' => [
                'name' => 'banner',
                'type' =>  Type::nonNull(Type::string()),
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $brand = new Brand();
        $brand->fill($args);
        $brand->save();

        return $brand;
    }
}
