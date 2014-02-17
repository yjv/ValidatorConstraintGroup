<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/16/14
 * Time: 6:33 PM
 */

namespace Yjv\ValidatorConstraintGroup\Tests;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\True;
use Yjv\ValidatorConstraintGroup\ConstraintGroup;

class ConstraintGroupTest extends \PHPUnit_Framework_TestCase
{
    protected $group;

    public function testGetters()
    {
        $name = 'name1';
        $constraints = array(
            new NotBlank(),
            new True()
        );
        $this->group = new ConstraintGroup($name, $constraints);
        $this->assertEquals($name, $this->group->getName());
        $this->assertEquals($constraints, $this->group->getConstraints());
    }
}