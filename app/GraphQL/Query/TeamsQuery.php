<?php

namespace App\GraphQL\Query;

use JWTAuth;
use App\Team;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class TeamsQuery extends Query
{
    protected $attributes = [
        'name' => 'Teams Query',
        'description' => 'A query of teams'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can(['view-teams', 'view-team']);
    }

    public function type()
    {
        return GraphQL::paginate('teams');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'school_id' => [
                'name' => 'school_id',
                'type' => Type::int()
            ],
            'owner_id' => [
                'name' => 'owner_id',
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

            if (isset($args['school_id'])) {
                $query->where('school_id',$args['school_id']);
            }

            if (isset($args['owner_id'])) {
                $query->where('owner_id',$args['owner_id']);
            }

            if (isset($args['name'])) {
                $query->where('name',$args['name']);
            }
        };
        $teams = Team::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate((isset($args['limit']) ? $args['limit'] : 20),
            ['*'],
            'page',
            (isset($args['page']) ? $args['page'] : 0));
        return $teams;
    }
}
