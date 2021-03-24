<?php


namespace Eadmin\component\basic;

use Eadmin\component\Component;

/**
 * 下拉菜单
 * Class Dropdown
 * @package Eadmin\component\basic
 * @method $this type(string $value) 类型 primary / success / warning / danger / info / text 只在split-button为 true 的情况下有效
 * @method $this size(string $value) 尺寸 medium / small / mini
 * @method $this splitButton(bool $bool = true) 下拉触发元素呈现为按钮组
 * @method $this hideOnClick(bool $bool = true) 是否在点击菜单项后隐藏菜单
 * @method $this placement(string $value) top/top-start/top-end/bottom/bottom-start/bottom-end
 * @method $this trigger(string $value) 触发下拉的行为 hover, click, contextmenu
 */
class Dropdown extends Component
{
    protected $name = 'EadminDropdown';
    protected $menu;
    protected $prependArr = [];
    protected $appendArr = [];

    public function __construct($content)
    {
        $this->menu = new DropdownMenu();

        $this->content(Html::create($content));
    }

    /**
     * 创建一个拉菜单
     * @param mixed $content 触发内容
     * @return Button|mixed
     */
    public static function create($content)
    {
        return new self($content);
    }

    /**
     * 追加前面
     * @param mixed $content
     * @param string $icon 图标
     * @return DropdownItem
     */
    public function prepend($content, $icon = '')
    {
        $item               = $this->itemContent($content, $icon);
        $this->prependArr[] = $item;
        return $item;
    }

    /**
     * 追加尾部
     * @param mixed $content
     * @param string $icon 图标
     * @return DropdownItem
     */
    public function append($content, $icon = '')
    {
        $item              = $this->itemContent($content, $icon);
        $this->appendArr[] = $item;
        return $item;
    }

    /**
     * @param mixed $content 内容
     * @param string $icon 图标
     * @return DropdownItem
     */
    protected function itemContent($content, $icon = '')
    {
        if (!empty($icon) && is_string($content)) {
            $content = '<i class="' . $icon . '" /> ' . $content;
        }
        $item = new DropdownItem('');
        $item->dropdown($this);
        $item->content($content);
        return $item;
    }

    /**
     * 下拉菜单选项
     * @param mixed $content
     * @param string $icon 图标
     * @return DropdownItem
     */
    public function item($content, $icon = '')
    {
        $item = $this->itemContent($content, $icon);
        $this->menu->content($item);
        return $item;
    }

    public function jsonSerialize()
    {
        foreach ($this->prependArr as $prepend) {
            if(isset($this->menu->content['default'])){
                array_unshift($this->menu->content['default'], $prepend);
            }else{
                $this->menu->content($prepend);
            }
        }
        foreach ($this->appendArr as $append) {
            $this->menu->content($append);
        }
        $this->content($this->menu, 'dropdown');
        return parent::jsonSerialize(); // TODO: Change the autogenerated stub
    }
}
