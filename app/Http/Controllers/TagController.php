<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\TagIdRequest;
use App\Http\Requests\Tag\TagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use App\Repositories\PublicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TagController extends Controller
{

    public function __construct(public PublicRepository $publicRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->publicRepository->ShowAll(Tag::class, [])->get();
        return \SuccessData(__('public.Show'), $tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TagRequest $request)
    {
        $arr = Arr::only($request->validated(), ['name']);
        $this->publicRepository->Create(Tag::class, $arr);
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
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request)
    {
        $arr = Arr::only($request->validated(), ['tagId', 'name']);
        $this->publicRepository->Update(tag::class, $arr['tagId'], $arr);
        return \Success(__('public.Update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagIdRequest $request)
    {
        $arr = Arr::only($request->validated(), ['tagId']);
        $this->publicRepository->DeleteById(Tag::class, $arr['tagId']);
        return \Success(__('public.Delete'));
    }
}