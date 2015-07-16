<?php
/**
 *
 * @author
 * @copyright Copyright (c) Beijing Jinritemai Technology Co.,Ltd.
 */

namespace Yafrk\Util\Output;

use Yafrk\Util\Sender\SenderInterface;

interface OutputInterface
{
    /**
     * Output the content
     */
    public function __invoke(SenderInterface $sender);

}