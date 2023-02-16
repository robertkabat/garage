<?php

namespace App\Traits\Api;

use Illuminate\Http\JsonResponse;

/**
 * Trait HasResponseShortcuts
 * @package App\Traits\Api
 */
trait HasJsonResponseShortcuts
{
    /**
     * Shortcut method for HTTP OK response (200).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function okResponse(
        array $data = [],
        int $status = 200,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 200
        $data = !empty($data) ? $data : ['message' => 'OK', 'data' => []];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP CREATED response (201).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function createdResponse(
        array $data = [],
        int $status = 201,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 201
        $data = !empty($data) ? $data : ['message' => 'CREATED'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP accepted response (202).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function acceptedResponse(
        array $data = [],
        int $status = 202,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 202
        $data = !empty($data) ? $data : ['message' => 'We have accepted your request and it will be processed soon'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP no content response (204).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function noContentResponse(
        array $data = [],
        int $status = 204,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 204
        $data = !empty($data) ? $data : ['message' => 'No content'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP forbidden response (401).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function forbiddenResponse(
        array $data = [],
        int $status = 403,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 403
        $data = !empty($data) ? $data : ['message' => 'Sorry, you are not authorized to perform this action.'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP bad request response (400).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function badRequestResponse(
        array $data = [],
        int $status = 400,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 400
        $data = !empty($data) ? $data : ['message' => 'Sorry, something went wrong.'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP unauthorized response (401).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function unauthorizedResponse(
        array $data = [],
        int $status = 401,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 401
        $data = !empty($data) ? $data : ['message' => 'Sorry, you are unauthorized.'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP not found response (404).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function notFoundResponse(
        array $data = [],
        int $status = 404,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 404
        $data = !empty($data) ? $data : ['message' => 'Sorry, requested resource has not been found.'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Shortcut method for HTTP conflict response (409).
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function conflictResponse(
        array $data = [],
        int $status = 409,
        array $headers = [],
        $options = 0
    ): JsonResponse {
        // in case there is no data passed let's pass default response for 409
        $data = !empty($data) ? $data : ['message' => 'Sorry, there seems to be a conflict.'];

        // return the json response object
        return response()->json($data, $status, $headers, $options);
    }
}
