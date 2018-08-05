<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Category;
use JWTAuth;

class NewCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewCategory'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('create-category');
    }

    public function type()
    {
        return GraphQL::type('categories');
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
        $category = Category::create($args);
        if (!$category) {
            return null;
        }

        return $category;
    }
}
