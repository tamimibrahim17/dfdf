<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Module;
use JWTAuth;

class NewModuleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewModule'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('create-module');
    }

    public function type()
    {
        return GraphQL::type('modules');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'period' => [
              'name' => 'period',
              'type' => Type::int()
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $module = Module::create($args);

        if (!$module) {
            return null;
        }

        return $module;
    }
}
