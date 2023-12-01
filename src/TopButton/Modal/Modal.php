<?php

namespace Qs\TopButton\Modal;

use Qs\ModalButton\ModalButtonBuilder;
use Qscmf\Builder\ListBuilder;

class Modal extends \Qscmf\Builder\ButtonType\ButtonType
{
    public function build(array &$option, ?ListBuilder $listBuilder)
    {
        $my_attribute['type'] = 'modal';
        $my_attribute['title'] = '模态框';
        $my_attribute['class'] = 'btn btn-primary';
        $my_attribute['data-toggle'] = "modal";

        $builder = $option['options'] instanceof ModalButtonBuilder ?
            $option['options'] :$this->defaultModalBuilder();

        $gid = $builder->getGid();
        $my_attribute['data-target']="#".$builder->getModalDom();

        if ($option['attribute'] && is_array($option['attribute'])) {
            $option['attribute'] = array_merge($my_attribute, $option['attribute']);
        }

        $option['attribute']['id'] = $gid;

        \Bootstrap\RegisterContainer::registerBodyHtml((string)$builder);

        return '';
    }

    protected function defaultModalBuilder(){
        $builder = new ModalButtonBuilder();
        $builder->setTitle('defaultTopModal');

        return $builder;
    }

}