<?php

namespace PC_Headless_Blog_1AA;

/* @description Dice - A minimal Dependency Injection Container for PHP *
 * @author Tom Butler tom@r.je *
 * @copyright 2012-2018 Tom Butler <tom@r.je> | https:// r.je/dice.html *
 * @license http:// www.opensource.org/licenses/bsd-license.php BSD License *
 * @version 3.0 */
class NamespaceTest extends \PC_Headless_Blog_1AA\DiceTest
{
    public function testNamespaceBasic()
    {
        $a = $this->dice->create('PC_Headless_Blog_1AA\\Foo\\A');
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Foo\\A', $a);
    }
    public function testNamespaceWithSlash()
    {
        $a = $this->dice->create('PC_Headless_Blog_1AA\\Foo\\A');
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Foo\\A', $a);
    }
    public function testNamespaceWithSlashrule()
    {
        $rule = [];
        $rule['substitutions']['Foo\\A'] = [\PC_Headless_Blog_1AA\Dice\Dice::INSTANCE => 'PC_Headless_Blog_1AA\\Foo\\ExtendedA'];
        $dice = $this->dice->addRule('PC_Headless_Blog_1AA\\Foo\\B', $rule);
        $b = $dice->create('PC_Headless_Blog_1AA\\Foo\\B');
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Foo\\ExtendedA', $b->a);
    }
    public function testNamespaceWithSlashruleInstance()
    {
        $rule = [];
        $rule['substitutions']['Foo\\A'] = [\PC_Headless_Blog_1AA\Dice\Dice::INSTANCE => 'PC_Headless_Blog_1AA\\Foo\\ExtendedA'];
        $dice = $this->dice->addRule('PC_Headless_Blog_1AA\\Foo\\B', $rule);
        $b = $dice->create('PC_Headless_Blog_1AA\\Foo\\B');
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Foo\\ExtendedA', $b->a);
    }
    public function testNamespaceTypeHint()
    {
        $rule = [];
        $rule['shared'] = \true;
        $dice = $this->dice->addRule('PC_Headless_Blog_1AA\\Bar\\A', $rule);
        $c = $dice->create('PC_Headless_Blog_1AA\\Foo\\C');
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Bar\\A', $c->a);
        $c2 = $dice->create('PC_Headless_Blog_1AA\\Foo\\C');
        $this->assertNotSame($c, $c2);
        //Check the rule has been correctly recognised for type hinted classes in a different namespace
        $this->assertSame($c2->a, $c->a);
    }
    public function testNamespaceInjection()
    {
        $b = $this->dice->create('PC_Headless_Blog_1AA\\Foo\\B');
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Foo\\B', $b);
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Foo\\A', $b->a);
    }
    public function testNamespaceRuleSubstitution()
    {
        $rule = [];
        $rule['substitutions']['Foo\\A'] = [\PC_Headless_Blog_1AA\Dice\Dice::INSTANCE => 'PC_Headless_Blog_1AA\\Foo\\ExtendedA'];
        $dice = $this->dice->addRule('PC_Headless_Blog_1AA\\Foo\\B', $rule);
        $b = $dice->create('PC_Headless_Blog_1AA\\Foo\\B');
        $this->assertInstanceOf('PC_Headless_Blog_1AA\\Foo\\ExtendedA', $b->a);
    }
}
/* @description Dice - A minimal Dependency Injection Container for PHP *
 * @author Tom Butler tom@r.je *
 * @copyright 2012-2018 Tom Butler <tom@r.je> | https:// r.je/dice.html *
 * @license http:// www.opensource.org/licenses/bsd-license.php BSD License *
 * @version 3.0 */
\class_alias('PC_Headless_Blog_1AA\\NamespaceTest', 'NamespaceTest', \false);
