<?php

namespace App\GraphQL\Type;

use App\Team;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TeamsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Teams',
        'description' => 'A type',
        'model' => Team::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the team'
            ],
            'school_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The school id of the team'
            ],
            'owner_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The user id of the team maker'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the team'
            ],

            'school' => [
                'type' => GraphQL::type('schools'),
                'description' => 'The school of the team'
            ],
            'users' => [
                'type' => Type::listOf(GraphQL::type('users')),
                'description' => 'The users of the team'
            ],
            'bookings' => [
                'type' => Type::listOf(GraphQL::type('bookings')),
                'description' => 'The bookings of the team'
            ],
        ];
    }
}
