<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout']);
    }
    public function login()
    {
      if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }
            $this->Flash->error(__('ユーザーネームまたはパスワードが間違っています。再度、入力をお願いします。'));
        }

        $this->set('pagename', 'ログイン');
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('管理者として追加されました。'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('管理者の追加に失敗しました。'));
        }
        $this->set('user', $user);

        $this->set('pagename', '管理ユーザ作成');
    }

}
?>
