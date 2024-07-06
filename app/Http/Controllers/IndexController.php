<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Resources\IndexResource;
use App\Models\Index;

class IndexController extends Controller
{
    public function index()
    {
        return IndexResource::collection(Index::all());
    }

    public function store(IndexRequest $request)
    {
        return new IndexResource(Index::create($request->validated()));
    }

    public function show(Index $index)
    {
        return new IndexResource($index);
    }

    public function update(IndexRequest $request, Index $index)
    {
        $index->update($request->validated());

        return new IndexResource($index);
    }

    public function destroy(Index $index)
    {
        $index->delete();

        return response()->json();
    }
}
