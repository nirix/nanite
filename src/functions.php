<?php
/*!
 * Nanite
 * Copyright (C) 2012-2025 Jack P.
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

declare(strict_types=1);

/**
 * Shortcut to the Nanite::get() method.
 *
 * @param string $route
 * @param callable $function
 */
function get(string $route, callable $function): void
{
    Nanite::get($route, $function);
}

/**
 * Shortcut to the Nanite::post() method.
 *
 * @param string $route
 * @param callable $function
 */
function post(string $route, callable $function): void
{
    Nanite::post($route, $function);
}

/**
 * Shortcut to the Nanite::put() method.
 *
 * @param string $route
 * @param callable $function
 */
function put(string $route, callable $function): void
{
    Nanite::put($route, $function);
}

/**
 * Shortcut to the Nanite::patch() method.
 *
 * @param string $route
 * @param callable $function
 */
function patch(string $route, callable $function): void
{
    Nanite::patch($route, $function);
}

/**
 * Shortcut to the Nanite::delete() method.
 *
 * @param string $route
 * @param callable $function
 */
function delete(string $route, callable $function): void
{
    Nanite::delete($route, $function);
}

/**
 * Shortcut to the Nanite::requestUri() method.
 *
 * @return string The requested URI path
 */
function requestUri(): string
{
    return Nanite::requestUri();
}

/**
 * Shortcut to the Nanite::baseUri() method.
 *
 * @param string|null $segments Additional path segments to append
 *
 * @return string The base URI with optional segments
 */
function baseUri(?string $segments = null): string
{
    return Nanite::baseUri($segments);
}
