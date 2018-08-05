<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\LegalItem;
use JWTAuth;

class NewLegalItemMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewLegalItem'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->hasRole(['super_admin']);
    }

    public function type()
    {
        return GraphQL::type('legalitems');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $legalitem = LegalItem::create($args);

        if (!$legalitem) {
            return null;
        }

        return $legalitem;
    }
}
