<?php
// 代码生成时间: 2025-09-13 10:11:40
use Cake\ORM\TableRegistry;

// 创建一个简单的用户表模型
$table = TableRegistry::getTableLocator()->get('Users');

// 实现一个函数来防止SQL注入
function preventSqlInjection($username, $password) {
    // 尝试使用CakePHP的查询构建器来防止SQL注入
    try {
        $query = $table->find()
            ->where(['username' => $username])
            ->first();
    
        // 检查查询结果是否存在
        if ($query) {
            // 检查密码是否匹配
            if (password_verify($password, $query->password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        // 错误处理
        error_log($e->getMessage());
        return false;
    }
}

// 示例用法
$username = 'exampleUser';
$password = 'examplePass';

if (preventSqlInjection($username, $password)) {
    echo '登录成功';
} else {
    echo '登录失败，用户名或密码错误';
}