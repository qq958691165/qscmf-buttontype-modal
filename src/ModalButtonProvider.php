<?php

namespace Qs\ModalButton;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;

class ModalButtonProvider implements Provider {

    public function register(){
        RegisterContainer::registerSymLink(WWW_DIR . '/Public/button-type-modal', __DIR__ . '/../asset');
    }
}