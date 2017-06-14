<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[] paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->autoRender = false;
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
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
        var_dump($comment->password);
        var_dump($this->request->getData('Post.password'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            if( !empty($this->request->getData('Post.password')) || $this->request->getData('Post.password') == $comment->password){
                $mod_comment = $this->Comments->patchEntity($comment, $this->request->getData());
                if ($this->Comments->save($mod_comment)) {
                    $this->Flash->success(__('The comment has been saved.'));

                    return $this->redirect(['controller' => 'Articles', 'action' => 'view', $mod_comment->article_id]);
                } else {
                    $this->Flash->error(__('The comment could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('password is wrong or not set'));
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
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
