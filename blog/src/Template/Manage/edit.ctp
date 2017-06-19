<?php
/**
  * @var \App\View\AppView $this
  */
?>
    <?= $this->Form->create($article,['type' => 'file']) ?>
    <fieldset>
        <?php

            echo $this->Form->control('title');
            echo $this->Form->control('body');
            echo $this->Form->create('Pictuer_data', array('enctype' => 'multipart/form-da'));
            echo $this->Form->control('pictuer_id', ['type' => 'file', 'label' => 'pictuer']);
        ?>

    </fieldset>

    <?= $this->Form->button(__('Submit'),['class' => 'manage_button']) ?>
    <?php $url = $this->Url->build(['action' => 'index']) ?>
    <?= $this->Form->button(__('Cancel'),['class' => 'manage_button', 'type' => 'button', 'onclick' => "location.href='$url'"]) ?>
    <?= $this->Form->end() ?>
    <?php
        if ($id !== null) {
            echo $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id], [
                    'confirm' => __('Are you sure you want to delete this article ? # id:{0}', $article->id),
                    'class' => 'manage_button_delete',
                ]
            );
        }
    ?>

</div>
