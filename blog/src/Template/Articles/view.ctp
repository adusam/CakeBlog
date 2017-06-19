<?php
/**
* @var \App\View\AppView $this
*/
?>
<div class="articles view large-9 medium-8 columns content">
    <article>
        <div class="view_article">
            <div class="clearfix">
                <h2><?= h($article->title) ?></h2>
                <div class="view_article_date"><?= h($article->modified->format('Y/m/d H:i')) ?></div>
            </div>
            <div class="view_article_picture">
                <span><?= __('Picture Id') ?></span>
                <span><?= $this->Number->format($article->picture_id) ?></span>
            </div>
            <div class="view_article_body">
                <?= $this->Text->autoParagraph(h($article->body)); ?>
            </div>
        </div>

        <div class="view_comment_list related">
            <h4><?= __('記事へのコメント') ?></h4>
            <?php foreach ($article->comments as $comment): ?>
                <?php if(empty($comment->name) || is_null($comment->name)) $comment->name = '匿名'; ?>
                <article class="view_comment">
                    <div class="comment_head clearfix">
                        <span class="comment_hname"><?= h($comment->name) ?></span>
                        <span class="actions right">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comment->id]) ?>
                        </span>
                        <span class="comment_date right"><?= h($comment->modified->format('Y/m/d H:i')) ?></span>
                    </div>
                    <div class="comment_body">
                        <span><?= h($comment->body) ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </article>

    <div class="view_comment_form clearfix">
        <?= $this->Form->create($new_comment, [
            'url' => ['controller' => 'Comments', 'action' => 'add'],
            ]) ?>
        <fieldset>
            <legend><?= __('コメント投稿') ?></legend>
            <?php
                echo $this->Form->control('name', ['label' => 'お名前']);
                echo $this->Form->control('body', ['label' => '内容', 'type' => 'textarea']);
                echo $this->Form->control('password', ['label' => 'パスワード']);
                echo $this->Form->hidden('article_id', ['value' => $article->id]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
