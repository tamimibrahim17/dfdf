<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Booking;
use Auth;

class UpdateSlotStatusMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateSlotStatus'
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
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $userId = Auth::user()->id;

        $booking = Booking::where(['id' => $args['id'], 'slot_status' => 1])->first();
        if (!$booking) {
            return null;
        }

        if ($booking->users->contains($userId) || ($booking->team && $booking->team->users->contains($userId))) {
            $booking->users()->sync($userId);

            $booking->update([
                'team_id' => null,
                'slot_status' => 0
            ]);


            return $booking;
      }

      return null;
    }
}
