<?php
/**
  * @var \App\View\AppView $this
  */
?>

<nav class="large-3 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('新規投稿'), ['action' => 'edit']) ?></li>
    </ul>
</nav>
<div class="manage index large-9 medium-9 columns content">
    <table class="manage_table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class='thead_id' scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th class="thead_title" scope="col"><?= $this->Paginator->sort('title', ['label' => 'タイトル']) ?></th>
                <th class="thead_modified" scope="col"><?= $this->Paginator->sort('modified', ['label' => '最新更新日時']) ?></th>
                <th class='thead_action' scope="col" class="actions"><?= __('操作') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr class = 'kiji'>
                <td class='kiji_id' align = "left"><?= $this->Number->format($article->id) ?></td>
                <td class='kiji_title'><?= h($article->title) ?></td>
                <td class='kiji_modified'><?= h($article->modified->format('Y/m/d H:i')) ?></td>
                <td class='kiji_actions' align = "right">
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $article->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $article->id),
                        'class' => 'button_delete'
                        ]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
