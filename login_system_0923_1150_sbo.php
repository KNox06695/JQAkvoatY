<?php
// 代码生成时间: 2025-09-23 11:50:49
// 引入CAKEPHP框架核心文件
require_once 'vendor/autoload.php';

use Cake\Core\Configure;
use Cake\Database\Type;
use Cake\Auth\Auth;
use Cake\Controller\Controller;
use Cake\Controller\Exception\ForbiddenException;
use Cake\Controller\Exception\UnauthorizedException;
use Cake\Controller\Exception\NotFoundException;
use Cake\Controller\ControllerFactory;

// 定义用户登录验证系统控制器
class LoginController extends Controller 
{
    // 登录验证方法
    public function login() 
    {
        // 验证用户请求方法是否为POST
        if ($this->request->is('post')) {
            // 从请求中获取用户名和密码
            $username = $this->request->getData('username');
            $password = $this->request->getData('password');
            
            // 调用Auth组件进行登录验证
            $user = $this->Auth->identify();
            
            // 验证结果
            if ($user) {
                // 如果验证成功，将用户信息保存到session中
                $this->Auth->setUser($user);
                // 重定向到成功页面
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
            } else {
                // 如果验证失败，保存错误信息到flash消息中
                $this->Flash->error(__('Invalid username or password'));
            }
        } else {
            // 如果请求方法不是POST，抛出异常
            throw new MethodNotAllowedException(__('This action is not allowed'));
        }
    }

    // 登出方法
    public function logout() 
    {
        // 调用Auth组件进行登出操作
        $this->Auth->logout();
        // 重定向到登录页面
        return $this->redirect(['controller' => 'Login', 'action' => 'login']);
    }
}

// 定义用户模型
class User extends AppModel 
{
    // 实现用户验证方法
    public function beforeSave($options = array()) 
    {
        // 如果密码字段发生变化，进行加密处理
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password'], 'blowfish');
        }
        return true;
    }
}

// 配置Auth组件
Configure::write('Auth', [
    'authenticate' => [
        'Form' => [
            'fields' => [
                'username' => 'username',
                'password' => 'password'
            ]
        ]
    ]
]);

?>