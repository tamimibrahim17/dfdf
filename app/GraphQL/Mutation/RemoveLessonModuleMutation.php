<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Lesson;
use JWTAuth;

class RemoveLessonModuleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveLessonLegalItem'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('remove-module-from-lesson');
    }

    public function type()
    {
        return GraphQL::type('lessons');
    }

    public function args()
    {
        return [
            'lesson_id' => [
                'name' => 'lesson_id',
                'type' => Type::nonNull(Type::int())
            ],
            'module_id' => [
                'name' => 'moduleIds',
                'type' => Type::nonNull(Type::listOf(Type::int()))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $lesson = Lesson::find($args['lesson_id']);

        if (!$lesson) {
            return null;
        }

        $lesson->modules()->detach($args['moduleIds']);

        return $lesson;
    }
}
