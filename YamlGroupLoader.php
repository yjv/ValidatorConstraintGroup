<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/15/14
 * Time: 9:06 PM
 */

namespace Yjv\ValidatorConstraintGroup;

use Symfony\Component\Yaml\Parser;

class YamlGroupLoader implements GroupLoaderInterface
{
    protected $file;

    /**
     * @var $parser Parser
     */
    protected $parser;
    protected $fileLoaded = false;
    protected $groups;

    function __construct($file)
    {
        $this->file = $file;
        $this->parser = new Parser();
    }

    public function canLoad($name, array $options = array())
    {
        $this->loadFile();
        return isset($this->groups[$name]);
    }

    public function load($name, array $options = array())
    {
        $this->loadFile();
        return $this->createGroup($name);
    }

    protected function loadFile()
    {
        if ($this->fileLoaded) {

            return;
        }

        $this->groups = $this->parser->parse(file_get_contents($this->file));
    }

    protected function createGroup($name)
    {
        if ($this->groups[$name] instanceof ConstraintGroup) {

            return $this->groups[$name];
        }

        $constraints = array();

        foreach ($this->groups[$name] as $constraint) {

            $arguments = reset($constraint);
            $class = key($constraint);

            $constraints[] = new $class((array)$arguments);
        }


        return $this->groups[$name] = new ConstraintGroup($name, $constraints);
    }
}