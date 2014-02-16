<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/15/14
 * Time: 8:47 PM
 */

namespace Yjv\ValidatorConstraintGroup;


interface GroupFactoryInterface
{
    /**
     * @param string $name
     * @param array $options
     * @return GroupLoaderInterface
     *
     * @throws GroupCreationFailedException
     */
    public function createGroup($name, array $options = array());

    /**
     * @param GroupLoaderInterface $loader
     * @return self
     */
    public function addLoader(GroupLoaderInterface $loader);
} 