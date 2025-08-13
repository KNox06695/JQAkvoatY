<?php
// 代码生成时间: 2025-08-14 03:44:24
// ApiResponseFormatter.php
// 这是一个用于格式化API响应的工具类，遵循PHP最佳实践和CAKEPHP框架

class ApiResponseFormatter {

    /**
     * 格式化成功的API响应
     * @param array $data 需要返回的数据
# 优化算法效率
     * @param string $message 可选的成功消息
     * @return array 格式化后的API响应数组
     */
    public function formatSuccess(array $data, string $message = ""): array {
        $response = [
            'status' => 'success',
            'data' => $data,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return $response;
    }

    /**
     * 格式化失败的API响应
# 扩展功能模块
     * @param string $message 错误消息
     * @param int $errorCode 错误代码，默认为500
     * @return array 格式化后的API响应数组
     */
# 扩展功能模块
    public function formatError(string $message, int $errorCode = 500): array {
# 优化算法效率
        return [
            'status' => 'error',
            'message' => $message,
            'error_code' => $errorCode,
        ];
    }

}

// 使用示例
$formatter = new ApiResponseFormatter();

// 成功响应
# 增强安全性
$successResponse = $formatter->formatSuccess(['key' => 'value'], 'Operation successful');

// 错误响应
# NOTE: 重要实现细节
$errorResponse = $formatter->formatError('Error occurred', 404);
