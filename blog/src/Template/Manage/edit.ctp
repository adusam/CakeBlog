<?php
/**
  * @var \App\View\AppView $this
  */
?>
    <?= $this->Form->create($article,['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit Article') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('body');
            echo $this->Form->create('Pictuer_data', array('enctype' => 'multipart/form-da'));
            echo $this->Form->input('pictuer_id', ['type' => 'file', 'label' => 'pictuer']);
        ?>

    </fieldset>

    <?= $this->Form->button(__('Submit')) ?>
    <?php $url = $this->Url->build(['action' => 'index']) ?>
    <?= $this->Form->button(__('Cansel'),['type' => 'button', 'onclick' => "location.href='$url'"]) ?>
    <?= $this->Form->end() ?>
</div>
