<?php

declare (strict_types=1);
/**
 * Basic CPT Mock Object
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Registerables
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Registerables\Tests\Fixtures\CPT;

use PC_Headless_Blog_1AA\PinkCrab\Registerables\Post_Type;
class Basic_CPT extends \PC_Headless_Blog_1AA\PinkCrab\Registerables\Post_Type
{
    public $key = 'basic_cpt';
    public $singular = 'Basic';
    public $plural = 'Basics';
}
