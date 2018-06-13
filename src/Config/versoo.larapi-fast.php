<?php

return [
    /*
     * Default namespace for API
     */

    'rootNamespace' => "Api\\",
    'Resource' => [],

    /*
     * Directory for custom stubs files.
     * If NULL commands use default stubs files.
     */
    'stubs_directory' => null,

    'Command' => [
        'directory' => 'Console',
    ],

    'Controller' => [
        'directory' => 'Controllers',
    ],

    'Event' => [
        'directory' => 'Events',
    ],

    'Exception' => [
        'directory' => 'Exceptions',
    ],

    'Model' => [
        'directory' => 'Models',
        'migration' => true,
        'factory' => true,
        'seeder' => true,
    ],

    'Repository' => [
        'directory' => 'Repositories',
    ],

    'Request' => [
        'directory' => 'Requests',
    ],

    'Service' => [
        'directory' => 'Services',
    ],

    'Routes' => [
        'directory' => null,
    ],

    'Provider' => [
        'directory' => null,
    ],

];
