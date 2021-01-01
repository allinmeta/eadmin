<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2021-01-01
 * Time: 09:22
 */

namespace Eadmin\component\form\field;


use Eadmin\component\form\Field;

/**
 * 表单
 * Class Form
 * @link https://element-plus.gitee.io/#/zh-CN/component/form
 * @package Eadmin\component\form\field
 * @method $this rules(array $value) 表单验证规则
 * @method $this size(string $value) 尺寸 medium / small / mini
 * @method $this labelPosition(string $value) 表单域标签的宽度 right/left/top
 * @method $this labelSuffix(string $value) 表单域标签的后缀
 * @method $this labelWidth(string $value) 表单域标签的宽度，例如 '50px'
 * @method $this inline(bool $value) 行内表单模式
 * @method $this hideRequiredAsterisk(bool $value) 是否显示必填字段的标签旁边的红色星号
 * @method $this showMessage(bool $value) 是否显示校验错误信息
 * @method $this inlineMessage(bool $value) 是否以行内形式展示校验信息
 * @method $this statusIcon(bool $value) 是否在输入框中显示校验结果反馈图标
 * @method $this validateOnRuleChange(bool $value) 是否在 rules 属性改变后立即触发一次验证
 */
class Form extends Field
{
    protected $name = 'ElForm';
    public function __construct($field = null, $data = [])
    {
        empty($field) ? $field = Str::random(10, 3) : $field;
        $this->bind($field, $data);
        $this->bindAttr('model',$field);
    }
    /**
     * 创建
     * @param string $field 字段
     * @param array $data 值
     * @return static
     */
    public static function create($field = 'form',$data = [])
    {
        return new static($field, $data);
    }
    /**
     * 添加item
     * @param $prop 字段
     * @param $label 标签
     * @return FormItem 
     */
    public function item($prop='',$label=''){
        $item = FormItem::create($prop,$label,$this);
        $this->content($item);
        return $item;
    }
}