<?php
// 代码生成时间: 2025-08-12 01:05:42
// 文件名：user_authentication.php

use Cake\Http\Exception\UnauthorizedException;
use Cake\Auth\Auth;
use Cake\Auth\BaseAuthenticate;
use Cake\Controller\Controller;
use Cake\Controller\Exception\ForbiddenException;
use Cake\Log\Log;
use Cake\Network\Exception\BadRequestException;
use Cake\Routing\Router;

// 用户身份认证类
class UserAuthentication extends BaseAuthenticate {

    // 验证用户凭证
    public function authenticate(Request $request, CakeEvent $event) {
        // 从请求中获取用户凭证
        $user = $request->getData('user');

        // 检查用户凭证是否有效
        if (!$user) {
            throw new UnauthorizedException(__('Invalid or missing user credentials'));
        }

        // 这里添加用户验证逻辑，例如检查数据库中的用户信息
        // 假设我们有一个用户模型和一个用户验证方法
        $userModel = $this->getUserModel();
        $authenticatedUser = $userModel->find('all', [
            'conditions' => ['username' => $user['username']]
        ])->first();

        if (!$authenticatedUser) {
            throw new UnauthorizedException(__('User not found'));
        }

        // 验证用户密码
        if (!$this->checkPassword($authenticatedUser->password, $user['password'])) {
            throw new UnauthorizedException(__('Invalid password'));
        }

        // 用户验证通过，返回用户信息
        return $authenticatedUser->toArray();
    }

    // 获取用户模型
    protected function getUserModel() {
        // 返回用户模型实例
        return TableRegistry::getTableLocator()->get('Users');
    }

    // 检查密码是否匹配
    protected function checkPassword($hashedPassword, $password) {
        // 使用CakePHP的密码哈希功能来检查密码
        return (new DefaultPasswordHasher())->check($password, $hashedPassword);
    }

    // 不需要实现unauthenticated方法
    public function unauthenticated(Request $request, CakeEvent $event, 
        \Exception $exception) {
        // 根据需要添加逻辑
    }
}

// 控制器中使用用户身份认证
class UsersController extends Controller {

    public function initialize(): void {
        parent::initialize();
        // 设置用户身份认证类
        $this->Auth->setAuthenticator('UserAuthentication');
    }

    public function login() {
        if ($this->request->is('post')) {
            try {
                // 尝试验证用户凭证
                $user = $this->Auth->identify();
                if ($user) {
                    // 用户验证成功，设置认证信息
                    $this->Auth->setUser($user);
                    // 重定向到登录前的页面或首页
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    // 用户验证失败，设置错误信息
                    $this->Flash->error(__('Invalid username or password'));
                }
            } catch (ForbiddenException $exception) {
                // 处理禁止访问异常
                $this->Flash->error(__('You are not authorized to access this location'));
            } catch (BadRequestException $exception) {
                // 处理请求错误异常
                $this->Flash->error(__('Bad request'));
            }
        }
    }

    public function logout() {
        // 注销用户
        $this->Auth->logout();
        // 重定向到登录页面或首页
        return $this->redirect($this->Auth->loginAction());
    }
}
