<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query_data = ProductCategory::all();
            $formatted_datas = new ProductCategoryCollection($query_data);
            return response() -> json([
                "message" => "success",
                "data" => $formatted_datas
            ], 200);
        } catch (Exception $e) {
            return response() -> json($e -> getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validated_request = $request->validated();
        try {
            $query_data = ProductCategory::create($validated_request);
            $formatted_datas = new ProductCategoryResource($query_data);
            return response() -> json([
                "message" => "success",
                "data" => $formatted_datas,
            ], 200);
        } catch (Exception $e) {
            return response() -> json($e -> getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $query_data = ProductCategory::findOrFail($id);
            $formatted_datas = new ProductCategoryResource($query_data);
            return response() -> json([
                "message" => "success",
                "data" => $formatted_datas
            ], 200);
        } catch (Exception $e) {
            return response() -> json($e -> getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        $validated_request = $request -> validated();
        try{
            $query_data = ProductCategory::findOrFail($id);
            $query_data -> update($validated_request);
            $query_data -> save();
            $formatted_datas = new ProductCategoryResource($query_data);
            return response() -> json([
                "message" => "success",
                "data" => $formatted_datas
            ], 200);
        } catch (Exception $e) {
            return response() -> json($e -> getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $query_data = ProductCategory::findOrFail($id);
            $query_data -> delete();
            $formatted_datas = new ProductCategoryResource($query_data);
            return response() -> json([
                "message" => "success",
                "data" => $formatted_datas
            ], 200);
        } catch(Exception $e) {
            return response() -> json($e -> getMessage(), 400);
        }
    }
}
