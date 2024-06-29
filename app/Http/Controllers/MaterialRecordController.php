<?php

namespace App\Http\Controllers;

use App\Enums\MaterialEnum;
use App\Http\Requests\Material\MaterialIdRequest;
use App\Http\Requests\Material\MaterialRecordsRequest;
use App\Models\Material;
use App\Models\MaterialRecord;
use App\Repositories\PublicRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MaterialRecordController extends Controller
{
    public function __construct(public PublicRepository $publicRepository, public UserRepository $repository)
    {
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(MaterialRecordsRequest $request)
    {
        $notFoundMaterials = [];
        foreach ($request->records as $array) {
            $arr = Arr::only($array, ['materialId', 'quantity', 'type']);
            $material = Material::where('id', $arr["materialId"])->orWhere('qr_code', $arr["materialId"]);
            if ($material->exists()) {
                $material = $material->first();
                $arr['material_id'] = $material->id;
                $type = $arr['type'] == MaterialEnum::output;
                $result = $material['current_quantity'] - $arr['quantity'];
                if ($type && $result >= 0) {
                    $this->publicRepository->Create(MaterialRecord::class, $arr);
                    $this->repository->ChangeQuantity($material, $arr);
                } else {
                    array_push($notFoundMaterials, $arr);
                };
            } else {
                array_push($notFoundMaterials, $arr);
            };
        }
        return \SuccessData(__('public.Add'), $notFoundMaterials);
    }
}