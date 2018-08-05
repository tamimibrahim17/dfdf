<?php

namespace App\GraphQL\Type;

use App\Booking;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BookingsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Bookings',
        'description' => 'A type',
        'model' => Booking::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the booking',
            ],
            'school_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The school id of the booking',
            ],
            'owner_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The user id of the booking maker',
            ],
            'owner' => [
                'type' => GraphQL::type('users'),
                'description' => 'The owner of the booking',
            ],
            'booking_type_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The booking type id of the booking',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the booking',
            ],
            'date' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The date of the booking',
            ],
            'start' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The start of the booking',
            ],
            'end' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The end of the booking',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the booking',
            ],
            'repeated' => [
                'type' => Type::int(),
                'description' => 'Whether or not the booking is repeated every week',
            ],
            'booking_type' => [
                'type' => GraphQL::type('booking_types'),
                'description' => 'The booking type of the booking',
            ],
            'team' => [
                'type' => GraphQL::type('teams'),
                'description' => 'The team of the booking',
            ],
            'slot_status' => [
                'type' => Type::int(),
                'description' => 'The slot status of the booking',
            ],
            'users' => [
                'type' => Type::listOf(GraphQL::type('users')),
                'description' => 'The users of the booking',
            ],
            'reservations' => [
                'type' => Type::listOf(GraphQL::type('users')),
                'description' => 'The reservations of the booking',
            ],
        ];
    }
}
