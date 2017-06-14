<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="articles">
    <h3><?= __('TOP') ?></h3>

        <?php foreach ($articles as $article): ?>
            <article class = 'kiji'>
                <div class = 'title_modified'>
                    <span class = 'title' align = "left"><?= $this->Html->Link(__( h($article->title) ), ['action' => 'view', $article->id]) ?></span>
                    <span class = "modified" align = "right"><?= h($article->modified) ?></span>
                </div>
                <div class = 'photo_text'>
                    <span class = 'photo' align = "left"><img src="https://placehold.jp/150x150.png" alt="sample"></span>
                    <span class = 'text' align = "right"><?= mb_strimwidth(h($article->body), 0, 50, "..."); ?></span>
                </div>
            </article>
        <?php endforeach; ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
