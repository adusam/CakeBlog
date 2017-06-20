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
        <div class = 'picture_body'>
            <span class = 'article_picture'>
                <?php
                if ( is_null($article['picture_id'])) {
                    $img = "/webroot/uploads/pictures/noimage.jpg";
                }
                else {
                    $img = "/webroot/uploads/pictures/" . $article->picture['data'];
                }
                ?>
                <?= $this->Html->image($img) ?>
            </span>
            <span class = 'article_body'><?= mb_strimwidth(h($article->body), 0, 50, "..."); ?></span>
        </div>
    </article>
    <?php endforeach; ?>
    <div class="paginator">
        <ul class="pagination">
            <!-- <?= $this->Paginator->first('<< ' . __('first')) ?> -->
            <!-- <?= $this->Paginator->prev('< ' . __('previous')) ?> -->
            <?= $this->Paginator->numbers(['first' => 1, 'last' => 1, 'modulus' => 6]);  ?>
            <!-- <?= $this->Paginator->next(__('next') . ' >') ?> -->
            <!-- <?= $this->Paginator->last(__('last') . ' >>') ?> -->
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
