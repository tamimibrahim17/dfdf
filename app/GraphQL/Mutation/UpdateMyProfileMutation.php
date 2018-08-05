<?php
namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use GraphQL\Upload\UploadType;
use App\User;
use JWTAuth;
use Auth;

class UpdateMyProfileMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateMyProfile'
    ];

    private $auth;

    public function authorize(array $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }

        return $this->auth->can('update-profile');
    }

    public function type()
    {
        return GraphQL::type('myprofile');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'avatar' => [
                'name' => 'avatar',
                'type' => Type::string(),
            ],
            'phone' => [
                'name' => 'phone',
                'type' => Type::nonNull(Type::string())
            ],
            'address' => [
                'name' => 'address',
                'type' => Type::nonNull(Type::string())
            ],
            'zip' => [
                'name' => 'zip',
                'type' => Type::nonNull(Type::string())
            ],
            'city' => [
                'name' => 'city',
                'type' => Type::nonNull(Type::string())
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return null;
        }

        $user->name = $args['name'];
        $user->email = $args['email'];
        if (isset($args['avatar'])) {
            $png_url = "avatar-".time().".png";
            $path = 'public/images/avatars/' . $png_url;
            try {
                $image = Image::make(file_get_contents("data:image/png;base64," . $args['avatar']));
                $image->fit(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::put($path, (string) $image->encode());
                $user->avatar = url(Storage::url($path));
            } catch (NotReadableException $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode(), ['Content-Length' =>$e->getMessage()]);
            }
        }
        $user->phone = $args['phone'];
        $user->address = $args['address'];
        $user->zip = $args['zip'];
        $user->city = $args['city'];
        if (isset($args['description'])) {
            $user->description = $args['description'];
        }
        $user->save();

        return $user;
    }
}
