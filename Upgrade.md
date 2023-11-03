# 升级指南

##### 升级至v2.0.0版本

+ 修改模态框表单，需要使用 bindFormBuilder 方法显示绑定 FormBuilder 对象
  ```php
  // 旧版本写法
  protected function buildAddModal(){
        $modal = (new \Qs\ModalButton\ModalButtonBuilder());
        // 省略其他代码
        return $modal->setBody($this->add());
  }
  
  public function add(){
        $builder = new FormBuilder();
        // 省略其他代码              
        return $builder->build(true);
  }  
  ```
  ```php
  // v2版本
  protected function buildAddModal(){
        $modal = (new \Qs\ModalButton\ModalButtonBuilder());
        // 省略其他代码
        return $modal->bindFormBuilder($this->add());
  }
  
  public function add(){
        $builder = new FormBuilder();
        // 省略其他代码
        return $builder;        
  }
  ```
+ 废弃 setIsForward 方法提示，可用 setIsJump 方法替换
