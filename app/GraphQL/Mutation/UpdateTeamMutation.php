<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Team;
use JWTAuth;

class UpdateTeamMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateTeam'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('update-team');
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
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $team = Team::find($args['id']);
        if (!$team) {
            return null;
        }

        $team->name = $args['name'];
        $team->save();

        return $team;
    }
}
