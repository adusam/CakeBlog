<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

use App\Model\Entity\Comment;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[] paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view']);
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

        $this->set('pagename', '記事一覧');
    }


    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Pictures', 'Comments']
        ]);
        $this->set('article', $article);
        $this->set('new_comment', new Comment());
        $this->set('_serialize', ['article', 'new_comment']);

        $this->set('pagename', '記事詳細');
    }

    public function isAuthorized($user)
{
    // All registered users can add articles
    if ($this->request->getParam('action') === 'add') {
        return true;
    }

    // The owner of an article can edit and delete it
    if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
        $articleId = (int)$this->request->getParam('pass.0');
        if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
}

public function isOwnedBy($articleId, $userId)
{
    return $this->exists(['id' => $articleId, 'user_id' => $userId]);
}
}
