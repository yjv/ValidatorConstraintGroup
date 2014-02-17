<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/16/14
 * Time: 6:47 PM
 */

namespace Yjv\ValidatorConstraintGroup\Tests;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\True;
use Yjv\ValidatorConstraintGroup\ConstraintGroup;
use Yjv\ValidatorConstraintGroup\GroupFactory;
use Mockery;

class GroupFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var $factory Yjv\ValidatorConstraintGroup\GroupFactory
     */
    protected $factory;

    protected function setUp()
    {
        $this->factory = new GroupFactory();
    }

    public function testAddLoader()
    {
        $loader = Mockery::mock('Yjv\ValidatorConstraintGroup\GroupLoaderInterface');
        $this->assertSame($this->factory, $this->factory->addLoader($loader));
        $this->assertContains($loader, $this->factory->getLoaders());
    }

    /**
     * @expectedException Yjv\ValidatorConstraintGroup\GroupCreationFailedException
     * @expectedExceptionMessage Couldn't create the constraint group name1.
     */
    public function testCreateGroupWhereFails()
    {
        $groupName = 'name1';
        $options = array('key' => 'value');
        $loader = Mockery::mock('Yjv\ValidatorConstraintGroup\GroupLoaderInterface')
            ->shouldReceive('canLoad')
            ->once()
            ->with($groupName, $options)
            ->andReturn(false)
            ->getMock()
        ;
        $this->factory->addLoader($loader);
        $this->factory->createGroup($groupName, $options);

    }

    public function testCreateGroupWhereSuccessful()
    {
        $groupName = 'name1';
        $options = array('key' => 'value');
        $constraints = array(
            new NotBlank(),
            new True()
        );        $group = new ConstraintGroup($groupName, $constraints);
        $loader = Mockery::mock('Yjv\ValidatorConstraintGroup\GroupLoaderInterface')
            ->shouldReceive('canLoad')
            ->once()
            ->with($groupName, $options)
            ->andReturn(true)
            ->getMock()
            ->shouldReceive('load')
            ->once()
            ->with($groupName, $options)
            ->andReturn($group)
            ->getMock()
        ;
        $this->factory->addLoader($loader);
        $this->assertSame($group, $this->factory->createGroup($groupName, $options));

    }
}