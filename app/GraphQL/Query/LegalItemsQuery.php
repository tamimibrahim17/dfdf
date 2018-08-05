<?php

namespace App\GraphQL\Query;

use JWTAuth;
use App\LegalItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class LegalItemsQuery extends Query
{
    protected $attributes = [
        'name' => 'LegalItems Query',
        'description' => 'A query of legalitems'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can(['view-legalitems', 'view-legalitem']);
    }

    public function type()
    {
        return GraphQL::paginate('legalitems');
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
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::int()
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

            if (isset($args['category_id'])) {
                $query->where('category_id',$args['category_id']);
            }
        };

        $legalitems = LegalItem::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate((isset($args['limit']) ? $args['limit'] : 20),
            ['*'],
            'page',
            (isset($args['page']) ? $args['page'] : 0));

        return $legalitems;
    }
}
