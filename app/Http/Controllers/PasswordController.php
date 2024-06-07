<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\PublicRepository;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Password\ChangePasswordRequest;
use App\Http\Requests\Password\ChangeAdminPasswordRequest;

class PasswordController extends Controller
{
    public function __construct( public PublicRepository $repository)
    {
        $this->middleware('permission:Admin Management',
        ['only' => ['ChangeِAdminPassword']]);
    }

    public function SelfChangePassword(ChangePasswordRequest $request)
    {
        
        $arr = Arr::only($request->validated(), ['old_password', 'new_password']);

        $person = \auth()->user();
        $model =get_class( $person);
        

        if (!Hash::check($arr['old_password'], $person->password)) {
            throw ValidationException::withMessages([__('auth.failed')]);
        }

        $this->repository->update($model, $person->id, ['password' => $arr['new_password']]);
		
        return \Success(__('auth.password_update'), 201);
    } 

    public function ChangeِAdminPassword(ChangeAdminPasswordRequest $request)
    {
        
        $arr = Arr::only($request->validated(), ['id', 'new_password']);

        $person = $this->repository->ShowById(Admin::class,$arr['id']);
       
        $this->repository->update(Admin::class, $person->id, ['password' => $arr['new_password']]);
		
        return \Success(__('auth.password_update'), 201);

    } 





}
