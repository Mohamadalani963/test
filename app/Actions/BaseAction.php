<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseAction
{
    private array $data = [];

    protected function getter($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
    protected function setter($key, $value)
    {
        $this->data[$key] = $value;
    }
    public function success($data = [], $key = 'data', $statusCode = 200, $status = 'success')
    {
        $response = [
            'status' => 'success',
        ];
        if ($data) {
            $response[$key] = $data;
        }

        return response()->json($response)->setStatusCode($statusCode);
    }

    public function failure($error = [], $statusCode = 500, $status = 'fail')
    {
        $result = array_merge(['status' => $status], $error);

        return response($result)->setStatusCode($statusCode);
    }

    protected function transaction(callable $call_back, ?callable $onError = null)
    {
        $var = null;
        try {
            DB::beginTransaction();
            $var = $call_back();
            DB::commit();
            return $var;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());
            if ($onError != null) {
                $onError($e);
            }
        }
    }
}
