<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/15/14
 * Time: 9:06 PM
 */

namespace Yjv\ValidatorConstraintGroup;

use Symfony\Component\Config\FileLocatorInterface;

class YamlGroupLoader implements GroupLoaderInterface
{
    /**
     * @var $loader FileLocatorInterface
     */
    protected $locator;

    function __construct(FileLocatorInterface $locator)
    {
        $this->locator = $locator;
    }

    public function canLoad($name, array $options = array())
    {
        $this->locator->locate();
    }

    public function load($name, array $options = array())
    {
    }
}