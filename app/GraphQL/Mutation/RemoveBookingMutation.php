<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Booking;
use JWTAuth;

class RemoveBookingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveBooking'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('delete-booking');
    }

    public function type()
    {
        return GraphQL::type('bookings');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $booking = Booking::find($args['id']);
        if (!$booking) {
            return null;
        }

        $booking->delete();

        return $booking;
    }
}
