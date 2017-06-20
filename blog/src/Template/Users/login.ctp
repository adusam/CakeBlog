<!-- File: src/Template/Users/login.ctp -->

<div class="users login form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset class="large-5 medium-8">
        <legend><?= __('ユーザーネームとパスワードを入力してください。') ?></legend>
        <?= $this->Form->control('username' , ['label' => 'ユーザーネーム']) ?>
        <?= $this->Form->control('password' , ['label' => 'パスワード']) ?>
        <?= $this->Form->button(__('ログイン'), ['class' => 'login_button']); ?>
    </fieldset>
<?= $this->Form->end() ?>
</div>
