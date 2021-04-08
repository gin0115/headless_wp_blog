<?php

declare (strict_types=1);
/**
 * Tests for the WP_Dice wrapper.
 *
 * @since 0.3.1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\DI;

use DateTime;
use stdClass;
use PC_Headless_Blog_1AA\Dice\Dice;
use PC_Headless_Blog_1AA\WP_UnitTestCase;
use ReflectionException;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_F;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_G;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_H;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Interface_A;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_C;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_D;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_E;
use PC_Headless_Blog_1AA\PinkCrab\Core\Exceptions\DI_Container_Exception;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects as WPUnit_HelpersObjects;
class Test_PinkCrab_Dice extends \WP_UnitTestCase
{
    /**
     * Rules
     *
     * Any class which implements Interface_A will use Depenedcy_D
     * Any class which extends Abstract_B will use Dependency_C
     * Class_H will use Dependency_E to implement Interface_A
     *
     * @var array
     */
    protected $dice_rules = array(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Interface_A::class => array('instanceOf' => \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_D::class), \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B::class => array('instanceOf' => \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_C::class), \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_H::class => array('substitutions' => array(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Interface_A::class => \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_E::class)));
    /** @testdox It should be possible to use the container in a purely fluent without using NEW */
    public function test_constuctwith_factory() : void
    {
        $pc_dice = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::class, $pc_dice);
        // Check hold instance of Dice.
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\Dice\Dice::class, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($pc_dice, 'dice'));
    }
    /** @testdox Objects with with classes and interfaces as dependencies should be resolved if all rules that can not be determined by type, are supplied as rules. */
    public function test_can_populate_with_rules() : void
    {
        $pc_dice = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $pc_dice->addRules($this->dice_rules);
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_H::class, $pc_dice->create(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_H::class));
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_G::class, $pc_dice->create(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_G::class));
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_F::class, $pc_dice->create(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_F::class));
        $this->assertEquals(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_E::class, $pc_dice->create(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_H::class)->test());
        $this->assertEquals(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_D::class, $pc_dice->create(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_G::class)->test());
        $this->assertEquals(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_C::class, $pc_dice->create(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Class_F::class)->test());
    }
    /** @testdox If attemepting to create a class that doesnt exist and error should be generated and the system abort. */
    public function test_exception_thrown_if_none_existing_class() : void
    {
        $this->expectException(\ReflectionException::class);
        $pc_dice = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $pc_dice->create('NotAClass');
    }
    /** @testdox It should be possible to add single DI rule to the container */
    public function test_test_can_add_rule() : void
    {
        $pc_dice = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $result = $pc_dice->addRule(\stdClass::class, array('instanceOf' => \DateTime::class));
        $this->assertInstanceOf(\DateTime::class, $result->create(\stdClass::class));
    }
    /** @testdox It should be possible to check if a class either has a rule defined or exists as a valid class*/
    public function test_has() : void
    {
        $pc_dice = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        // As a global
        $pc_dice->addRule('*', array('substitutions' => array(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Interface_A::class => \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_E::class)));
        $this->assertTrue($pc_dice->has(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Interface_A::class));
        // As a single rule
        $pc_dice->addRule(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B::class, array('instanceOf' => \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Dependency_C::class));
        $this->assertTrue($pc_dice->has(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B::class));
        // General object.
        $this->assertTrue($pc_dice->has(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class));
    }
    /** @testdox It should be possible to create objects using only the rules defined and without the option of passing params. It should also be PSR complient. */
    public function test_can_create_purely_using_autowiring() : void
    {
        $pc_dice = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $this->assertInstanceOf(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class, $pc_dice->get(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class));
    }
    /** @testdox If attempeting to use the pure autowire on a class that doest exist and error should be generated and the systm aborted */
    public function test_throws_exception_using_undefined_class_on_get() : void
    {
        $this->expectException(\PC_Headless_Blog_1AA\PinkCrab\Core\Exceptions\DI_Container_Exception::class);
        $pc_dice = \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice::withDice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $pc_dice->get('NotAClass');
    }
}
