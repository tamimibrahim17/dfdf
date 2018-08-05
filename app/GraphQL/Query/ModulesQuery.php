<?php

namespace App\GraphQL\Query;

use JWTAuth;
use App\Module;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ModulesQuery extends Query
{
    protected $attributes = [
        'name' => 'Modules Query',
        'description' => 'A query of modules'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can(['view-modules', 'view-module']);
    }

    public function type()
    {
        return GraphQL::paginate('modules');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],

            'page' => [
                'name' => 'page',
                'type' => Type::int(),
                'description' => 'Display a specific page',
            ],
            'limit' => [
                'name' => 'limit',
                'type' => Type::int(),
                'description' => 'Limit the items per page',
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields)
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id',$args['id']);
            }

            if (isset($args['name'])) {
                $query->where('name',$args['name']);
            }
        };

        $modules = Module::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate((isset($args['limit']) ? $args['limit'] : 20),
            ['*'],
            'page',
            (isset($args['page']) ? $args['page'] : 0));
        
        return $modules;
    }
}
