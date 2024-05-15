<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataTransformation\Codecs\Base64;
use App\Helpers\DataTransformation\Serializers\Serialized;
use App\Http\Controllers\Controller;
use App\Models\Decode;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DecodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // Extract the serialized data from the request
        $encodedData = $request->input('data');

        // Check if data is actually provided
        if (! $encodedData) {
            return response()->json(['error' => 'No data provided'], Response::HTTP_BAD_REQUEST);
        }

        $isBase64EncodedAndSerialized = Base64::isBase64Encoded($encodedData) && Serialized::isSerialized(Base64::decode($encodedData));
        $isOnlySerialized = ! Base64::isBase64Encoded($encodedData) && Serialized::isSerialized($encodedData);

        if ($isBase64EncodedAndSerialized) {
            // Decode the data from Base64, then deserialize
            $decodedData = Base64::decode($encodedData);
            $unserializedData = Serialized::decode($decodedData);
        } elseif ($isOnlySerialized) {
            // Directly deserialize the data
            $unserializedData = Serialized::decode($encodedData);
        } else {
            // Set data to null if it's neither
            $unserializedData = null;
        }

        // Use print_r with the return parameter set to true
        $printRResult = $unserializedData ? print_r($unserializedData, true) : null;

        // Use var_export with the return parameter set to true
        $varExportResult = $unserializedData ? var_export($unserializedData, true) : null;

        $jsonResults = $unserializedData ? json_encode($unserializedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null;

        if ($jsonResults) {
            Decode::create([
                'user_id' => Auth::id(),
                'data' => json_encode($jsonResults, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            ]);
        }

        // Prepare the response array
        $response = [
            'print_r' => $printRResult,
            'var_export' => $varExportResult,
            'json' => $jsonResults,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Decode $decode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Decode $decode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Decode $decode)
    {
        //
    }
}
