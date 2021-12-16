<?php

namespace App\graphql\Mutations;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteBrandMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBrand',
        'description' => 'Delete a brand'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }


    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $brand = Brand::findOrFail($args['id']);

        return  $brand->delete() ? true : false;
    }
}
