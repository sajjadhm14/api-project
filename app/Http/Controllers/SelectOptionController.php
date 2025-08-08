<?php

namespace App\Http\Controllers;

use App\Models\Select_option;
use App\Http\Requests\StoreSelect_optionRequest;
use App\Http\Requests\StoreSelectOptionRequest;
use App\Http\Requests\UpdateSelect_optionRequest;
use App\Http\Requests\UpdateSelectOptionRequest;
use App\Http\Resources\SelectOptionResource;
use App\Models\SelectOption;

class SelectOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SelectOptionResource::collection(SelectOption::all()); 
    }

  
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSelectOptionRequest $request)
    {
        $option = SelectOption::create($request->validated());
        return new SelectOptionResource($option);
    }

    /**
     * Display the specified resource.
     */
    public function show(SelectOption $selectOption)
    {
        return new SelectOptionResource($selectOption);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSelectOptionRequest $request, SelectOption $selectOption)
    {
        $selectOption->update($request->validated());
        return new SelectOptionResource($selectOption);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SelectOption $selectOption)
    {
        $selectOption->delete();
        return response()->json(['message' => 'selectOption is Deleted']);
    }
}
