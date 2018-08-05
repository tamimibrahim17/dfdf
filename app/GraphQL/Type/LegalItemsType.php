<?php

namespace App\GraphQL\Type;

use App\LegalItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LegalItemsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'LegalItems',
        'description' => 'A type',
        'model' => LegalItem::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the legalitem'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the legalitem'
            ],
            'category_id' => [
                'type' => Type::int(),
                'description' => 'The category_id of the legalitem'
            ],

            'category' => [
                'type' => GraphQL::type('categories'),
                'description' => 'The category of the legalitem'
            ],
            'modules' => [
                'type' => Type::listOf(GraphQL::type('modules')),
                'description' => 'The modules of the legalitem'
            ],
        ];
    }
}
