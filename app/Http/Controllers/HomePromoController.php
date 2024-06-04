<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomePromo\HomePromoRequest;
use App\Models\HomePromo;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomePromoController extends Controller
{
    public function __construct(public UserRepository $userRepository)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $promoHome = HomePromo::first();
        if ($promoHome->video != '') {
            $promoHome->video = url('storage/' . $promoHome->video);
        }
        return \SuccessData('Record loaded successfully', $promoHome);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomePromoRequest $request)
    {
        $arr = Arr::only($request->validated(), ['title', 'video', 'is_video']);
        $this->userRepository->UpdateFirst(HomePromo::class, $arr);
        return \Success('Record Updated successfully');
    }
}
