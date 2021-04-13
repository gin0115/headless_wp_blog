<?php

declare(strict_types=1);

/**
 * The primary admin menu group.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @package Settings
 * @since 1.0.0
 */

namespace PinkCrab\Headless_Blog\Settings;

use RdKafka\Conf;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\Config;
use PinkCrab\Headless_Blog\Settings\Settings_Page_Controller;
use PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Menu_Page_Group;
use PC_Headless_Blog_1AA\PinkCrab\Core\Application\App_Config;

class Settings_Menu_Group extends Menu_Page_Group {

	// Define menu details
	public $menu_title = 'Settings Page';
	public $icon_url   = 'dashicons-carrot';

	protected $page_controller;

	public function __construct(
		Settings_Page_Controller $page_controller,
		App $app,
		App_Config $config
	) {
		$this->page_controller = $page_controller;
		$this->key             = $config->settings_page_slug;
		parent::__construct( $app );

	}

	/**
	 * Defines the parent page.
	 *
	 * @param \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page $page
	 * @return \PC_Headless_Blog_1AA\PinkCrab\Admin_Pages\Page
	 */
	public function set_parent_page( Page $page ): Page {
		return $page
			->title( 'Single Page Title' )
			->view_template( 'admin.settings.settings-page' )
			->view_data( $this->page_controller->page_view_data() );
	}
}
