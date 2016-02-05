<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;



$description = 'Helpdesk Portal';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
   
    <title>
        <?= $description ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Flash->render() ?>
</head>
<body class="home">

    <header>
        <div class="header-image">
            <?= $this->Html->image('numtext.png', array('alt' => 'Numatic International text', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false')) ?>
    
            <h1>Helpdesk Portal</h1>
        <?= $this->Html->image('homecare_group.png', array('alt' => 'Numatic International text', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false')) ?>
        </div>
    </header>
        <div id="login">
            <fieldset>     	
				<h1> Log In </h1>
				<?= $this->Form->create() ?>
				<?= $this->Form->input('username') ?>
				<?= $this->Form->input('password') ?>
				<?= $this->Form->button('Login') ?>
				<?= $this->Form->end() ?>
 			</fieldset>
 		</div>
  	
</body>
</html>



