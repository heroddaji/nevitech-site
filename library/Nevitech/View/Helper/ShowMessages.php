<?php

class Nevitech_View_Helper_ShowMessages extends Zend_View_Helper_Abstract
 {
    public function showMessages()
    {
        $flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
        $messages = $flashMessenger->getMessages();

        if (count($messages)) {
            ?>
                <div class="container_12">
                    <ul id="messages" class="grid_12">
                        <?php foreach ($messages as $message) : ?>
                            <li><?php echo $message; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php
        }
    }
 }