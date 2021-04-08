<?php

declare (strict_types=1);
/**
 * Interface for custom ServiceContainer
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @package PinkCrab\Core
 */
namespace PC_Headless_Blog_1AA\PinkCrab\Core\Interfaces;

use PC_Headless_Blog_1AA\Psr\Container\ContainerInterface;
interface Service_Container extends \PC_Headless_Blog_1AA\Psr\Container\ContainerInterface
{
    /**
     * Binds an object to the constainer
     *
     * @param string $id
     * @param object $service
     * @return void
     */
    public function set($id, $service) : void;
}
