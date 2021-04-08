<?php

declare (strict_types=1);
/**
 * Mock Post Type with metaboxes
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Registerables
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\CPT;

use PC_Headless_Blog_1AA\PinkCrab\Registerables\MetaBox;
use PC_Headless_Blog_1AA\PinkCrab\Registerables\Post_Type;
class MetaBox_CPT extends \PC_Headless_Blog_1AA\PinkCrab\Registerables\Post_Type
{
    public $key = 'metabox_cpt';
    public $singular = 'singular';
    public $plural = 'plural';
    public function metaboxes() : void
    {
        $this->metaboxes[] = \PC_Headless_Blog_1AA\PinkCrab\Registerables\MetaBox::normal('metabox_cpt_normal')->label('metabox_cpt_normal TITLE')->view(function (\WP_Post $post, array $args) {
            print 'metabox_cpt_normal VIEW';
        })->view_vars(array('key1' => 1));
        $this->metaboxes[] = \PC_Headless_Blog_1AA\PinkCrab\Registerables\MetaBox::side('metabox_cpt_side')->label('metabox_cpt_side TITLE')->view(function (\WP_Post $post, array $args) {
            print 'metabox_cpt_side VIEW';
        })->view_vars(array('key2' => 2));
    }
}
