<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateSystemAuth extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('system_auth',['engine'=>'InnoDB','collation'=>'utf8mb4_unicode_ci'])->setComment('系统-权限');
        $table->addColumn(Column::string('name',20)->setComment('权限名称'));
        $table->addColumn(Column::tinyInteger('status')->setDefault(1)->setComment('权限状态'));
        $table->addColumn(Column::bigInteger('sort')->setDefault(0)->setComment('排序权重'));
        $table->addColumn(Column::string('desc')->setDefault('')->setComment('备注说明'));
        $table->addTimestamps('create_at');
        $table->create();
    }
}
