<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="comments form large-9 medium-11 comment_edit">
    <?= $this->Form->create($comment, ['id' => 'edit_form']) ?>
    <fieldset class="comment_edit">
        <?php
        echo $this->Form->control('name' , ['label' => '名前']);
        echo $this->Form->control('body' , ['label' => '内容']);
        echo $this->Form->control('password' , ['label' => 'パスワード']);
        ?>
    </fieldset>
    <div class="comment_buttons">
        <?= $this->Form->button(__('投稿')) ?>
        <?php $url_cancel = $this->Url->build(['controller' => 'Articles', 'action' => 'view', $comment->article_id ]) ?>
        <?= $this->Form->button(__('キャンセル'), [
            'class' => 'button_cancel',
            'type' => 'button',
            'onclick' => "location.href='$url_cancel'"
            ]) ?>

            <?php $url_delete = $this->Url->build(['action' => 'delete', $comment->id]) ?>
            <?= $this->Form->button(__('削除'), [
                'class' => 'button_delete',
                'type' => 'submit',
                'onclick' => "form.action='$url_delete';return true"
                ]) ?>
    </div>

    <?= $this->Form->end() ?>

</div>
