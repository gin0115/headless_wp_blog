<?php

declare (strict_types=1);
/**
 * Tests for the WP_Dice wrapper.
 *
 * @since 0.4.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Registration;

use PC_Headless_Blog_1AA\Dice\Dice;
use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\Hooks;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\DI_Container;
use PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registration_Middleware;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Parent_Dependency;
use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Mock_Registation_Middleware;
use PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Middleware\Registerable_Middleware;
class Test_Registration_Service extends \WP_UnitTestCase
{
    /** @testdox The registration service must be populated with a DI Container*/
    public function test_can_set_di_container() : void
    {
        $container = $this->createMock(\PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\DI_Container::class);
        $registration_service = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service();
        $registration_service->set_container($container);
        $this->assertSame($container, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($registration_service, 'di_container'));
    }
    /** @testdox It should be possible to add as many peices of registration middleware as desired to the registration process. */
    public function test_push_middleware_to_internal_stack() : void
    {
        $registration_service = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service();
        $middleware1 = $this->createMock(\PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Middleware\Registerable_Middleware::class);
        $registration_service->push_middleware($middleware1);
        $middleware2 = $this->createMock(\PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces\Registration_Middleware::class);
        $registration_service->push_middleware($middleware2);
        $this->assertContains($middleware1, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($registration_service, 'middleware'));
        $this->assertContains($middleware2, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($registration_service, 'middleware'));
    }
    /** @testdox You should be able to set a full array of classes to the registration service to be used during the process. */
    public function test_can_set_classes_to_registation_service() : void
    {
        $registration_service = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service();
        $classes = array(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class, \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Parent_Dependency::class);
        $registration_service->set_classes($classes);
        $this->assertSame($classes, \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($registration_service, 'class_list'));
    }
    /** @testdox You should be able to add single classes to be added to the registration service class list */
    public function test_can_push_class_to_registration_service() : void
    {
        $registration_service = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service();
        $registration_service->push_class(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class);
        $registration_service->push_class(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Parent_Dependency::class);
        $this->assertSame(array(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class, \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Parent_Dependency::class), \PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects::get_property($registration_service, 'class_list'));
    }
    /** @testdox A populate registation service should be able to process all classes against all middleware. */
    public function test_process_registation_middleware() : void
    {
        $registration_service = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service();
        $container = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice(new \PC_Headless_Blog_1AA\Dice\Dice());
        $registration_service->set_container($container);
        $registration_service->push_middleware(new \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Mock_Registation_Middleware());
        $registration_service->set_classes(array(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class, \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Parent_Dependency::class));
        $this->expectOutputRegex('/Sample_Class/');
        $this->expectOutputRegex('/Parent_Dependency/');
        $registration_service->process();
    }
    /** @testdox External codebase should be able to use a filter to add additional classes to the classlist. */
    public function test_process_registation_middleware_using_filter() : void
    {
        $this->expectOutputRegex('/Sample_Class/');
        $this->expectOutputRegex('/Parent_Dependency/');
        $container = new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Dice\PinkCrab_Dice(new \PC_Headless_Blog_1AA\Dice\Dice());
        add_filter(\PC_Headless_Blog_1AA\PinkCrab\Core\Application\Hooks::APP_INIT_REGISTRATION_CLASS_LIST, function ($e) {
            $e[] = \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Parent_Dependency::class;
            return $e;
        });
        (new \PC_Headless_Blog_1AA\PinkCrab\Core\Services\Registration\Registration_Service())->push_middleware(new \PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Mock_Registation_Middleware())->set_container($container)->push_class(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\Mock_Objects\Sample_Class::class)->process();
        // $registration_service->set_classes( array( Sample_Class::class, Parent_Dependency::class ) );
    }
}
