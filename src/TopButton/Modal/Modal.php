<?php

namespace Qs\TopButton\Modal;

use AntdAdmin\Component\Table\ActionType\BaseAction;
use AntdAdmin\Component\Table\ActionType\Button;
use Qs\ModalButton\ModalButtonBuilder;
use Qscmf\Builder\Antd\BuilderAdapter\ListAdapter\IAntdTableButton;
use Qscmf\Builder\ListBuilder;

class Modal extends \Qscmf\Builder\ButtonType\ButtonType implements IAntdTableButton
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

    public function tableButtonAntdRender($options, $listBuilder): BaseAction|array
    {
        $button = new Button($options['attribute']['title']);
        if ($options['options'] instanceof ModalButtonBuilder) {
            $modal = $options['options']->getAntdModal();

            $button->modal($modal);
        } else {
            E('模态框配置错误');
        }

        return $button;
    }
}