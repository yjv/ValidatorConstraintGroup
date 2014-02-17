<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/15/14
 * Time: 8:50 PM
 */

namespace Yjv\ValidatorConstraintGroup;


class GroupFactory implements GroupFactoryInterface
{
    protected $loaders = array();

    /**
     * @param string $name
     * @param array $options
     * @return GroupLoaderInterface
     * @throws GroupCreationFailedException
     */
    public function createGroup($name, array $options = array())
    {
        foreach ($this->loaders as $loader) {

            /**
             * @var $loader GroupLoaderInterface
             */
            if ($loader->canLoad($name, $options)) {

                return $loader->load($name, $options);
            }
        }

        throw new GroupCreationFailedException($name);
    }

    /**
     * @param GroupLoaderInterface $loader
     * @return $this|GroupFactoryInterface
     */
    public function addLoader(GroupLoaderInterface $loader)
    {
        $this->loaders[] = $loader;
        return $this;
    }

    /**
     * @return array
     */
    public function getLoaders()
    {
        return $this->loaders;
    }
}