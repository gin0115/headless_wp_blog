<?php

namespace PC_Headless_Blog_1AA;

/* @description Dice - A minimal Dependency Injection Container for PHP *
 * @author Tom Butler tom@r.je *
 * @copyright 2012-2018 Tom Butler <tom@r.je> | https:// r.je/dice.html *
 * @license http:// www.opensource.org/licenses/bsd-license.php BSD License *
 * @version 3.0 */
class TestSharedInstancesTop
{
    public $share1;
    public $share2;
    public function __construct(\PC_Headless_Blog_1AA\SharedInstanceTest1 $share1, \PC_Headless_Blog_1AA\SharedInstanceTest2 $share2)
    {
        $this->share1 = $share1;
        $this->share2 = $share2;
    }
}
/* @description Dice - A minimal Dependency Injection Container for PHP *
 * @author Tom Butler tom@r.je *
 * @copyright 2012-2018 Tom Butler <tom@r.je> | https:// r.je/dice.html *
 * @license http:// www.opensource.org/licenses/bsd-license.php BSD License *
 * @version 3.0 */
\class_alias('PC_Headless_Blog_1AA\\TestSharedInstancesTop', 'TestSharedInstancesTop', \false);
class SharedInstanceTest1
{
    public $shared;
    public function __construct(\PC_Headless_Blog_1AA\Shared $shared)
    {
        $this->shared = $shared;
    }
}
\class_alias('PC_Headless_Blog_1AA\\SharedInstanceTest1', 'SharedInstanceTest1', \false);
class SharedInstanceTest2
{
    public $shared;
    public function __construct(\PC_Headless_Blog_1AA\Shared $shared)
    {
        $this->shared = $shared;
    }
}
\class_alias('PC_Headless_Blog_1AA\\SharedInstanceTest2', 'SharedInstanceTest2', \false);
class M1
{
    public $f;
    public function __construct(\PC_Headless_Blog_1AA\F $f)
    {
        $this->f = $f;
    }
}
\class_alias('PC_Headless_Blog_1AA\\M1', 'M1', \false);
class M2
{
    public $e;
    public function __construct(\PC_Headless_Blog_1AA\E $e)
    {
        $this->e = $e;
    }
}
\class_alias('PC_Headless_Blog_1AA\\M2', 'M2', \false);
class Foo77
{
    public $bar;
    public function __construct(\PC_Headless_Blog_1AA\Bar77 $bar)
    {
        $this->bar = $bar;
    }
}
\class_alias('PC_Headless_Blog_1AA\\Foo77', 'Foo77', \false);
class Bar77
{
    public $a;
    public function __construct($a)
    {
        $this->a = $a;
    }
}
\class_alias('PC_Headless_Blog_1AA\\Bar77', 'Bar77', \false);
class Baz77
{
    public static function create()
    {
        return new \PC_Headless_Blog_1AA\Bar77('Z');
    }
}
\class_alias('PC_Headless_Blog_1AA\\Baz77', 'Baz77', \false);
class Shared
{
    public $uniq;
    public function __construct()
    {
        $this->uniq = \uniqid();
    }
}
\class_alias('PC_Headless_Blog_1AA\\Shared', 'Shared', \false);
