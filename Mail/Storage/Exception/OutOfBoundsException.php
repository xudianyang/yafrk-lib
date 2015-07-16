<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Yafrk\Mail\Storage\Exception;

use Yafrk\Mail\Exception;

/**
 * Exception for Zend_Mail component.
 */
class OutOfBoundsException extends Exception\OutOfBoundsException implements
    ExceptionInterface
{}