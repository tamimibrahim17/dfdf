<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Lesson;
use JWTAuth;

class RemoveLessonMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveLesson'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('delete-lesson');
    }

    public function type()
    {
        return GraphQL::type('lessons');
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
        $lesson = Lesson::find($args['id']);
        
        if (!$lesson) {
            return null;
        }

        $lesson->delete();

        return $lesson;
    }
}
