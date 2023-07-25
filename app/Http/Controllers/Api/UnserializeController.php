<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponses;

class UnserializeController extends Controller
{
    public function decode(Request $request): JsonResponse
    {
        $input = $request->input('serialized');
        $format = $request->input('format', 'var_dump');

        // Validate the input
        if (! $input) {
            return response()->json(['error' => 'No input provided'], HttpResponses::HTTP_BAD_REQUEST);
        }

        // Check if the input is base64_encoded and decode if necessary
        if (base64_encode(base64_decode($input, true)) === $input) {
            $input = base64_decode($input);
        }

        try {
            $unserialized = unserialize($input);

            ob_start();
            print_r($unserialized);
            $print_r = ob_get_clean();

            ob_start();
            var_export($unserialized);
            $var_export = ob_get_clean();

            ob_start();
            var_dump($unserialized);
            $var_dump = ob_get_clean();

            return response()->json([
                'print_r' => $print_r,
                'var_export' => $var_export,
                'var_dump' => $var_dump,
            ], HttpResponses::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unserialization failed', 'message' => $e->getMessage()], HttpResponses::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
