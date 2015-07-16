<?php
/**
 * xml
 *
 * @author: xudianyang
 * @version: Xml.php v-1.0.0, 2015-07-09 23:05 Created
 * @copyright Copyright (c) 2015 (http://www.yafrk.com)
 */
namespace Yafrk\Util;

final class XmlArray
{
    /**
     * 将格式良好的XML字符串转换为标准的php数组
     *
     * @param string $xmlStr
     * @return array
     */
    static public function LoadString($xmlStr)
    {
        $node = new \SimpleXMLElement($xmlStr);
        $name = $node->getName();
        return array($name => self::simpleXMLRecursionToArray($node));
    }

    /**
     * 将格式良好的XML文件内容转换为标准的php数组
     *
     * @param $file
     * @return array
     */
    static public function LoadFile($file)
    {
        $node = new \SimpleXMLElement($file);
        $name = $node->getName();
        return array($name => self::simpleXMLRecursionToArray($node));
    }

    /**
     * 将SimpleXMLElement对象转换为标准的php数组
     *
     * @param $node
     * @return array|string
     */
    static public function simpleXMLRecursionToArray($node)
    {
        $return = array();
        $root = array();
        $k = 0;

        foreach ($node as $name => $child) {
            if ($child->count()) {
                $root[$name] = self::SimpleXMLRecursionToArray($child);
            } else {
                $root[$k][$name] = (string)$child;
                foreach ($child->attributes() as $key => $value) {
                    $root[$k]['@attributes'][$key] = (string)$value;
                }
            }

            $k++;
        }

        foreach ($root as $k => $v) {
            if (count($v) == 1 && is_numeric($k)) {
                $return[array_keys($v)[0]] = array_values($v)[0];
            } else {
                $return[$k] = $v;
            }
        }

        return $return;
    }
}