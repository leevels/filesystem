<?php

declare(strict_types=1);

/*
 * This file is part of the ************************ package.
 * _____________                           _______________
 *  ______/     \__  _____  ____  ______  / /_  _________
 *   ____/ __   / / / / _ \/ __`\/ / __ \/ __ \/ __ \___
 *    __/ / /  / /_/ /  __/ /  \  / /_/ / / / / /_/ /__
 *      \_\ \_/\____/\___/_/   / / .___/_/ /_/ .___/
 *         \_\                /_/_/         /_/
 *
 * The PHP Framework For Code Poem As Free As Wind. <Query Yet Simple>
 * (c) 2010-2020 http://queryphp.com All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Leevel\Filesystem\Provider;

use Leevel\Di\IContainer;
use Leevel\Di\Provider;
use Leevel\Filesystem\Filesystem;
use Leevel\Filesystem\IFilesystem;
use Leevel\Filesystem\Manager;

/**
 * filesystem 服务提供者.
 */
class Register extends Provider
{
    /**
     * 注册服务.
     */
    public function register(): void
    {
        $this->filesystems();
        $this->filesystem();
    }

    /**
     * 可用服务提供者.
     */
    public static function providers(): array
    {
        return [
            'filesystems' => Manager::class,
            'filesystem'  => [IFilesystem::class, Filesystem::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function isDeferred(): bool
    {
        return true;
    }

    /**
     * 注册 filesystems 服务.
     */
    protected function filesystems(): void
    {
        $this->container
            ->singleton(
                'filesystems',
                fn (IContainer $container): Manager => new Manager($container),
            );
    }

    /**
     * 注册 filesystem 服务.
     */
    protected function filesystem(): void
    {
        $this->container
            ->singleton(
                'filesystem',
                fn (IContainer $container): Filesystem => $container['filesystems']->connect(),
            );
    }
}
