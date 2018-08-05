<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Team;
use JWTAuth;

class NewTeamMemberMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewTeamMember'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('add-student-to-team');
    }

    public function type()
    {
        return GraphQL::type('teams');
    }

    public function args()
    {
        return [
            'team_id' => [
                'name' => 'team_id',
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
        $team = Team::find($args['team_id']);

        if (!$team) {
            return null;
        }

        $team->users()->attach($args['userIds']);

        return $team;
    }
}
