<?php

namespace App\GraphQL\Type;

use App\Lesson;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LessonsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Lessons',
        'description' => 'A type',
        'model' => Lesson::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the lesson'
            ],
            'school_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The school id of the lesson',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the lesson'
            ],
            'saved' => [
                'type' => Type::int(),
                'description' => 'The saved of the lesson'
            ],
            'category_id' => [
                'type' => Type::int(),
                'description' => 'The category_id of the lesson'
            ],
            'category' => [
                'type' => GraphQL::type('categories'),
                'description' => 'The category of the lesson'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The user id of the lesson',
            ],
            'user' => [
                'type' => GraphQL::type('users'),
                'description' => 'The user of the lesson',
            ],

            'modules' => [
                'type' => Type::listOf(GraphQL::type('modules')),
                'description' => 'The modules of the lesson'
            ],
        ];
    }
}
