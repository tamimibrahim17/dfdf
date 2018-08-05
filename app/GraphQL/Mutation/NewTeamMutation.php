<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Team;
use JWTAuth;
use Auth;

class NewTeamMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewTeam'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('create-team');
    }

    public function type()
    {
        return GraphQL::type('teams');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $args['school_id'] = Auth::user()->school_id;
        $args['owner_id'] = Auth::user()->id;
        $team = Team::create($args);
        if (!$team) {
            return null;
        }

        return $team;
    }
}
