<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/15/14
 * Time: 9:01 PM
 */
namespace Yjv\ValidatorConstraintGroup;

class GroupCreationFailedException extends \Exception
{
    public function __construct($name)
    {
        parent::__construct(sprintf("Couldn't create the constraint group %s.", $name));
    }

}