<?php

namespace App\GraphQL\Type;

use App\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoriesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Categories',
        'description' => 'A type',
        'model' => Category::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the category'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the category'
            ],

            'lessons' => [
                'type' => Type::listOf(GraphQL::type('lessons')),
                'description' => 'The lessons of the category'
            ],
            'legalitems' => [
                'type' => Type::listOf(GraphQL::type('legalitems')),
                'description' => 'The legalitems of the category'
            ],
        ];
    }
}
