<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDecodeRequest;
use App\Http\Requests\UpdateDecodeRequest;
use App\Models\Decode;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponses;

class DecodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $decode = Auth::user()->decodes;

        return response()->json($decode, HttpResponses::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDecodeRequest $request): JsonResponse
    {
        try {
            $decode = Decode::create([
                'data' => $request->input('data'),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], HttpResponses::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['decode' => $decode], HttpResponses::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Decode $decode): JsonResponse
    {
        return response()->json($decode, HttpResponses::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDecodeRequest $request, Decode $decode): JsonResponse
    {
        $decode->updateOrFail($request->validated());

        return response()->json($decode, HttpResponses::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Decode $decode): JsonResponse
    {
        $decode->delete();

        return response()->json(null, HttpResponses::HTTP_NO_CONTENT);
    }

    /**
     * Permanently delete all Decode for the authenticated user.
     */
    public function forceDestroyAll(Request $request): JsonResponse
    {
        $decode = Auth::user()->DecodeData()->forceDelete();

        return response()->json($decode, HttpResponses::HTTP_OK);
    }
}
