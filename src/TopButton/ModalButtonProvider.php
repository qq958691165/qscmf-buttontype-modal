<?php
namespace Qs\TopButton;

use Qs\TopButton\Modal\Modal;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;

class ModalButtonProvider implements Provider
{

    public function register()
    {
        RegisterContainer::registerListTopButton('modal', Modal::class);
    }

}