<!-- File: src/Template/Users/login.ctp -->

<div class="users login form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset class="large-5 medium-8">
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->button(__('Login'), ['class' => 'login_button']); ?>
    </fieldset>
<?= $this->Form->end() ?>
</div>
