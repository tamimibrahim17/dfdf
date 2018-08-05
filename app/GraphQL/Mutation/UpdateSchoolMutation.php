<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\School;
use JWTAuth;

class UpdateSchoolMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateSchool'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('update-school');
    }

    public function type()
    {
        return GraphQL::type('schools');
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
            ],
            'address' => [
                'name' => 'address',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $school = School::find($args['id']);
        if (!$school) {
            return null;
        }

        $school->name = $args['name'];
        $school->address = $args['address'];
        $school->save();

        return $school;
    }
}
