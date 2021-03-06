<?php
/**
* @var \App\View\AppView $this
*/
?>
<div class="articles view large-10 columns content">
    <article>
        <div class="view_article">
            <div class="clearfix">
                <div class="view_article_date"><?= h($article->modified->format('Y/m/d H:i')) ?></div>
                <h2 class="view_article_title"><?= h($article->title) ?></h2>
            </div>
            <div class="view_article_picture">
                <span>
                    <?php
                    if ( !is_null($article['picture_id'])) {
                        $img = "/webroot/uploads/pictures/" . $article->picture['data'];
                        echo $this->Html->image($img);
                    }
                    ?>
                </span>
            </div>
            <div class="view_article_body">
                <?= $this->Text->autoParagraph(h($article->body)); ?>
            </div>
        </div>

        <?php if (!empty($article->comments)): ?>
        <div class="view_comment_list related">
            <h4><?= __('記事へのコメント') ?></h4>
            <?php foreach ($article->comments as $comment): ?>
                <?php if(empty($comment->name) || is_null($comment->name)) $comment->name = '匿名'; ?>
                <article class="view_comment">
                    <div class="comment_head clearfix">
                        <span class="comment_hname"><?= h($comment->name) ?></span>
                        <span class="actions right">
                            <?= $this->Html->link(__('編集・削除'), ['controller' => 'Comments', 'action' => 'edit', $comment->id]) ?>
                        </span>
                        <span class="comment_date right"><?= h($comment->modified->format('Y/m/d H:i')) ?></span>
                    </div>
                    <div class="comment_body">
                        <?= $this->Text->autoParagraph(h($comment->body)); ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
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
                echo $this->Form->control('password', ['label' => 'パスワード', 'value' => '']);
                echo $this->Form->hidden('article_id', ['value' => $article->id]);
            ?>
            <div class="caution">※PWを設定しない場合、コメントの編集・削除ができません。</div>
        </fieldset>
        <?= $this->Form->button(__('投稿'), ['onclick' => 'javascript:disableBtn(this);submit(this);']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script type="text/javascript">
    function disableBtn(btn) {
        btn.disabled = true;
    }
</script>
