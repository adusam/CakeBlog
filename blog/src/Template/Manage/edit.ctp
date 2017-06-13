<?php
/**
  * @var \App\View\AppView $this
  */
?>

    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Edit Article') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('body');
            echo $this->Form->control('picture_id');
        ?>
    </fieldset>

    <?= $this->Form->button(__('Submit')) ?>



    <?= $this->Form->button(__('Cansel'),['type' => 'button', 'onclick' => "location.href='./index'"]) ?>
    <?= $this->Form->end() ?>










    <!-- <span class="heading"><?= __('Actions') ?></span> -->
    <span><?= $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $article->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]
        )
        ?></span>
        <span><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?></span>


</div>
