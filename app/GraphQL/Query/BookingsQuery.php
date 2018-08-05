<?php

namespace App\GraphQL\Query;

use App\Booking;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class BookingsQuery extends Query
{
    protected $attributes = [
        'name' => 'Bookings Query',
        'description' => 'A query of bookings'
    ];

    public function type()
    {
        return GraphQL::paginate('bookings');
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
        };
        $bookings = Booking::with(array_keys($fields->getRelations()))
            ->where($where)
            ->select($fields->getSelect())
            ->paginate((isset($args['limit']) ? $args['limit'] : 20),
            ['*'],
            'page',
            (isset($args['page']) ? $args['page'] : 0));
        return $bookings;
    }
}
