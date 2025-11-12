<?php
/*!
 * Nanite
 * Copyright (C) 2012-2025 Jack Polgar
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
 * Nanite is a tiny PHP router.
 *
 * A minimal, performant routing library that matches HTTP requests to callbacks.
 */
class Nanite
{
    public const string VERSION = '2.0.0';
    private static ?string $requestUri = null;
    public static bool $routeProcessed = false;

    /**
     * Routes a GET request and executes the routed function.
     *
     * @param string $route Pattern to match (regex-compatible)
     * @param callable $function Callback to execute on match
     * @return void
     */
    public static function get(string $route, callable $function): void
    {
        static::matchMethod('GET', $route, $function);
    }

    /**
     * Routes a POST request and executes the routed function.
     *
     * @param string $route Pattern to match (regex-compatible)
     * @param callable $function Callback to execute on match
     * @return void
     */
    public static function post(string $route, callable $function): void
    {
        static::matchMethod('POST', $route, $function);
    }

    /**
     * Routes a PUT request and executes the routed function.
     *
     * @param string $route Pattern to match (regex-compatible)
     * @param callable $function Callback to execute on match
     * @return void
     */
    public static function put(string $route, callable $function): void
    {
        static::matchMethod('PUT', $route, $function);
    }

    /**
     * Routes a PATCH request and executes the routed function.
     *
     * @param string $route Pattern to match (regex-compatible)
     * @param callable $function Callback to execute on match
     * @return void
     */
    public static function patch(string $route, callable $function): void
    {
        static::matchMethod('PATCH', $route, $function);
    }

    /**
     * Routes a DELETE request and executes the routed function.
     *
     * @param string $route Pattern to match (regex-compatible)
     * @param callable $function Callback to execute on match
     * @return void
     */
    public static function delete(string $route, callable $function): void
    {
        static::matchMethod('DELETE', $route, $function);
    }

    /**
     * Matches the current request method and processes the route if matched.
     *
     * @param string $method HTTP method to match
     * @param string $route Pattern to match
     * @param callable $function Callback to execute on match
     * @return void
     */
    private static function matchMethod(string $method, string $route, callable $function): void
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['_method'])
            && in_array(strtoupper($_POST['_method']), ['POST', 'PUT', 'PATCH', 'DELETE'])
        ) {
            $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
            unset($_POST['_method']);
        }

        if ($method === $_SERVER['REQUEST_METHOD']) {
            static::processRoute($route, $function);
        }
    }

    /**
     * Determines the base URI of the application.
     *
     * @param string|null $segments Additional path segments to append
     * @return string The base URI with optional segments
     */
    public static function baseUri(?string $segments = null): string
    {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $basePath = str_replace(basename($scriptName), '', $scriptName);

        return $basePath . ($segments ? trim($segments, '/') : '');
    }

    /**
     * Processes the route pattern against the current request URI.
     *
     * @param string $route Route pattern (regex-compatible)
     * @param callable $function Callback to execute on match
     * @return void
     */
    private static function processRoute(string $route, callable $function): void
    {
        if (static::$routeProcessed) {
            return;
        }

        if (static::requestUri() === '') {
            static::$requestUri = '/';
        }

        if (preg_match("#^{$route}$#", static::$requestUri, $matches)) {
            unset($matches[0]);
            call_user_func_array($function, $matches);
            static::$routeProcessed = true;
        }
    }

    /**
     * Determines the requested URI path.
     *
     * Attempts multiple methods to detect the request URI, in order of preference:
     * 1. PATH_INFO
     * 2. ORIG_PATH_INFO
     * 3. URL query parameter
     * 4. First GET parameter key
     * 5. QUERY_STRING
     * 6. REQUEST_URI (cleaned)
     *
     * @return string The requested URI path
     */
    public static function requestUri(): string
    {
        if (static::$requestUri !== null) {
            return static::$requestUri;
        }

        // Try PATH_INFO first
        $path = $_SERVER['PATH_INFO'] ?? @getenv('PATH_INFO') ?: '';
        if (static::isValidPath($path)) {
            return static::$requestUri = $path;
        }

        // Try ORIG_PATH_INFO
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $origPathInfo = $_SERVER['ORIG_PATH_INFO'] ?? @getenv('ORIG_PATH_INFO') ?: '';
        $path = str_replace($scriptName, '', $origPathInfo);
        if (static::isValidPath($path)) {
            return static::$requestUri = $path;
        }

        // Check for URL query parameter
        if (isset($_REQUEST['url'])) {
            return static::$requestUri = (string) $_REQUEST['url'];
        }

        // Check if there's a single GET parameter (common routing technique)
        if (is_array($_GET) && count($_GET) === 1) {
            $firstKey = (string) key($_GET);
            if (trim($firstKey, '/') !== '') {
                return static::$requestUri = $firstKey;
            }
        }

        // Try QUERY_STRING
        $path = $_SERVER['QUERY_STRING'] ?? @getenv('QUERY_STRING') ?: '';
        if (trim($path, '/') !== '') {
            return static::$requestUri = $path;
        }

        // Parse REQUEST_URI as last resort
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        $path = str_replace($scriptName, '', $requestUri);
        if (static::isValidPath($path)) {
            $basePath = str_replace(basename($scriptName), '', $scriptName);
            return static::$requestUri = str_replace($basePath, '', $path);
        }

        // Default to empty string
        return static::$requestUri = '';
    }

    /**
     * Checks if a path is valid and not just index.php.
     *
     * @param string $path The path to validate
     * @return bool True if valid path
     */
    private static function isValidPath(string $path): bool
    {
        $trimmed = trim($path, '/');
        return $trimmed !== '' && $path !== '/index.php';
    }
}
