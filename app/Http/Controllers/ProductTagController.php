<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\ProductIdRequest;
use App\Http\Requests\Tag\ProductTagIdRequest;
use App\Http\Requests\Tag\TagIdRequest;
use App\Http\Resources\Tags\ProductTagResource;
use App\Http\Resources\Tags\TagResource;
use App\Models\ProductTag;
use App\Repositories\PublicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductTagController extends Controller
{
    public function __construct(public PublicRepository $publicRepository)
    {
    }
    /**
     * show all products with has the same tag
     */
    public function showWithTagId(TagIdRequest $request)
    {
        $arr = Arr::only($request->validated(), ['tagId']);
        $where = ['tag_id' => $arr['tagId']];
        $tag = $this->publicRepository->ShowAll(ProductTag::class, $where)->get();
        // return new TagResource($tag);
        return \SuccessData(__('public.Show'), TagResource::collection($tag));
    }

    /**
     * show all products with has the same tag
     */
    public function showWithProductId(ProductIdRequest $request)
    {
        $arr = Arr::only($request->validated(), ['productId']);
        $where = ['product_id' => $arr['productId']];
        $tag = $this->publicRepository->ShowAll(ProductTag::class, $where)->get();
        return \SuccessData(__('public.Show'), ProductTagResource::collection($tag));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(ProductTag $productTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTag $productTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTag $productTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTagIdRequest $request)
    {
        $arr = Arr::only($request->validated(), ['productTagId']);
        $this->publicRepository->DeleteById(ProductTag::class, $arr['productTagId']);
        return \Success(__('public.Delete'));
    }
}
