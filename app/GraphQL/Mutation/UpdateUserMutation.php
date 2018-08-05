<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\User;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateUser'
    ];

    public function type()
    {
        return GraphQL::type('users');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
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
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::find($args['id']);
        if (!$user) {
            return null;
        }

        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->phone = $args['phone'];
        $user->address = $args['address'];
        $user->zip = $args['zip'];
        $user->city = $args['city'];
        $user->save();

        return $user;
    }
}
