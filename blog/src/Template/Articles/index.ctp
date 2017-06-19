<?php
/**
* @var \App\View\AppView $this
*/
?>

<div class="articles index large-10">
    <?php foreach ($articles as $article): ?>
    <article class = 'kiji'>
        <div class = "article_modified right"><?= h($article->modified->format('Y/m/d H:i')) ?></div>
        <div class = 'article_title'><?= $this->Html->Link(__( h($article->title) ), ['action' => 'view', $article->id]) ?></div>
            <!-- <div class = 'title_modified'> -->
        <!-- </div> -->
        <div class = 'picture_body'>
            <span class = 'article_picture'><img src="https://placehold.jp/150x150.png" alt="sample"></span>
            <span class = 'article_body'><?= mb_strimwidth(h($article->body), 0, 50, "..."); ?></span>
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
