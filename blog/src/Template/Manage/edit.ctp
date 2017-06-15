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
            echo $this->Form->file('pictuer_path');

        ?>
    </fieldset>

    <?= $this->Form->button(__('Submit')) ?>
    <?php $url = $this->Url->build(['action' => 'index']) ?>
    <?= $this->Form->button(__('Cansel'),['type' => 'button', 'onclick' => "location.href='$url'"]) ?>
    <?= $this->Form->end() ?>
</div>
