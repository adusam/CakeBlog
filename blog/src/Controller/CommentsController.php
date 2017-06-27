<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[] paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['add', 'edit', 'delete']);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $comment = $this->Comments->newEntity();
            if (mb_ereg_match("^(\s|　)+$", $this->request->data['body'])) {
                $this->Flash->error(__('空白のみのコメントは投稿できません。'));
                return $this->redirect(['controller' => 'Articles', 'action' => 'view', $this->request->data['article_id']]);
            }

            // hashed password
            if (!empty($this->request->data['password'])) {
                $hasher = new DefaultPasswordHasher();
                $this->request->data['password'] = $hasher->hash($this->request->data['password']);
            }
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());

            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('コメントが投稿されました。'));
            }
            else {
                $this->Flash->error(__('コメント投稿ができませんでした。再度、投稿をお願いします。'));

                if (!empty($comment->getErrors())) {
                    $this->request->session()->write('Comment', $comment);
                }
            }
            return $this->redirect(['controller' => 'Articles', 'action' => 'view', $comment->article_id]);
        } else {
            return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($id === null) {
            return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
        }

        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $hasher = new DefaultPasswordHasher();
            if( !empty($comment->password) && $hasher->check($this->request->data['password'], $comment->password)){
                $mod_comment = $this->Comments->patchEntity($comment, $this->request->getData(), ['fieldList' => ['name', 'body', 'modified']]);
                if ($this->Comments->save($mod_comment)) {
                    $this->Flash->success(__('コメントが投稿されました。.'));

                    return $this->redirect(['controller' => 'Articles', 'action' => 'view', $mod_comment->article_id]);
                } else {
                    $this->Flash->error(__('コメント投稿ができませんでした。再度、投稿をお願いします。'));
                }
            } else {
                $this->Flash->error(__('パスワードが間違っているか、投稿時にパスワードが設定されていません。'));
            }
        }
        $comment->password = '';
        $this->set(compact('comment'));
        $this->set('_serialize', ['comment']);

        $this->set('pagename', 'コメントの編集');
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        $hasher = new DefaultPasswordHasher();

        if( isset($comment->password) && !empty($comment->password)
        && isset($this->request->data['password'])
        && $hasher->check($this->request->data['password'], $comment->password))
        {
            if ($this->Comments->delete($comment)) {
                $this->Flash->success(__('コメントが削除されました。'));
            } else {
                $this->Flash->error(__('コメントの削除ができませんでした。再度、削除をお願いします。'));
            }
        }
        else {
            $this->Flash->error(__('パスワードが間違っているか、設定されていません。'));
            return $this->redirect(['controller' => 'Comments', 'action' => 'edit', $comment->id]);
        }
        return $this->redirect(['controller' => 'Articles', 'action' => 'view', $comment->article_id]);
    }
}
