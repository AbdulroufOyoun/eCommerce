<?php

namespace App\Http\Controllers;

use App\Enum\AccountTypeEnum;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserSignUpRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserImage;
use App\Repositories\PublicRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct(public PublicRepository $publicRepository, public UserRepository $userRepository)
    {
    }


    public function login(UserLoginRequest $request)
    {
        $arr = Arr::only($request->validated(), ['email', 'password']);
        $where = ['email' => $arr['email']];
        $person = $this->publicRepository->ShowAll(User::class, $where)->first();
        if (!Hash::check($arr['password'], $person->password)) {
            throw ValidationException::withMessages([__('auth.password_wrong')]);
        }
        $person['token'] = $person->createToken('authToken', ['User'])->accessToken;

        return \SuccessData('Login success', new LoginResource($person));
    }

    public function SignUp(UserSignUpRequest $request)
    {
        $arr = Arr::only($request->validated(), [
            'f_name', 'l_name', 'company_name', 'password',
            'email', 'phone', 'display_name'
        ]);
        $addressArr = Arr::only($request->validated(), [
            'state_id', 'address', 'zip_code'
        ]);
        $imageArr = Arr::only($request->validated(), ['image']);
        if (\array_key_exists('image', $imageArr)) {
            $path = 'Images/Profiles/';
            $arr['image'] = \uploadImage($arr['image'], $path);
        }
        $arr['account_type'] = 1;
        $user = $this->publicRepository->Create(User::class, $arr);
        $user['token'] = $user->createToken('authToken', ['User'])->accessToken;


        $addressArr['user_id'] = $user->id;
        $this->publicRepository->Create(UserAddress::class, $addressArr);

        $imageArr['user_id'] = $user->id;
        $this->publicRepository->Create(UserImage::class, $imageArr);

        return \SuccessData('User has created successful', new LoginResource($user));
    }


    public function logout()
    {
        $user = \Auth::user();
        // $user->tokens()->delete();
        $user->tokens()->where('scopes', '["User"]')->delete();
        return \Success('you logout from all devices');
    }


    public function show_user($id)
    {
        $user = $this->publicRepository->ShowById(User::class, $id);
        return \SuccessData('User has loaded successful', new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request)
    {
        $arr = Arr::only($request->validated(), [
            'f_name', 'l_name', 'company_name',
            'phone', 'display_name'
        ]);
        $addressArr = Arr::only($request->validated(), [
            'state_id', 'address', 'zip_code'
        ]);
        $imageArr = Arr::only($request->validated(), ['image']);

        if (5 === count($arr)) {
            $this->publicRepository->update(User::class, \Auth::id(), $arr);
        }
        if (3 === count($addressArr)) {
            $this->userRepository->UpdateAddress(\Auth::id(), $addressArr);
        }
        if (1 === count($imageArr)) {
            $path = 'Images/Profiles/';

            $imagePath = uploadImage($imageArr["image"], $path);
            $this->userRepository->Image($imagePath, \Auth::id());
        }

        return \Success('Account has Updated successfully');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        \Auth::user()->delete();
        return \Success('Account has deleted successfully');
    }
}