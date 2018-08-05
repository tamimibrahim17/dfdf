<?php

namespace App\GraphQL\Type;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UsersType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Users',
        'description' => 'A type',
        'model' => User::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ],
            'avatar' => [
                'name' => 'avatar',
                'type' => Type::string()
            ],
            'phone' => [
                'name' => 'phone',
                'type' => Type::nonNull(Type::string())
            ],
            'address' => [
                'name' => 'address',
                'type' => Type::nonNull(Type::string())
            ],
            'zip' => [
                'name' => 'zip',
                'type' => Type::nonNull(Type::string())
            ],
            'city' => [
                'name' => 'city',
                'type' => Type::nonNull(Type::string())
            ],
            'role' => [
                'type' => Type::string(),
                'description' => 'The role of the user'
            ],
            'school_id' => [
                'type' => Type::int(),
                'description' => 'The school_id of the user'
            ],
            'school' => [
                'type' => GraphQL::type('schools'),
                'description' => 'The school of the user'
            ],
            'teams' => [
                'type' => Type::listOf(GraphQL::type('teams')),
                'description' => 'The teams of the user'
            ],
            'bookings' => [
                'type' => Type::listOf(GraphQL::type('bookings')),
                'description' => 'The bookings of the user'
            ],
            'reservedBookings' => [
                'type' => Type::listOf(GraphQL::type('bookings')),
                'description' => 'The bookings of the user has reserved'
            ],
            'ownedBookings' => [
                'type' => Type::listOf(GraphQL::type('bookings')),
                'description' => 'The bookings of the owner'
            ],
        ];
    }

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
    protected function resolveRoleField($root, $args)
    {
        return strtolower($root->roles()->first()->name);
    }
}
