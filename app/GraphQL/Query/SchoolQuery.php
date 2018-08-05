<?php

namespace App\GraphQL\Query;

use JWTAuth;
use App\User;
use App\School;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class SchoolQuery extends Query
{
    protected $attributes = [
        'name' => 'School Query',
        'description' => 'A query of the school for the active user'
    ];

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }
        return $this->auth->can(['view-school']);
    }

    public function type()
    {
        return GraphQL::type('schools');
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
            'address' => [
                'name' => 'address',
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
        $school = School::with(array_keys($fields->getRelations()))
            ->where('id', $this->auth->school_id)
            ->select($fields->getSelect())->first();

        return $school;
    }
}
