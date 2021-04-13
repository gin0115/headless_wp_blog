<?php

declare(strict_types=1);

/**
 * Holds all classes which are to be loaded on initalisation.
 *
 * @package PinkCrab\Headless_Blog
 * @author Glynn Quelch glynn@pinkcrab.co.uk
 * @since 1.0.0
 */

use PinkCrab\Headless_Blog\Post\Post_Metabox_Controller;
use PinkCrab\Headless_Blog\Settings\Settings_Menu_Group;
use PinkCrab\Headless_Blog\Settings\Settings_Page_Controller;
use PinkCrab\Headless_Blog\Content_Component\Component_Enqueue_Controller;

return array(

	// "Post" post Type
	Post_Metabox_Controller::class,

	// Admin - Settings
	Settings_Menu_Group::class,
	Settings_Page_Controller::class,

	// Content Components
	Component_Enqueue_Controller::class
);
