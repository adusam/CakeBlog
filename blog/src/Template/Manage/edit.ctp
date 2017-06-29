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
            echo $this->Form->control('picture_id', ['type' => 'file', 'label' => '※JPG形式の画像のみアップロードできます。']);
            if (isset($article->picture['data'])){
                echo $this->Html->image("/webroot/uploads/pictures/".$article->picture['data'], ['id' => 'edit_img']);
                echo $this->Form->button(__('画像を削除'), ['type' => 'button', 'id' => 'img_delete_btn', 'onclick' => 'disableImage();']);
            }
        ?>
    </fieldset>
    <?php
        if (is_null($article->title)) {
            $submitStr = "投稿";
        }
        else {
            $submitStr = "保存";
        }
    ?>
    <?= $this->Form->button(__($submitStr),[
        'class' => 'manage_button',
        'onclick' => 'javascript:disableBtn(this);submit(this);'
    ]); ?>
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

    function disableImage() {
        document.getElementById('picture-id').setAttribute('disabled', true);
        document.getElementById('edit_img').setAttribute('style', 'display:none');
        document.getElementById('img_delete_btn').setAttribute('style', 'display:none');
    }
</script>
