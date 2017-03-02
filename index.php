<?php

define('PATH', __DIR__);
define('APP', 'Application');
define('DEBUG', true);
require 'Light/Base.php';
Base::init()->createWebApp();
