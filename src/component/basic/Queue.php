<?php

namespace Eadmin\component\basic;

use Eadmin\component\Component;
use think\facade\Db;

/**
 * 队列执行进度通知
 * @method $this queueId($value)
 */
class Queue extends Component
{
    protected $name = 'EadminQueue';
    public function __construct($content)
    {
        parent::__construct();
        $this->content($content);
    }
    /**
     * 执行队列
     * @param string $title 标题
     * @param string $job 任务
     * @param array $data 数据
     * @return $this
     */
    public function exec($title, $job, array $data=[]){
        $id = sysqueue($title,$job,$data);
        $this->queueId($id);
        $this->attr('title',$title);
        return $this;
    }
    public static function create($content)
    {
        return new self($content);
    }
}
