<?php
namespace Qs\ListRightButton;

use Qs\ListRightButton\Modal\Modal;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;

class ModalButtonProvider implements Provider
{

    public function register()
    {
        RegisterContainer::registerListRightButtonType('modal', Modal::class );
    }

}