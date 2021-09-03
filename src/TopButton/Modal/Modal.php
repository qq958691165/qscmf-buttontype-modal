<?php

namespace Qs\TopButton\Modal;

use Qs\ModalButton\ModalButtonBuilder;

class Modal extends \Qscmf\Builder\ButtonType\ButtonType
{
    public function build(array &$option)
    {
        $my_attribute['type'] = 'modal';
        $my_attribute['title'] = '模态框';
        $my_attribute['class'] = 'btn btn-primary';
        $my_attribute['data-toggle'] = "modal";

        $builder = $option['options'] instanceof ModalButtonBuilder ?
            $option['options'] :$this->defaultModalBuilder();

        $gid = $builder->getGid();
        $my_attribute['data-target']="#".$gid.'QsButtonModal';

        if ($option['attribute'] && is_array($option['attribute'])) {
            $option['attribute'] = array_merge($my_attribute, $option['attribute']);
        }

        $option['attribute']['id'] = $gid;

        return (string)$builder;
    }

    protected function defaultModalBuilder(){
        $builder = new ModalButtonBuilder();
        $builder->setTitle('defaultTopModal');

        return $builder;
    }

}