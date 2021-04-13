<?php

namespace PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Tests\Unit;

use Exception;
use PC_Headless_Blog_1AA\WP_UnitTestCase;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page;
use PC_Headless_Blog_1AA\Gin0115\WPUnit_Helpers\Objects;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Factory;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator;
class Test_Page_Validator extends \WP_UnitTestCase
{
    /** @testdox A page with no key or menu title defined, should fail validation. */
    public function test_fails_with_mock_page() : void
    {
        $validator = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator();
        $validator->validate_page($this->createMock(\PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::class));
        $this->assertTrue($validator->has_errors());
    }
    /** @testdox A page with a blank page key should be treated as no key and fail validation. */
    public function test_fails_with_blank_key() : void
    {
        $validator = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator();
        $validator->validate_page(new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page(''));
        $this->assertTrue($validator->has_errors());
        $this->assertStringContainsString('Page key not defined', $validator->get_error_messages());
    }
    /** @testdox A page without a defined menu title, should fail validation */
    public function test_fails_with_no_menu_title() : void
    {
        $validator = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator();
        $validator->validate_page(new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page('key'));
        $this->assertTrue($validator->has_errors());
        $this->assertStringContainsString('Menu title not defined', $validator->get_error_messages());
    }
    /** @testdox A page with an invlaid key should fail validation. */
    public function test_fails_with_invlaid_key() : void
    {
        $validator = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator();
        $validator->validate_page(new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page('!£$%'));
        $this->assertTrue($validator->has_errors());
        $this->assertStringContainsString('Page key is invalid', $validator->get_error_messages());
    }
    /** @testdox A page with view data but not template should fail validation */
    public function test_fails_without_view_template() : void
    {
        $validator = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator();
        $page = \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page::create_page('key', 'title')->view_data(array('a' => 1));
        $validator->validate_page($page);
        $this->assertTrue($validator->has_errors());
        $this->assertStringContainsString('View template not defined, but data passed', $validator->get_error_messages());
    }
    public function test_validates_acf_pages() : void
    {
        $validator = new \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page_Validator();
        $page = \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\ACF_Page::create_page('!£$%', 'title');
        $validator->validate_page($page);
        $this->assertTrue($validator->has_errors());
    }
}
