<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSerializedRequest;
use App\Http\Requests\UpdateSerializedRequest;
use App\Models\Serialized;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponses;

class SerializedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serialized = Auth::user()->serializedData;

        return response()->json($serialized, HttpResponses::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSerializedRequest $request): JsonResponse
    {
        try {
            $serialized = Serialized::create([
                'data' => $request->input('data'),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Could not create Serialized.'], HttpResponses::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['serialized' => $serialized], HttpResponses::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Serialized $serialized): JsonResponse
    {
        return response()->json($serialized, HttpResponses::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSerializedRequest $request, Serialized $serialized): JsonResponse
    {
        $serialized->updateOrFail($request->validated());

        return response()->json($serialized, HttpResponses::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serialized $serialized): JsonResponse
    {
        $serialized->delete();

        return response()->json(null, HttpResponses::HTTP_NO_CONTENT);
    }

    /**
     * Permanently delete all serialized for the authenticated user.
     */
    public function forceDestroyAll(Request $request): JsonResponse
    {
        $serialized = Auth::user()->serializedData()->forceDelete();

        return response()->json($serialized, HttpResponses::HTTP_OK);
    }
}
