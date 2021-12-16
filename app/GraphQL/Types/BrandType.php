<?php

namespace App\GraphQL\Types;

use App\Models\Brand;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BrandType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Brand',
        'description' => 'Collection of brand',
        'model' => Brand::class
    ];


    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a brand',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of the brand',
            ],
            'logo' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Image file path Logo of the brand',
            ],
            'banner' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Image file path Banner of the brand',
            ]
        ];
    }
}
