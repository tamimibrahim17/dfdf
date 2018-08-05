<?php

namespace App\GraphQL\Type;

use App\School;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SchoolsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Schools',
        'description' => 'A type',
        'model' => School::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the school'
            ],
            'address' => [
                'type' => Type::string(),
                'description' => 'The address of school'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the school'
            ],
            // field relation to model users
            'users' => [
                'type' => Type::listOf(GraphQL::type('users')),
                'description' => 'The users of the school'
            ]
        ];
    }
}