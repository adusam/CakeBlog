<?php
/**
  * @var \App\View\AppView $this
  */
?>
    <?= $this->Form->create($article,['class' => 'manage_edit large-10', 'type' => 'file']) ?>
    <fieldset>
        <?php

            echo $this->Form->control('title' , ['label' => 'タイトル']);
            echo $this->Form->control('body' , ['label' => '内容']);
            echo $this->Form->create('picture_data', array('enctype' => 'multipart/form-da'));
            echo $this->Form->control('picture_id', ['type' => 'file', 'label' => '']);
            if (isset($article->picture['data'])) {
                echo $this->Html->image("/webroot/uploads/pictures/".$article->picture['data']);
            }

        ?>


    </fieldset>
    <?php
        if (is_null($article->title)) {
            echo $this->Form->button(__('投稿'),[
                'class' => 'manage_button',
                'onclick' => 'javascript:disableBtn(this);submit(this);'
            ]);
        }
        else {
            echo $this->Form->button(__('保存'),[
                'class' => 'manage_button',
                'onclick' => 'javascript:disableBtn(this);submit(this);'
            ]);
        }
    ?>
    <?php $url = $this->Url->build(['action' => 'index']) ?>
    <?= $this->Form->button(__('キャンセル'),['class' => 'manage_button', 'type' => 'button', 'onclick' => "location.href='$url';"]) ?>
    <?= $this->Form->end() ?>
    <?php
        if ($id !== null) {
            echo $this->Form->postLink(
                __('削除'),
                ['action' => 'delete', $article->id], [
                    'confirm' => __('ID:{0} の記事を削除してもよろしいですか？' , $article->id),
                    'class' => 'manage_button_delete',
                ]
            );
        }
    ?>

</div>
<script type="text/javascript">
    function disableBtn(btn) {
        btn.disabled = true;
    }
</script>
