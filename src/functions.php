<?php
/*!
 * Nanite
 * Copyright (C) 2012-2016 Jack P.
 * https://github.com/nirix
 *
 * Nanite is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; version 3 only.
 *
 * Nanite is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Nanite. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Shortcut to the Nanite::get() method.
 *
 * @param string $route
 * @param function $function
 */
function get($route, $function)
{
    Nanite::get($route, $function);
}

/**
 * Shortcut to the Nanite::post() method.
 *
 * @param string $route
 * @param function $function
 */
function post($route, $function)
{
    Nanite::post($route, $function);
}

/**
 * Shortcut to the Nanite::put() method.
 *
 * @param string $route
 * @param function $function
 */
function put($route, $function)
{
    Nanite::put($route, $function);
}

/**
 * Shortcut to the Nanite::patch() method.
 *
 * @param string $route
 * @param function $function
 */
function patch($route, $function)
{
    Nanite::patch($route, $function);
}

/**
 * Shortcut to the Nanite::delete() method.
 *
 * @param string $route
 * @param function $function
 */
function delete($route, $function)
{
    Nanite::delete($route, $function);
}
