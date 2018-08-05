<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Module;
use JWTAuth;

class NewModuleLegalItemMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewModuleLegalItem'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('add-legalitem-to-module');
    }

    public function type()
    {
        return GraphQL::type('modules');
    }

    public function args()
    {
        return [
            'module_id' => [
                'name' => 'module_id',
                'type' => Type::nonNull(Type::int())
            ],
            'legal_item_id' => [
                'name' => 'legalItemIds',
                'type' => Type::nonNull(Type::listOf(Type::int()))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $module = Module::find($args['module_id']);

        if (!$module) {
            return null;
        }

        $module->legalItems()->attach($args['legalItemIds']);

        return $module;
    }
}
