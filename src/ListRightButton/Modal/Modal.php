<?php

namespace Qs\ListRightButton\Modal;

use AntdAdmin\Component\Table\ColumnType\ActionType\BaseAction;
use AntdAdmin\Component\Table\ColumnType\ActionType\Link;
use Qs\ModalButton\ModalButtonBuilder;
use Qscmf\Builder\ListRightButton\ListRightButton;
use Quansitech\BuilderAdapterForAntdAdmin\BuilderAdapter\ListAdapter\IAntdTableRightBtn;

class Modal extends ListRightButton implements IAntdTableRightBtn
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

        $my_attribute['data-target']="#".$builder->getModalDom();

        if ($option['attribute'] && is_array($option['attribute'])) {
            $option['attribute'] = $listBuilder->mergeAttr($my_attribute, $option['attribute']);
        }

        $option['attribute']['id'] = $gid;

        \Bootstrap\RegisterContainer::registerBodyHtml((string)$builder);
        return '';
    }

    protected function defaultModalBuilder(){
        $builder = new ModalButtonBuilder();
        $builder->setTitle('defaultModal');

        return $builder;
    }

    public function tableRightBtnAntdRender($options, $listBuilder): BaseAction
    {
        $link = new Link($options['attribute']['title']);
        if (is_string($options['options'])) {
            $link->modalByField($options['options']);
        } elseif ($options['options'] instanceof ModalButtonBuilder) {
            $link->modal($options['options']->getAntdModal());
        } else {
            E('模态框配置错误');
        }

        return $link;
    }
}