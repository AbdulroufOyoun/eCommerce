<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\AddCategoryRequest;
use App\Http\Requests\Category\CategoryIdRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Http\Resources\Category\EditCategoryResource;
use App\Http\Resources\Category\ShowCategoryResource;
use App\Models\Category;
use App\Repositories\PublicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use ParagonIE\ConstantTime\RFC4648;

class CategoryController extends Controller
{
    public function __construct(public PublicRepository $repository)
    {
    }

    public function Create(AddCategoryRequest $request)
    {
        $arr = Arr::only($request->validated(), ['name', 'image']);
        $path = 'Images/Category/';
        $arr['image'] = \uploadImage($arr['image'], $path);
        $this->repository->Create(Category::class, $arr);
        return \Success(__('public.add_category'));
    }

    public function ActiveOrNot(CategoryIdRequest $request)
    {
        $arr = Arr::only($request->validated(), ['categoryId']);
        $this->repository->ActiveOrNot(Category::class, $arr['categoryId']);
        return \Success(__('public.active_or_not_category'));
    }

    public function Delete(CategoryIdRequest $request)
    {
        $arr = Arr::only($request->validated(), ['categoryId']);
        $this->repository->DeleteById(Category::class, $arr['categoryId']);
        return \Success(__('public.delete_category'));
    }

    public function ShowById(CategoryIdRequest $request)
    {
        $arr = Arr::only($request->validated(), ['categoryId']);
        $category = $this->repository->ShowById(Category::class, $arr['categoryId']);
        return \SuccessData(__('public.category_found'), new ShowCategoryResource($category));
    }

    public function ShowAll()
    {
        $perPage = \returnPerPage();
        $categories = $this->repository->ShowAll(Category::class, [])->paginate($perPage);
        ShowCategoryResource::collection($categories);
        return \Pagination($categories);

    }

    public function Update(EditCategoryRequest $request){
    $arr = Arr::only($request->validated(),['categoryId','name','image']);
    if(\array_key_exists('image',$arr)){
        $path  = 'Images/Category/';
        $arr['image'] = \uploadImage($arr['image'],$path);
    }
    $this->repository->Update(Category::class,$arr['categoryId'],$arr);
    return \Success(__('public.category_update'));
    }
}
