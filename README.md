# qscmf-buttontype-modal
```text
qscmf 按钮类型组件--modal

可以向列表顶部、列表行、表单页添加此类型按钮
```

#### 安装

```php
composer require quansitech/qscmf-buttontype-modal
```

#### 构建模态框
[传送门](https://github.com/quansitech/qscmf-buttontype-modal/blob/master/ModalButtonBuilder.md)

#### 添加按钮
+ 向列表添加一个顶部按钮
  ```php
   ->addTopButton('modal', ['title' => '新增'],'','',$this->buildTopModal())
  ```
+ 向列表添加一个行按钮
  ```php
   ->addRightButton('modal',['title' => '编辑'], '', '', 'list_edit_form')
  ```
+ 向表单添加一个按钮
  ```php
   ->addButton('modal',['title' => '编辑'], '', '', 'form_edit_form')
  ```