<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\UserImage;

class UserRepository implements UserRepositoryInterface
{

    public function Image($image, $user_id)
    {
        // TODO: Implement Create() method.
        $userImage = UserImage::where('user_id', $user_id)->first();
        $userImage->image = $image;
        $userImage->save();
    }

    public function UpdateAddress($user_id, $arr)
    {
        // TODO: Implement Update() method.
        UserImage::where('user_id', $user_id)->first()->update($arr);
    }
}
