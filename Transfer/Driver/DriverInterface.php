<?php
/**
 *
 * @author
 * @copyright Copyright (c) Beijing Jinritemai Technology Co.,Ltd.
 */

namespace Yafrk\Transfer\Driver;


interface DriverInterface
{
    /**
     *
     * @param string $module
     * @return void
     */
    public function setModule($module);

    /**
     *
     * @param string $controller
     * @return void
     */
    public function setController($controller);

    /**
     *
     * @param string $action
     * @return void
     */
    public function setAction($action);

    /**
     *
     * @param string $params
     * @return void
     */
    public function setParams($params);

    /**
     * @param string $app
     * @return void
     */
    public function setApp($app);
}