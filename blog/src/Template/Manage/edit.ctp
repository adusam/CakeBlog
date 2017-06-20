<?php
/**
  * @var \App\View\AppView $this
  */
?>
    <?= $this->Form->create($article,['class' => 'manage_edit large-10', 'type' => 'file']) ?>
    <fieldset>
        <?php

            if (isset($article->picture['data'])) {
                echo $this->Html->image("/webroot/uploads/pictures/".$article->picture['data']);
            }
            echo $this->Form->control('title' , ['label' => 'タイトル']);
            echo $this->Form->control('body' , ['label' => '内容']);
            echo $this->Form->create('Pictuer_data', array('enctype' => 'multipart/form-da'));
            echo $this->Form->control('pictuer_id', ['type' => 'file', 'label' => '']);

        ?>


    </fieldset>

    <?= $this->Form->button(__('記事投稿'),['class' => 'manage_button']) ?>
    <?php $url = $this->Url->build(['action' => 'index']) ?>
    <?= $this->Form->button(__('キャンセル'),['class' => 'manage_button', 'type' => 'button', 'onclick' => "location.href='$url'"]) ?>
    <?= $this->Form->end() ?>
    <?php
        if ($id !== null) {
            echo $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id], [
                    'confirm' => __('管理番号:{0} の記事を削除してもよろしいですか？' , $article->id),
                    'class' => 'manage_button_delete',
                ]
            );
        }
    ?>

</div>
