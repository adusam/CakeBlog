<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;

/**
 * Manage Controller
 *
 * @property \App\Model\Table\ArticlesTable $Manage
 *
 * @method \App\Model\Entity\Articles[] paginate($object = null, array $settings = [])
 */

class ManageController extends AppController
{

    public function initialize()
   {
       parent::initialize();
       $this->Articles = TableRegistry::get('Articles');
   }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pictures']
        ];

        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);

        $this->set('pagename', '管理画面');
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($id === null) {
            $article = $this->Articles->newEntity();
        } else {
            $article = $this->Articles->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $pictures = $this->Articles->Pictures->find('list', ['limit' => 200]);
        $this->set(compact('article', 'pictures'));
        $this->set('_serialize', ['article']);

        $this->set('id', $id);//delete ボタン判断用
        $this->set('pagename', '記事追加/編集');


        if (!empty($this->request->data)) {
            $data = array(
                'Pictuer' => array(
                    'filename' => $this->request->data['Pictuer']['pictuer']['name'],
                    'type' => $this->request->data['Pictuer']['pictuer']['type'],
                    'contents' => file_get_contents($this->request->data['Pictuer']['pictuer']['tmp_name']),
                )
            );
            if ($this->Pictuer->save($data)) {
                $this->Session->setFlash('アップロードしました');
            } else {
                $this->Session->setFlash('アップロードできませんでした');
            }
        }

    }
    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function contents($id)
    {
        $data = $this->PictuerDatas->get($id);
        $this->autoRender = false;
        $this->respons->type('image/jpeg');
        $this->respons->body(stream_get_contents($data->thumbnail));
    }
}
