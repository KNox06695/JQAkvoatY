<?php
// 代码生成时间: 2025-10-05 16:47:40
// ApiResponseFormatter.php
// 用于格式化API响应的工具类

class ApiResponseFormatter {

    /**
     * 格式化成功的API响应
     * @param mixed $data 要返回的数据
     * @param string $message 操作成功的信息
     * @return array 格式化后的API响应数组
     */

    public function success($data, $message = 'Operation successful') {

        return [
            'status' => 'success',
            'data' => $data,
            'message' => $message
        ];
    }

    /**
     * 格式化失败的API响应
     * @param string $error 错误信息
     * @param int $code 错误代码，默认为500

     * @return array 格式化后的API响应数组

     */

    public function error($error, $code = 500) {

        return [
            'status' => 'error',
            'error' => $error,
            'code' => $code
        ];
    }

    /**
     * 创建API响应
     * @param bool $success 请求是否成功

     * @param mixed $data 返回的数据

     * @param string $message 操作信息

     * @param string|null $error 错误信息，如果有的话

     * @param int|null $code 错误代码，如果有的话

     * @return array 完整的API响应数组

     */

    public function createResponse($success, $data = null, $message = '', $error = null, $code = null) {

        if ($success) {

            // 如果请求成功，则返回成功的响应格式

            return $this->success($data, $message);

        } else {

            // 如果请求失败，则返回错误的响应格式

            return $this->error($error, $code);

        }
    }

}

// 使用示例
$responseFormatter = new ApiResponseFormatter();

// 成功响应
$successResponse = $responseFormatter->createResponse(true, ['id' => 1, 'name' => 'John'], 'User created successfully');

// 错误响应
$errorResponse = $responseFormatter->createResponse(false, null, '', 'User not found', 404);

header('Content-Type: application/json');
echo json_encode($successResponse);
// 或者
echo json_encode($errorResponse);
