<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Booking;
use JWTAuth;

class ConfirmBookingReservationMutation extends Mutation
{
    protected $attributes = [
        'name' => 'ConfirmBookingReservation'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('confirm-booking-reservation');
    }

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
                'name' => 'user_id',
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $booking = Booking::where(['id' => $args['booking_id'], 'slot_status' => 1])->first();

        if (!$booking) {
            return null;
        }

        $booking->users()->sync($args['user_id']);

        $booking->update([
            'team_id' => null,
            'slot_status' => 0
        ]);

        return $booking;
    }
}
