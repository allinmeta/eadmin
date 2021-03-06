<?php

namespace Eadmin\command;


use app\common\tools\Str;
use think\console\Command;
use think\console\Input;

use think\console\input\Option;
use think\console\Output;
use think\facade\Db;
use think\facade\Env;

/**
 * 生成数据库表填充文件
 * Class Iseed
 * @package app\common\command
 */
class Iseed extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('iseed')->setDescription('Generate Data seed');
        // 设置参数
        $this->addOption('table', 't', Option::VALUE_OPTIONAL, "database table name");
        $this->addOption('force', 'f', Option::VALUE_NONE, 'Force overwrite file');

    }

    protected function getPath()
    {
        return Env::get('root_path') . 'database' . DIRECTORY_SEPARATOR . 'seeds';
    }

    protected function execute(Input $input, Output $output)
    {
        $table = $input->getOption('table');
        $force = $input->getOption('force');
        $path = $this->getPath();
        if (!file_exists($path)) {
            if ($this->output->confirm($this->input, 'Create seeds directory? [y]/n')) {
                mkdir($path, 0755, true);
            }
        }
        if (is_null($table)) {
            //获取数据库所有表
            $tables = Db::query('show tables');
            $database = Db::getConfig('database');
            $mark = 'Tables_in_' . $database;
            foreach ($tables as $table) {
                $tableName = $table[$mark];
                $res = $this->generateSeedFile($tableName, $path, $force);
                if ($res === false) {
                    $output->writeln("<error>File write failed</error>");
                    break;
                }
            }
            $output->writeln("<info>Create Seed Success</info>");
        } else {
            $res = $this->generateSeedFile($table, $path, $force);
            if ($res === false) {
                $output->writeln("<error>File write failed</error>");
            } else {
                $output->writeln("<info>Create Seed Success</info>");
            }
        }
    }

    protected function getStubs($name)
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . $name . '.stub';
    }

    private function generateSeedFile($table, $path, $force)
    {
        $data = Db::table($table)->select()->toArray();
        $stub = file_get_contents($this->getStubs('iseed'));
        $fileName = ucfirst(Str::camelize($table)) . 'Seeder';
        $content = strtr($stub, [
            '$className' => $fileName,
            '$dataArr' => var_export($data, true),
            '$table' => Str::uncamelize($table),
        ]);
        $filePath = $path . DIRECTORY_SEPARATOR . $fileName . '.php';
        $write = true;
        $res = true;
        if (file_exists($filePath)) {
            if (!$force) {
                if(!$this->output->confirm($this->input, "Force overwrite file {$filePath}? [y]/n")){
                    $write = false;
                }
            }
        }
        if($write){
            $res = file_put_contents($filePath, $content);
        }
        return $res;
    }
}
