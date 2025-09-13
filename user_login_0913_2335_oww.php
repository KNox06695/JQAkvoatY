<?php
// 代码生成时间: 2025-09-13 23:35:42
// user_login.php
// 用户登录验证系统

use Cake\ORM\TableRegistry;
use Cake\Validation\Validation;
use Cake\Auth\Auth;
use Cake\Auth\FormAuthenticate;
use Cake\Routing\Routing;
use Cake\Utility\Text;
use Cake\Controller\Controller;
use Cake\Controller\RequestHandler;
use Cake\Controller\Exception\ForbiddenException;
use Cake\Controller\Exception\UnauthorizedException;
use Cake\Controller\Exception\NotFoundException;

class UsersController extends AppController
{
    // 构造函数
    public function initialize()
    {
        parent::initialize();
        // 将用户验证添加到登录控制器
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ]
        ]);
    }
    
    // 登录方法
    public function login()
    {
        if ($this->request->is('post')) {
            // 检查用户凭证
            $user = $this->Auth->identify();
            
            if ($user) {
                // 用户验证成功
                $this->Auth->setUser($user);
                
                // 重定向到登录前页面
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                // 用户验证失败，设置错误消息
                $this->Flash->error(__('Invalid username or password'));
            }
        }
    }
    
    // 登出方法
    public function logout()
    {
        // 清除用户会话并重定向到登录页面
        $this->Flash->success(__('You are now logged out.'));
        return $this->redirect($this->Auth->logout());
    }
}
