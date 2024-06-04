<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Resources\Admin\AdminLoginResource;
use App\Models\Admin;
use App\Repositories\PublicRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{

    public function __construct(public PublicRepository $repository)
    {
    }

    public function Login(AdminLoginRequest $request)
    {
        $arr = Arr::only($request->validated(), ['email', 'password']);
        $where = ['email' => $arr['email']];
        $admin = $this->repository->ShowAll(Admin::class, $where)->first();
        if (!Hash::check($arr['password'], $admin->password)) {
            throw ValidationException::withMessages([__('auth.password')]);
        }
        $admin['token'] = $admin->createToken('authToken', ['Admin'])->accessToken;
        $admin['permissions'] = $admin->permissions()->pluck('name');
        return \SuccessData(__('auth.Login'), new AdminLoginResource($admin));
    }
}
