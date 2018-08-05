<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Booking;
use JWTAuth;

class UpdateBookingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateBooking'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('update-booking');
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
            'slot_status' => [
                'name' => 'slot_status',
                'type' => Type::int(),
            ],
            'user_id' => [
                'name' => 'userIds',
                'type' => Type::listOf(Type::int()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $booking = Booking::find($args['id']);

        if (!$booking) {
            return null;
        }

        $booking->update([
            'name' => $args['name'],
            'date' => $args['date'],
            'start' => $args['start'],
            'end' => $args['end'],
            'description' => $args['description'],
            'team_id' => $args['team_id'],
            'slot_status' => $args['slot_status'],
        ]);

        $booking->users()->sync($args['userIds']);

        return $booking;
    }
}
