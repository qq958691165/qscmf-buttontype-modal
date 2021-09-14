<?php

namespace Qs\ModalButton;

use Illuminate\Support\Str;

class ModalButtonBuilder
{
    protected $gid;
    protected $header_title;
    protected $show_header = true;
    protected $body_html;
    protected $show_footer = true;
    protected $footer_button = [];
    protected $modal_html = '';
    protected $dialog_width = null;
    protected $dialog_height = null;
    protected $body_height = null;
    protected $show_default_btn = true;
    protected $keyboard = true;
    protected $backdrop = true;
    protected $ajax_submit = true;
    protected $is_forward = true;
    protected $body_api_url = null;
    protected $modal_dom = "";

    public function __construct()
    {
        $this->setGid();
    }

    protected function addDefButton(){
        $this->addFooterButton('关闭', ['type' => 'button', 'class' => 'btn btn-secondary closeModal', 'data-dismiss' => 'modal']);
        $this->addDefSubmitButton();
    }

    protected function addDefSubmitButton(){
        $submit_cls = 'btn btn-primary submitModal';
        $this->ajax_submit && $submit_cls .=' ajax-post ';
        $this->is_forward && $submit_cls .= ' no-refresh no-forward ';

        $this->addFooterButton('确定', ['type' => 'submit', 'class' => $submit_cls,'target-form' => $this->getGid().'-builder-form']);
    }

    protected function setGid(){
        $this->gid = Str::uuid()->toString();
    }

    public function setIsForward($is_forward){
        $this->is_forward = $is_forward;
        return $this;
    }

    public function getGid(){
        return $this->gid;
    }

    public function setTitle($title){
        $this->header_title = $title;
        return $this;
    }

    public function setBody($html){
        $this->body_html = $html;
        return $this;
    }

    public function setIsShowFooter($is_show){
        $this->show_footer = $is_show === true;
        return $this;
    }

    public function addFooterButton($title, $attribute){
        $attribute['type'] = $attribute['type'] ?: 'button';
        $button = ['title' => $title, 'attribute' => $attribute];
        array_push($this->footer_button, $button);
        return $this;
    }

    protected function compileHtmlAttr($attr) {
        $result = array();
        foreach ($attr as $key => $value) {
            if(!empty($value) && !is_array($value)){
                $value = htmlspecialchars($value);
                $result[] = "$key=\"$value\"";
            }
        }
        $result = implode(' ', $result);
        return $result;
    }

    public function showDefBtn($is_show){
        $this->show_default_btn = $is_show;
        return $this;
    }

    public function setKeyboard($is_close){
        $this->keyboard = $is_close;
        return $this;
    }
    public function setBackdrop($is_close){
        $type = $is_close === false ? 'static' : true;
        $this->backdrop = $type;
        return $this;
    }

    public function setDialogWidth($width){
        $this->dialog_width = $width;
        return $this;
    }

    public function setDialogHeight($height){
        $this->dialog_height = $height;
        return $this;
    }

    public function setBodyHeight($height){
        $this->body_height = $height;
        return $this;
    }

    public function setAjaxSubmit($ajax_submit){
        $this->ajax_submit = $ajax_submit;
        return $this;
    }

    public function setBodyApiUrl($body_api_url){
        $this->body_api_url = $body_api_url;
        return $this;
    }

    protected function setModalDom(){
        $this->modal_dom = $this->getGid()."QsButtonModal";
        return $this;
    }

    public function getModalDom(){
        return $this->modal_dom;
    }

    public function __toString(){
        $this->show_footer && $this->show_default_btn && $this->addDefButton();

        if ($this->footer_button) {
            foreach ($this->footer_button as &$button) {
                $button['attribute'] = $this->compileHtmlAttr($button['attribute']);
            }
        }
        
        if (!$this->modal_html){
            $view = new \Think\View();
            $view->assign('gid', $this->gid);
            $view->assign('header_title', $this->header_title);
            $view->assign('body_html', $this->body_html);
            $view->assign('show_footer', $this->show_footer);
            $view->assign('show_header', $this->show_header);
            $view->assign('footer_button', $this->footer_button);
            $view->assign('keyboard', $this->keyboard);
            $view->assign('backdrop', $this->backdrop);
            $view->assign('dialog_width', $this->dialog_width);
            $view->assign('dialog_height', $this->dialog_height);
            $view->assign('body_height', $this->body_height);
            $view->assign('body_api_url', $this->body_api_url);
            $view->assign('modal_dom', $this->modal_dom);

            $this->modal_html = $view->fetch(__DIR__ . '/modal.html');
        }

        return $this->modal_html;
    }
}