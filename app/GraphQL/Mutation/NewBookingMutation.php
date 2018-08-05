<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Booking;
use JWTAuth;

class NewBookingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewBooking'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('create-booking');
    }

    public function type()
    {
        return GraphQL::type('bookings');
    }

    public function args()
    {
        return [
            'school_id' => [
                'name' => 'school_id',
                'type' => Type::nonNull(Type::int()),
            ],
            'owner_id' => [
                'name' => 'owner_id',
                'type' => Type::nonNull(Type::int()),
            ],
            'booking_type_id' => [
                'name' => 'booking_type_id',
                'type' => Type::nonNull(Type::int()),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'date' => [
                'name' => 'date',
                'type' => Type::nonNull(Type::string()),
            ],
            'start' => [
                'name' => 'start',
                'type' => Type::nonNull(Type::string()),
            ],
            'end' => [
                'name' => 'end',
                'type' => Type::nonNull(Type::string()),
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
            ],
            'team_id' => [
                'name' => 'team_id',
                'type' => Type::string(),
            ],
            'user_id' => [
                'name' => 'userIds',
                'type' => Type::listOf(Type::int()),
            ],

        ];
    }

    public function resolve($root, $args)
    {
        $booking = Booking::create([
            'school_id' => $args['school_id'],
            'owner_id' => $args['owner_id'],
            'booking_type_id' => $args['booking_type_id'],
            'name' => $args['name'],
            'date' => $args['date'],
            'start' => $args['start'],
            'end' => $args['end'],
            'description' => $args['description'],
            'team_id' => $args['team_id'],
        ]);

        if (!$booking) {
            return null;
        }

        $booking->users()->attach($args['userIds']);

        return $booking;
    }
}
