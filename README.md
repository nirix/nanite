Nanite
======

Requirements
------------

- PHP 5.3+

Example
-------

There are two functions for requests, `get` for GET requests and `post` for POST requests.

    <?php
    require 'src/Nanite.php';
    require 'src/functions.php';

    // Use / for the main/index page.
    get('/', function(){
        echo "Front page";
    });

    // All routes start with /
    get('/about', function(){
        echo "About page";
    });

    // Regex enabled, groups get passed to the function.
    get('/projects/([a-zA-Z0-9\-_]+)', function($project){
        echo "Project page for {$project}";
    });

    // Handle a POST request
    post('/contact', function(){
        // Handle submitted contact form.
    });

    // Checking if a route has been matched
    if (!Nanite::$routeProccessed) {
        // 404 page here
    }

Apache `mod_rewrite`
--------------------

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php/$1 [L,QSA]
    # or
    # RewriteRule ^(.*)$ index.php?url=/$1 [L,QSA]

License
-------

Nanite is released under the GNU Lesser General Public License, _version 3 only_.

    Nanite is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation; version 3 only.

    Nanite is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with Nanite. If not, see <http://www.gnu.org/licenses/>.
