<?php

namespace App\GraphQL\Type;

use App\Module;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ModulesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Modules',
        'description' => 'A type',
        'model' => Module::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the module'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the module'
            ],
            'period' => [
                'type' => Type::int(),
                'description' => 'The period of the module'
            ],

            'lessons' => [
                'type' => Type::listOf(GraphQL::type('lessons')),
                'description' => 'The lessons of the module'
            ],
        ];
    }
}
