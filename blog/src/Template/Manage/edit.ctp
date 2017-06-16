<?php
/**
  * @var \App\View\AppView $this
  */
?>
    <?= $this->Form->create($article) ?>
    <fieldset>
        <?php
            echo $this->Form->control('title', ['label' => 'タイトル']);
            echo $this->Form->control('body', ['label' => '本文']);
            //echo $this->Form->control('picture_id');
            //echo $this->Form->file('pictuer_path', ['type' => 'file', 'label' => 'pictuer']);
            echo $this->Form->create('Pictuer', array('enctype' => 'multipart/form-data'));
            echo $this->Form->file('pictuer');

        ?>
    </fieldset>

    <?= $this->Form->button(__('Submit'),['class' => 'manage_button']) ?>
    <?php $url = $this->Url->build(['action' => 'index']) ?>
    <?= $this->Form->button(__('Cansel'),['class' => 'manage_button', 'type' => 'button', 'onclick' => "location.href='$url'"]) ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $article->id], [
                'confirm' => __('Are you sure you want to delete this article ? # id:{0}', $article->id),
                'class' => 'manage_button_delete',

            ]
        )
    ?>

</div>
