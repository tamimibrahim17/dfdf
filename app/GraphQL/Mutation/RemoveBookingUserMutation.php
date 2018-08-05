<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Booking;

class RemoveBookingUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveBookingUser'
    ];

    public function type()
    {
        return GraphQL::type('bookings');
    }

    public function args()
    {
        return [
            'booking_id' => [
                'name' => 'booking_id',
                'type' => Type::nonNull(Type::int())
            ],
            'user_id' => [
                'name' => 'userIds',
                'type' => Type::nonNull(Type::listOf(Type::int()))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $booking = Booking::find($args['booking_id']);

        if (!$booking) {
            return null;
        }

        $booking->users()->detach($args['userIds']);

        return $booking;
    }
}
