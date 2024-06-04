<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUs\ContactUsRequest;
use App\Models\ContactUs;
use App\Repositories\PublicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ContactUsController extends Controller
{

    public function __construct(public PublicRepository $publicRepository)
    {
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(ContactUsRequest $request)
    {
        $arr = Arr::only($request->validated(), ['name', 'phone', 'email', 'message']);
        if (\Auth::check()) {
            $arr['user_id'] = \Auth::id();
        }
        $this->publicRepository->Create(ContactUs::class, $arr);
        return \Success('Record has added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $perPage = \returnPerPage();
        $contactUs = $this->publicRepository->ShowAll(ContactUs::class, [])->paginate($perPage);
        return \Pagination($contactUs);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->publicRepository->DeleteById(ContactUs::class, $id);
        return \Success('Record has deleted successfully');
    }
}
