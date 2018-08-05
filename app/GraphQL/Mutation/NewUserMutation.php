<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Auth;

class NewUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewUser'
    ];

    public function type()
    {
        return GraphQL::type('users');
    }

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }
        // dd($this->auth);

        return $this->auth->can('create-user');
    }

    public function args()
    {
        return [
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
            'role' => [
                'name' => 'role',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $args['password'] = bcrypt(time());
        $args['school_id'] = Auth::user()->school_id;
        // dd($args);
        $user = User::create($args);

        if($args['role']){
            switch ($args['role']) {
                case "superadmin":
                    $user->attachRole(1);
                    break;
                case "admin":
                    $user->attachRole(2);
                    break;
                case "teacher":
                    $user->attachRole(3);
                    break;
                case "student":
                    $user->attachRole(4);
                    break;
                default:
                    $user->attachRole(4);
            }
        }
        if (!$user) {
            return null;
        }

        return $user;
    }
}
