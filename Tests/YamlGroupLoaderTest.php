<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/16/14
 * Time: 6:59 PM
 */

namespace Yjv\ValidatorConstraintGroup\Tests;


use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\True;
use Yjv\ValidatorConstraintGroup\ConstraintGroup;
use Yjv\ValidatorConstraintGroup\YamlGroupLoader;

class YamlGroupLoaderTest extends \PHPUnit_Framework_TestCase
{
    protected $loader;

    protected function setUp()
    {
        $this->loader = new YamlGroupLoader(__DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.'groups.yml');
    }

    public function testCanLoad()
    {
        $this->assertTrue($this->loader->canLoad('group1'));
        $this->assertTrue($this->loader->canLoad('group2'));
        $this->assertFalse($this->loader->canLoad('group3'));
    }

    public function testLoad()
    {
        $this->assertEquals(new ConstraintGroup(
            'group1',
            array(
                new NotBlank(array('message' => 'hello')),
                new NotBlank(array('message' => 'goodbye')),
                new True(array('message' => 'hahahahahah'))
            )
        ), $this->loader->load('group1'));
        $this->assertEquals(new ConstraintGroup(
            'group2',
            array(
                new NotBlank(array('message' => 'goodbye')),
                new NotBlank(array('message' => 'hahahahahah')),
                new True(array('message' => 'hello'))
            )
        ), $this->loader->load('group2'));
    }
}
 