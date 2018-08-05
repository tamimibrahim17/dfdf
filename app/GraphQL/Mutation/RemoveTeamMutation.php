<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Team;
use JWTAuth;

class RemoveTeamMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveTeam'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('delete-team');
    }

    public function type()
    {
        return GraphQL::type('teams');
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
        $team = Team::find($args['id']);
        if (!$team) {
            return null;
        }

        $team->delete();

        return $team;
    }
}
