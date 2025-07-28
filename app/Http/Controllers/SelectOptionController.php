<?php

namespace App\Http\Controllers;

use App\Models\Select_option;
use App\Http\Requests\StoreSelect_optionRequest;
use App\Http\Requests\StoreSelectoptionRequest;
use App\Http\Requests\UpdateSelect_optionRequest;
use App\Http\Requests\UpdateSelectoptionRequest;
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
    public function store(StoreSelectoptionRequest $request)
    {
        $option = SelectOption::create($request->validated());
        return new SelectOptionResource($option);
    }

    /**
     * Display the specified resource.
     */
    public function show(Selectoption $selectoption)
    {
        return new SelectOptionResource($selectoption);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSelectoptionRequest $request, Selectoption $selectoption)
    {
        $selectoption->update($request->validated());
        return new SelectOptionResource($selectoption);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Selectoption $selectoption)
    {
        $selectoption->delete();
        return response()->json(['message' => 'selectoption is Deleted']);
    }
}
