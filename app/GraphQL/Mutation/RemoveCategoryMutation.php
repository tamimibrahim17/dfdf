<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Category;
use JWTAuth;

class RemoveCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveCategory'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('delete-category');
    }

    public function type()
    {
        return GraphQL::type('categories');
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
        $category = Category::find($args['id']);
        if (!$category) {
            return null;
        }

        $category->delete();

        return $category;
    }
}
