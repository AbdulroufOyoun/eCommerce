<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rating\RatingRequest;
use App\Models\Rating;
use App\Repositories\PublicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RatingController extends Controller
{
    public function __construct(public PublicRepository $publicRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RatingRequest $request)
    {
        $arr = Arr::only($request->validated(), ['product_id', 'rating']);
        $arr['user_id'] = \auth('User')->user()->id;
        $this->publicRepository->Create(Rating::class, $arr);
        return \Success(__('public.Add'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
