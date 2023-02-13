<?php
Config::set('site', 'Hello World');
Config::set('salt', '123');

// Өгөгдлийн сангийн тохиргоо
Config::set('db.database', 'helloworld_test');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.host', 'localhost');

// Системийн default утгуудыг бэлтгэх
Config::set('routes', array(
    'default' => '',
    'admin' => 'admin_',
));

Config::set('default_route', 'default');
Config::set('default_controller', 'course');
Config::set('default_action', 'index');