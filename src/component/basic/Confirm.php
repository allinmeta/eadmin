<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2021-01-10
 * Time: 10:58
 */

namespace Eadmin\component\basic;


use Eadmin\component\Component;

/**
 * Class Confirm
 * @package Eadmin\component\basic
 * @method $this title(string $value) 标题
 * @method $this message(string $value) 消息正文内容
 * @method $this type(string $value) 消息类型，用于显示图标 success / info / warning / error
 * @method $this dangerouslyUseHTMLString(bool $value) 是否将 message 属性作为 HTML 片段处理
 * @method $this showClose(bool $value) MessageBox 是否显示右上角关闭按钮
 * @method $this showCancelButton(bool $value)  是否显示取消按钮
 * @method $this showConfirmButton(bool $value)  是否显示确定按钮
 * @method $this cancelButtonText(string $value) 取消按钮的文本内容
 * @method $this confirmButtonText(string $value) 确定按钮的文本内容
 * @method $this closeOnPressEscape(bool $value) 是否可通过按下 ESC 键关闭 MessageBox
 * @method $this closeOnClickModal(bool $value) 是否可通过点击遮罩关闭 MessageBox
 * @method $this showInput(bool $value) 是否显示输入框
 * @method $this inputType(string $value) 输入框的类型 text
 * @method $this inputValue(string $value) 输入框的初始文本
 * @method $this url(string $value) ajax请求url
 * @method $this method(string $value) ajax请求method get / post /put / delete
 * @method $this params(array $value) 提交ajax参数
 * @method $this center(bool $value) 是否居中布局
 * @method $this roundButton(bool $value) 是否使用圆角按钮
 */
class Confirm extends Component
{
    protected $name = 'EadminConfirm';
    public static function create($content){
        $self = new self();
        $self->title('提示')
            ->closeOnClickModal(false)
            ->confirmButtonText('确定')
            ->cancelButtonText('取消')
            ->content($content);
        $self->event('gridRefresh',[]);
        return $self;
    }

    /**
     * 确认事件
     * @param array $value  ['a'=>true]
     * @return $this
     */
    public function eventConfirm(array $value){
        $this->event('confirm',$value);
        return $this;
    }
    /**
     * 取消事件
     * @param array $value  ['a'=>true]
     * @return $this
     */
    public function eventCancel($field,$value){
        $this->event('cancel',$value);
        return $this;
    }
    /**
     * 输入框
     * @param string $inputValue 初始值
     * @return $this
     */
    public function input($inputValue=''){
        $this->showInput()
            ->inputValue($inputValue);
        return $this;
    }
}