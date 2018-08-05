<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Lesson;
use JWTAuth;

class NewLessonMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewLesson'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('create-lesson');
    }

    public function type()
    {
        return GraphQL::type('lessons');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'school_id' => [
                'name' => 'school_id',
                'type' => Type::nonNull(Type::int()),
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::int())
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::nonNull(Type::int())
            ],
            'saved' => [
                'name' => 'saved',
                'type' => Type::int()
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $lesson = Lesson::create($args);

        if (!$lesson) {
            return null;
        }

        return $lesson;
    }
}
