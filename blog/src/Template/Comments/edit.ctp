<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $comment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comments form large-9 medium-8 columns content">
    <?= $this->Form->create($comment) ?>
    <fieldset>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('body');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('SUBMIT')) ?>
    <?php $url = $this->Url->build(['controller' => 'Articles' ,'action' => 'view', $comment->article_id]) ?>
    <?= $this->Form->button(__('CANCEL'), ['type' => 'button', 'onclick' => "location.href='$url'"]) ?>
    <?= $this->Form->end() ?>
</div>
