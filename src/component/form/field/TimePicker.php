<?php


namespace Eadmin\component\form\field;


use Eadmin\component\form\Field;

/**
 * 时间选择器
 * Class TimePicker
 * @link https://element-plus.gitee.io/#/zh-CN/component/time-picker
 * @method $this readonly(bool $bool) 完全只读
 * @method $this editable(bool $bool) 文本框可输入
 * @method $this clearable(bool $bool) 是否显示清除按钮
 * @method $this size(string $size) 输入框尺寸    medium / small / mini
 * @method $this placeholder(string $text) 非范围选择时的占位内容
 * @method $this startPlaceholder(string $text) 范围选择时开始日期的占位内容
 * @method $this endPlaceholder(string $text) 范围选择时开始日期的占位内容
 * @method $this isRange(bool $bool) 是否为时间范围选择
 * @method $this arrowControl(bool $bool) 是否使用箭头进行时间选择
 * @method $this align(string $align) 对齐方式    left / center / right
 * @method $this popperClass(string $class) TimePicker 下拉框的类名
 * @method $this rangeSeparator(string $class) 选择范围时的分隔符
 * @method $this string(string $string) 参考日期格式：https://element-plus.gitee.io/#/zh-CN/component/date-picker#ri-qi-ge-shi
 * @method $this defaultValue($value) 可选，选择器打开时默认显示的时间 Date(TimePicker) / string(TimeSelect) 可被new Date()解析(TimePicker) / 可选值(TimeSelect)
 * @method $this prefixIcon(string $icon) 自定义头部图标的类名
 * @method $this clearIcon(string $icon) 自定义清空图标的类名
 * @package Eadmin\component\form\field
 */
class TimePicker extends Field
{
    protected $name = 'ElTimePicker';

    public function type($type)
    {
        $type = strtolower($type);
        switch ($type) {
            case 'time':
                $this->valueFormat('YYYY-MM-DD HH:mm:ss');
                break;
            case 'timerange':
                $this->isRange();
                $this->valueFormat('YYYY-MM-DD HH:mm:ss');
                break;
        }
        return $this;
    }
}
