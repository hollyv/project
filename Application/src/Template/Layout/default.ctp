<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Helpdesk Portal';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="top">  
        <div id="user">
            <ul id="adminMenu">
                <li>
                    
                    <a href="/tickets/"><font color= 'white'>Hi,
                    <?= $loguser = $this->request->session()->read('Auth.User.firstname'); ?></a>
                </li>
                <li>
                    <a href="/tickets/pages/help"><font color= 'white'>Help</a>
                </li>
                <li>
                    <a href="/tickets/users/logout"><font color= 'white'>Sign Out</a>
                </li>
               
            </ul>
    </div>
    </div>
    <nav class="top-bar expanded" data-topbar role="navigation">
       
       <div id='headerlogo'>
         <?php echo $this->Html->image('Logo.png', array('alt' => 'Numatic Logo', 'border' => '0', 'data-src' => 'holder.js/100%x100', 'draggable' => 'false', 'style' => 'margin-left: 20px;')); ?>
        </div>
        <section class="top-bar-section">

            <div id='newticket'>
               <a href="/tickets/tickets/add"><font color= 'white'>+ New Ticket</a> 
            </div>

        </section>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
</body>
</html>