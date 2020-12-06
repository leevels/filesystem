<?php

declare(strict_types=1);

namespace Leevel\Filesystem;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Sftp\SftpAdapter;

/**
 * Filesystem sftp.
 *
 * @see https://flysystem.thephpleague.com/adapter/sftp/
 */
class Sftp extends Filesystem implements IFilesystem
{
    /**
     * 配置.
     */
    protected array $option = [
        // 主机
        'host' => 'sftp.example.com',

        // 端口
        'port' => 22,

        // 用户名
        'username' => 'your-username',

        // 密码
        'password' => 'your-password',

        // 根目录
        'root' => '',

        // 私钥路径
        'privateKey' => '',

        // 超时设置
        'timeout' => 20,
    ];

    /**
     * {@inheritDoc}
     *
     * - 请执行 `composer require league/flysystem-sftp`.
     *
     * @throws \InvalidArgumentException
     */
    protected function makeAdapter(): AdapterInterface
    {
        return new SftpAdapter($this->option);
    }
}
