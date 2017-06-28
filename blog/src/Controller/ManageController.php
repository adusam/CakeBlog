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
        $this->Pictures = TableRegistry::get('Pictures');
    }
    /**
    * Index method
    *
    * @return \Cake\Http\Response|null
    */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pictures'],
            'order' => ['id' => 'desc']
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
                'contain' => ['Pictures']
            ]);
        }

        $picture = $this->Pictures->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData(), ['associated' => ['Pictures']]);
            if (isset($this->request->data['picture_id']['tmp_name'])) {
                $tmp = $this->request->data['picture_id']['tmp_name'];
                // return var_dump($name);
                $img_data = file_get_contents($tmp);
                // $ext = $img_data->ext();

                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_buffer($fileinfo, $img_data);
                finfo_close($fileinfo);
                $extension_array = array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif'
                );

                $filename = date('ymdHis_').$this->request->data['picture_id']['name'];
                // $fileInfo = new File("/xampp/htdocs/CakeBlog/blog/webroot/uploads/pictures/");
        

                if($img_extension = array_search($mime_type, $extension_array) || $tmp === ""){
                    if(is_uploaded_file($tmp)) {
                        $dir = "/xampp/htdocs/CakeBlog/blog/webroot/uploads/pictures";
                        move_uploaded_file($tmp, $dir . DS . $filename);

                        $picture = $this->Pictures->patchEntity($picture, ['data' => $filename]);
                        if ($this->Pictures->save($picture)) {
                            echo "saved\n";
                        }
                        else {
                            $this->Flash->error(__('画像の保存ができませんでした。'));
                        }
                    }
                }
                else{
                    $this->Flash->error(__('このファイルはアップロードできません。'));
                    return;
                }

            }
            $article['picture_id'] = $picture['id'];

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('記事が投稿されました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('記事の投稿ができませんでした。再度、投稿をお願いします。'));
        }

        $this->set(compact('article'));
        $this->set('_serialize', ['article']);
        $this->set('pagename', '記事追加/編集');//ページタイトル
        $this->set('id', $id);//delete ボタン判断用

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
            $this->Flash->success(__('記事が削除されました。'));
        } else {
            $this->Flash->error(__('記事の削除に失敗しました、再度、削除をお願いします。'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
