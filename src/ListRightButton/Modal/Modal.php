<?php

namespace Qs\ListRightButton\Modal;

use Qs\ModalButton\ModalButtonBuilder;
use Qscmf\Builder\ListRightButton\ListRightButton;

class Modal extends ListRightButton
{

    public function build(array &$option, array $data, $listBuilder)
    {
        $my_attribute['type'] = 'modal';
        $my_attribute['title'] = '模态框';
        $my_attribute['class'] = 'primary';
        $my_attribute['data-toggle'] = "modal";

        $builder = $data[$option['options']] instanceof ModalButtonBuilder ?
            $data[$option['options']] : $this->defaultModalBuilder();

        $gid = $builder->getGid();

        $my_attribute['data-target']="#".$gid.'QsButtonModal';

        if ($option['attribute'] && is_array($option['attribute'])) {
            $option['attribute'] = $listBuilder->mergeAttr($my_attribute, $option['attribute']);
        }

        $option['attribute']['id'] = $gid;

        $listBuilder->addContentBottom((string)$builder);
        return '';
    }

    protected function defaultModalBuilder(){
        $builder = new ModalButtonBuilder();
        $builder->setTitle('defaultModal');

        return $builder;
    }

}