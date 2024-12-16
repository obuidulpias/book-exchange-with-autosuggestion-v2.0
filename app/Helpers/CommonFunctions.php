<?php
use Illuminate\Support\Facades\DB;

//function apiResponse($data_array, $msg = "Data saved successfully", $status = "success", $header = [])
function apiResponse($data_array, $msg = "Data saved successfully", $status = "success", $status_code = 200)
{

    return response()->json([
        'status' => $status,
        'message' => $msg,
        'data_list' => $data_array
    ], $status_code);

}

function errorResponse($msg = "The transaction is not successfully", $e = [])
{
    DB::rollback();
    $response = [
        'status' => 'failed',
        'message' => $msg,
        'errors' => !empty($e) ? $e->getMessage() : ''
    ];
    return $response;
}

