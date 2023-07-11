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
        $format = $request->input('format', 'var_dump'); // default to var_dump

        // validate the input
        if (! $input) {
            return response()->json(['error' => 'No input provided'], HttpResponses::HTTP_BAD_REQUEST);
        }

        // check if the input is base64_encoded and decode if necessary
        if (base64_encode(base64_decode($input, true)) === $input) {
            $input = base64_decode($input);
        }

        // unserialize and return var_dump output
        try {
            $unserialized = unserialize($input);
            ob_start();

            switch ($format) {
                case 'print_r':
                    print_r($unserialized);
                    break;
                case 'var_export':
                    var_export($unserialized);
                    break;
                case 'var_dump':
                default:
                    var_dump($unserialized);
                    break;
            }

            $result = ob_get_clean();

            return response()->json(['result' => $result], HttpResponses::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unserialization failed', 'message' => $e->getMessage()], HttpResponses::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
