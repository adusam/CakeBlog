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
        <?php foreach ($article->comments as $comments): ?>
            <div>
                <span><?= h($comments->name) ?></span>
                <span><?= h($comments->modified) ?></span>
            </div>
            <div>
                <span><?= h($comments->body) ?></span>
                <span class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                </span>
            </div>
        <?php endforeach; ?>
    </article>



    <article>
        <h4><?= __('Add Comments') ?></h4>
        <div>
            <span scope="row"><?= __('Handle Name') ?></span>
            <input type = “text” name =“handlename/“><br/>
        </div>
        <div>
            <span scope="row"><?= __('body') ?></span>
            <textarea name =“body“></textarea>
        </div>
        <div>
            <span scope="row"><?= __('Password') ?></span>
            <input type = “text” name =“password/“><br/>
        </div>

        <input type = "submit" value ="送信">
    </article>
</div>
