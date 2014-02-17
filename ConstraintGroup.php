<?php
/**
 * Created by PhpStorm.
 * User: yosefderay
 * Date: 2/15/14
 * Time: 7:52 PM
 */

namespace Yjv\ValidatorConstraintGroup;


class ConstraintGroup
{
    protected $name;
    protected $constraints;

    public function __construct($name, array $constraints)
    {
        $this->name = $name;
        $this->constraints = $constraints;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }
}