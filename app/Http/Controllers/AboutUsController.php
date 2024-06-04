<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutUsRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Repositories\PublicRepository;

class AboutUsController extends Controller
{
    public function __construct(public PublicRepository $repository)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $aboutUs = AboutUs::first();
        return \SuccessData('Record has loaded successfully', $aboutUs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutUsRequest $request)
    {
        $aboutUs = AboutUs::first();
        $aboutUs->description = $request->description;
        $aboutUs->save();
        return \Success('About us has Updated successfully');
    }
}
