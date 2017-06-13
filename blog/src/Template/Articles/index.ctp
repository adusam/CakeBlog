<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="articles index large-9 medium-8 columns content">
    <h3><?= __('TOP') ?></h3>

        <?php foreach ($articles as $article): ?>
            <article>
                <div>
                    <span align="left"><?= h($article->title) ?></span>
                    <span align="right"><?= h($article->modified) ?></span>
                </div>
                <div>
                    <span align="left"></span>
                    <span align="right"><?= mb_strimwidth(h($article->body), 0, 50, "..."); ?></span>
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
