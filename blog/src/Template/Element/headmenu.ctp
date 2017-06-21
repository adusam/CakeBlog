
<!-- header menu -->
<nav class="top-bar expanded" data-topbar role="navigation">
    <ul class="title-area large-3 medium-3 columns">
        <li class="name">
            <h1><?= $this->Html->Link(__("TOP"), ['controller' => 'Articles' ,'action' => 'index']) ?></h1>
        </li>
    </ul>
    <div class="top-bar-section">
        <h1 class="left"><?= $pagename ?></h1>
        <ul class="right">
        <?php if( is_null($auth) ): ?>
            <li><?= $this->Html->Link(
                __('Login'),
                ['controller' => 'Users' ,'action' => 'login'],
                ['class' => 'header_link']
                ) ?></li>
        <?php else: ?>
            <li><?= $this->Html->Link(
                __("管理"),
                ['controller' => 'Manage', 'action' => 'index'],
                ['class' => 'header_link']
                ) ?></li>
            <li><?= $this->Html->Link(
                __('Logout'),
                ['controller' => 'Users' ,'action' => 'logout'],
                ['class' => 'header_link']
                ) ?></li>
        <?php endif; ?>
        </ul>
    </div>
</nav>
