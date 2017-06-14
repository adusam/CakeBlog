<?php
/**
* @var \App\View\AppView $this
*/
?>
<div class="articles view large-9 medium-8 columns content">
    <article class="vertical-table">
        <div>
            <span><?= h($article->title) ?></span>
            <span><?= h($article->modified) ?></span>
        </div>
        <div>
            <span scope="row"><?= __('Picture Id') ?></span>
            <span><?= $this->Number->format($article->picture_id) ?></span>
        </div>
        <div>
            <?= $this->Text->autoParagraph(h($article->body)); ?>
        </div>
    </article>

    <h4><?= __('Related Comments') ?></h4>
    <article class="related">
        <?php foreach ($article->comments as $comment): ?>
            <?php if(empty($comment->name) || is_null($comment->name)) $comment->name = '匿名'; ?>
            <div>
                <span><?= h($comment->name) ?></span>
                <span><?= h($comment->modified) ?></span>
            </div>
            <div>
                <span><?= h($comment->body) ?></span>
                <span class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comment->id]) ?>
                </span>
            </div>
        <?php endforeach; ?>
    </article>


<!-- <?=var_dump($article->comments) ?> -->
    <div>
        <?= $this->Form->create($article->comments, [
            'url' => ['controller' => 'Comments', 'action' => 'add'],
            'type' => 'post'
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
