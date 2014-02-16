<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/15/14
 * Time: 8:48 PM
 */

namespace Yjv\ValidatorConstraintGroup;


interface GroupLoaderInterface
{
    public function canLoad($name, array $options = array());
    public function load($name, array $options = array());
} 