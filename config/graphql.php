<?php

use App\GraphQL\Mutation\NewUserMutation;
use App\GraphQL\Mutation\NewTeamMutation;
use App\GraphQL\Mutation\NewTeamMemberMutation;
use App\GraphQL\Mutation\RemoveTeamMemberMutation;
use App\GraphQL\Mutation\NewLegalItemMutation;
use App\GraphQL\Mutation\RemoveLegalItemMutation;
use App\GraphQL\Mutation\NewModuleLegalItemMutation;
use App\GraphQL\Mutation\RemoveModuleLegalItemMutation;
use App\GraphQL\Mutation\RemoveTeamMutation;
use App\GraphQL\Mutation\NewCategoryMutation;
use App\GraphQL\Mutation\RemoveCategoryMutation;
use App\GraphQL\Mutation\NewLessonMutation;
use App\GraphQL\Mutation\RemoveLessonMutation;
use App\GraphQL\Mutation\NewModuleMutation;
use App\GraphQL\Mutation\RemoveModuleMutation;
use App\GraphQL\Mutation\NewLessonModuleMutation;
use App\GraphQL\Mutation\RemoveLessonModuleMutation;
use App\GraphQL\Mutation\UpdateUserMutation;
use App\GraphQL\Mutation\UpdateTeamMutation;
use App\GraphQL\Mutation\NewSchoolMutation;
use App\GraphQL\Mutation\NewBookingMutation;
use App\GraphQL\Mutation\UpdateBookingMutation;
use App\GraphQL\Mutation\RemoveBookingMutation;
use App\GraphQL\Mutation\NewBookingUserMutation;
use App\GraphQL\Mutation\RemoveBookingUserMutation;
use App\GraphQL\Mutation\UpdateSchoolMutation;
use App\GraphQL\Mutation\UpdateMyProfileMutation;
use App\GraphQL\Mutation\UpdateSlotStatusMutation;
use App\GraphQL\Mutation\NewBookingReservationMutation;
use App\GraphQL\Mutation\RemoveBookingReservationMutation;
use App\GraphQL\Mutation\ConfirmBookingReservationMutation;
use App\GraphQL\Query\MyProfileQuery;
use App\GraphQL\Query\UsersQuery;
use App\GraphQL\Query\TeamsQuery;
use App\GraphQL\Query\CategoriesQuery;
use App\GraphQL\Query\LessonsQuery;
use App\GraphQL\Query\ModulesQuery;
use App\GraphQL\Query\SchoolsQuery;
use App\GraphQL\Query\SchoolQuery;
use App\GraphQL\Query\BookingsQuery;
use App\GraphQL\Query\BookingTypesQuery;
use App\GraphQL\Type\MyProfileType;
use App\GraphQL\Type\UsersType;
use App\GraphQL\Type\TeamsType;
use App\GraphQL\Type\CategoriesType;
use App\GraphQL\Type\LessonsType;
use App\GraphQL\Type\ModulesType;
use App\GraphQL\Type\LegalItemsType;
use App\GraphQL\Type\SchoolsType;
use App\GraphQL\Type\BookingsType;
use App\GraphQL\Type\BookingTypesType;


return [
    'prefix' => 'graphql',
    'routes' => 'query/{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => ['multitenant'],
    'default_schema' => 'default',
    // register query
    'schemas' => [
        'default' => [
            'query' => [
                'users' => UsersQuery::class,
                'teams' => TeamsQuery::class,
                'categories' => CategoriesQuery::class,
                'lessons' => LessonsQuery::class,
                'modules' => ModulesQuery::class,
                'schools' => SchoolsQuery::class,
                'school' => SchoolQuery::class,
                'bookings' => BookingsQuery::class,
                'booking_types' => BookingTypesQuery::class,
                'myProfile' => MyProfileQuery::class,
            ],
            'mutation' => [
                'newUser' => NewUserMutation::class,
                'newTeam' => NewTeamMutation::class,
                'newBooking' => NewBookingMutation::class,
                'newBookingReservation' => NewBookingReservationMutation::class,
                'removeBookingReservation' => RemoveBookingReservationMutation::class,
                'confirmBookingReservation' => ConfirmBookingReservationMutation::class,
                'updateBooking' => UpdateBookingMutation::class,
                'removeBooking' => RemoveBookingMutation::class,
                'newBookingUser' => NewBookingUserMutation::class,
                'removeBookingUser' => RemoveBookingUserMutation::class,
                'removeTeam' => RemoveTeamMutation::class,
                'newTeamMember' => NewTeamMemberMutation::class,
                'removeTeamMember' => RemoveTeamMemberMutation::class,
                'updateTeam' => UpdateTeamMutation::class,
                'newCategory' => NewCategoryMutation::class,
                'removeCategory' => RemoveCategoryMutation::class,
                'newLesson' => NewLessonMutation::class,
                'removeLesson' => RemoveLessonMutation::class,
                'newModule' => NewModuleMutation::class,
                'removeModule' => RemoveModuleMutation::class,
                'newLessonModule' => NewLessonModuleMutation::class,
                'removeLessonModule' => RemoveLessonModuleMutation::class,
                'newLegalItem' => NewLegalItemMutation::class,
                'removeLegalItem' => RemoveLegalItemMutation::class,
                'newModuleLegalItem' => NewModuleLegalItemMutation::class,
                'removeModuleLegalItem' => RemoveModuleLegalItemMutation::class,
                'updateUser' => UpdateUserMutation::class,
                'newSchool' => NewSchoolMutation::class,
                'updateSchool' => UpdateSchoolMutation::class,
                'updateMyProfile' => UpdateMyProfileMutation::class,
                'updateSlotStatus' => UpdateSlotStatusMutation::class,
            ],
            'middleware' => []
        ],
    ],
    // register types
    'types' => [
        'users'  => UsersType::class,
        'categories'  => CategoriesType::class,
        'lessons'  => LessonsType::class,
        'modules'  => ModulesType::class,
        'legalitems'  => LegalItemsType::class,
        'schools'  => SchoolsType::class,
        'bookings'  => BookingsType::class,
        'booking_types'  => BookingTypesType::class,
        'teams'  => TeamsType::class,
        'myprofile'  => MyProfileType::class,
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'variables'
];
