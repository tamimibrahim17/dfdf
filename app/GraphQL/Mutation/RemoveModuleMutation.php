<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Module;
use JWTAuth;

class RemoveModuleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveModule'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('delete-module');
    }

    public function type()
    {
        return GraphQL::type('modules');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $module = Module::find($args['id']);

        if (!$module) {
            return null;
        }

        $module->delete();

        return $module;
    }
}
