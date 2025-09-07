<?php
// 代码生成时间: 2025-09-08 04:53:56
// 用户登录验证系统
// CakePHP框架实现

use Cake\Http\Exception\UnauthorizedException;
use Cake\Routing\Router;
use Cake\Controller\Controller;
use Cake\Controller\RequestHandlerInterface;
use Cake\Validation\ValidatorInterface;
use Cake\Validation\Validation;

class UsersController extends AppController implements RequestHandlerInterface
{
    public function initialize(): void
    {
        parent::initialize();
        // 确保用户登录验证系统仅用于POST请求
        $this->request->allowMethod(['post']);
    }

    public function login(): ?string
    {
        if ($this->request->is('post')) {
            $user = $this->Users->newEmptyEntity();
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            // 验证请求数据
            $validator = new Validation();
            $validator
                ->notEmptyString('email', 'Email is required')
                ->email('email', 'Email is not valid')
                ->notEmptyString('password', 'Password is required');
            
            if ($this->Users->validate($user, $validator)) {
                // 验证成功，尝试登录用户
                $user = $this->Users->find()->where(['email' => $user->email])->firstOrFail();
                if (password_verify($user->password, $user->password)) {
                    // 设置用户会话
                    $this->set('user', $user);
                    return 'User logged in successfully';
                } else {
                    // 密码错误
                    throw new UnauthorizedException('Invalid credentials');
                }
            } else {
                // 验证失败
                throw new UnauthorizedException('Validation failed');
            }
        }
        return null;
    }
}
