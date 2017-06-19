<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="comments form large-9 medium-11 comment_edit">
    <?= $this->Form->create($comment, ['id' => 'edit_form']) ?>
    <fieldset class="comment_edit">
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('body');
        echo $this->Form->control('password');
        ?>
    </fieldset>
    <div class="comment_buttons">
        <?= $this->Form->button(__('SUBMIT')) ?>
        <?php $url_cancel = $this->Url->build(['controller' => 'Articles', 'action' => 'view', $comment->article_id ]) ?>
        <?= $this->Form->button(__('CANCEL'), [
            'class' => 'button_cancel',
            'type' => 'button',
            'onclick' => "location.href='$url_cancel'"
            ]) ?>

            <?php $url_delete = $this->Url->build(['action' => 'delete', $comment->id]) ?>
            <?= $this->Form->button(__('DELETE'), [
                'class' => 'button_delete',
                'type' => 'submit',
                'onclick' => "form.action='$url_delete';return true"
                ]) ?>
    </div>

    <?= $this->Form->end() ?>

</div>
