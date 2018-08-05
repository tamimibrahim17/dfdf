<?php

namespace App\GraphQL\Type;

use App\BookingType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BookingTypesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BookingTypes',
        'description' => 'A type',
        'model' => BookingType::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the booking type'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the booking type'
            ],

        ];
    }
}
