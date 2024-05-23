<?php

namespace App\Http\Controllers\Api;

use App\Enums\DecodeTypeEnum;
use App\Helpers\DataTransformation\Codecs\Base64;
use App\Helpers\DataTransformation\Serializers\Serialized;
use App\Http\Controllers\Controller;
use App\Http\Requests\DecodeRequest;
use App\Models\Decode;
use App\Models\DecodeType;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DecodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $decodes = Decode::whereUserId(Auth::id())->with(['type'])->get();

        return response()->json($decodes, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DecodeRequest $request): JsonResponse
    {
        // Extract the serialized data from the request
        $encodedData = $request->input('encoded_data');

        // Check if data is actually provided
        if (! $encodedData) {
            return response()->json(['error' => 'No data provided'], Response::HTTP_BAD_REQUEST);
        }

        switch ($request->input('type')) {
            case DecodeTypeEnum::SERIAL->value:
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

                    return response()->json(['message' => 'Nothing unserialized.'], Response::HTTP_NO_CONTENT);
                }

                $decodeTypeId = DecodeType::where('name', DecodeTypeEnum::SERIAL)->first()->id;

                $decode = Decode::create([
                    'user_id' => Auth::id(),
                    'data' => $unserializedData,
                    'decode_type_id' => $decodeTypeId,
                ]);
                break;

            case DecodeTypeEnum::BASE64->value:
                $decodedData = Base64::isBase64Encoded($request->input('encoded_data')) ? Base64::decode($request->input('encoded_data')) : null;

                $decodeTypeId = DecodeType::where('name', DecodeTypeEnum::BASE64)->first()->id;

                $decode = Decode::create([
                    'user_id' => Auth::id(),
                    'data' => $decodedData,
                    'decode_type_id' => $decodeTypeId,
                ]);
                break;

            default:
                $decode = null;
                break;
        }

        return response()->json($decode, $decode ? Response::HTTP_OK : Response::HTTP_NO_CONTENT);
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
