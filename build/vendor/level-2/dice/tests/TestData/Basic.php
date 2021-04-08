<?php

namespace PC_Headless_Blog_1AA;

/* @description Dice - A minimal Dependency Injection Container for PHP *
 * @author Tom Butler tom@r.je *
 * @copyright 2012-2018 Tom Butler <tom@r.je> | https:// r.je/dice.html *
 * @license http:// www.opensource.org/licenses/bsd-license.php BSD License *
 * @version 3.0 */
class NoConstructor
{
    public $a = 'b';
}
/* @description Dice - A minimal Dependency Injection Container for PHP *
 * @author Tom Butler tom@r.je *
 * @copyright 2012-2018 Tom Butler <tom@r.je> | https:// r.je/dice.html *
 * @license http:// www.opensource.org/licenses/bsd-license.php BSD License *
 * @version 3.0 */
\class_alias('PC_Headless_Blog_1AA\\NoConstructor', 'NoConstructor', \false);
class CyclicA
{
    public $b;
    public function __construct(\PC_Headless_Blog_1AA\CyclicB $b)
    {
        $this->b = $b;
    }
}
\class_alias('PC_Headless_Blog_1AA\\CyclicA', 'CyclicA', \false);
class CyclicB
{
    public $a;
    public function __construct(\PC_Headless_Blog_1AA\CyclicA $a)
    {
        $this->a = $a;
    }
}
\class_alias('PC_Headless_Blog_1AA\\CyclicB', 'CyclicB', \false);
class A
{
    public $b;
    public function __construct(\PC_Headless_Blog_1AA\B $b)
    {
        $this->b = $b;
    }
}
\class_alias('PC_Headless_Blog_1AA\\A', 'A', \false);
class B
{
    public $c;
    public function __construct(\PC_Headless_Blog_1AA\C $c)
    {
        $this->c = $c;
    }
}
\class_alias('PC_Headless_Blog_1AA\\B', 'B', \false);
class ExtendedB extends \PC_Headless_Blog_1AA\B
{
}
\class_alias('PC_Headless_Blog_1AA\\ExtendedB', 'ExtendedB', \false);
class C
{
    public $d;
    public $e;
    public function __construct(\PC_Headless_Blog_1AA\D $d, \PC_Headless_Blog_1AA\E $e)
    {
        $this->d = $d;
        $this->e = $e;
    }
}
\class_alias('PC_Headless_Blog_1AA\\C', 'C', \false);
class D
{
}
\class_alias('PC_Headless_Blog_1AA\\D', 'D', \false);
class E
{
    public $f;
    public function __construct(\PC_Headless_Blog_1AA\F $f)
    {
        $this->f = $f;
    }
}
\class_alias('PC_Headless_Blog_1AA\\E', 'E', \false);
class F
{
}
\class_alias('PC_Headless_Blog_1AA\\F', 'F', \false);
class RequiresConstructorArgsA
{
    public $foo;
    public $bar;
    public function __construct($foo, $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }
}
\class_alias('PC_Headless_Blog_1AA\\RequiresConstructorArgsA', 'RequiresConstructorArgsA', \false);
class MyObj
{
    private $foo;
    public function setFoo($foo)
    {
        $this->foo = $foo;
    }
    public function getFoo()
    {
        return $this->foo;
    }
}
\class_alias('PC_Headless_Blog_1AA\\MyObj', 'MyObj', \false);
class MethodWithDefaultValue
{
    public $a;
    public $foo;
    public function __construct(\PC_Headless_Blog_1AA\A $a, $foo = 'bar')
    {
        $this->a = $a;
        $this->foo = $foo;
    }
}
\class_alias('PC_Headless_Blog_1AA\\MethodWithDefaultValue', 'MethodWithDefaultValue', \false);
class MethodWithDefaultNull
{
    public $a;
    public $b;
    public function __construct(\PC_Headless_Blog_1AA\A $a, \PC_Headless_Blog_1AA\B $b = null)
    {
        $this->a = $a;
        $this->b = $b;
    }
}
\class_alias('PC_Headless_Blog_1AA\\MethodWithDefaultNull', 'MethodWithDefaultNull', \false);
interface interfaceTest
{
}
\class_alias('PC_Headless_Blog_1AA\\interfaceTest', 'interfaceTest', \false);
class InterfaceTestClass implements \PC_Headless_Blog_1AA\interfaceTest
{
}
\class_alias('PC_Headless_Blog_1AA\\InterfaceTestClass', 'InterfaceTestClass', \false);
class ParentClass
{
}
\class_alias('PC_Headless_Blog_1AA\\ParentClass', 'ParentClass', \false);
class Child extends \PC_Headless_Blog_1AA\ParentClass
{
}
\class_alias('PC_Headless_Blog_1AA\\Child', 'Child', \false);
class OptionalInterface
{
    public $obj;
    public function __construct(\PC_Headless_Blog_1AA\InterfaceTest $obj = null)
    {
        $this->obj = $obj;
    }
}
\class_alias('PC_Headless_Blog_1AA\\OptionalInterface', 'OptionalInterface', \false);
class ScalarTypeHint
{
    public function __construct(string $a = null)
    {
    }
}
\class_alias('PC_Headless_Blog_1AA\\ScalarTypeHint', 'ScalarTypeHint', \false);
class CheckConstructorArgs
{
    public $arg1;
    public function __construct($arg1)
    {
        $this->arg1 = $arg1;
    }
}
\class_alias('PC_Headless_Blog_1AA\\CheckConstructorArgs', 'CheckConstructorArgs', \false);
