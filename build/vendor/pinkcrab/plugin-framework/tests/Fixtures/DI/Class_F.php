<?php

declare (strict_types=1);
/**
 * Class C
 * Injected with abstract
 *
 * @since 0.2.0
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI;

use PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B;
class Class_F
{
    /**
     * Dependency constructed
     *
     * @var Abstract_B
     */
    protected $dependency;
    /**
     * Create class.
     *
     * @param \PinkCrab\Core\Tests\Fixtures\DI\Abstract_B $dependency
     */
    public function __construct(\PC_Headless_Blog_1AA\PinkCrab\Core\Tests\Fixtures\DI\Abstract_B $dependency)
    {
        $this->dependency = $dependency;
    }
    /**
     * Retutns the class name of the dependdency
     *
     * @return string
     */
    public function test() : string
    {
        return \get_class($this->dependency);
    }
}
