<?php
/**
 * array keyleri api provider'ının ismini belirtir.
 * task_id_path     => task_id'sinin pathini belirtir.
 * duration_path    => task'in suresinin pathini belirtir.
 * level_path       => task'in zorluğunun pathini belirtir.
 *
 * type             => multidimensional array yapısı yoksa string, int, own ile type'ı belirtilir.
                    => multidimensional array yapısı varsa arrayin en dıştan içe doğru pathi belirtilir.
 * val              => array keyini belirtir.

 * name             => api provider ismini belirtir
 */
return [

    'api_1' => [
        "url"   => "http://www.mocky.io/v2/5d47f24c330000623fa3ebfa",
        "task_id_path"  => [
            [
                "type"  => "string",
                "val"   => "id"
            ]
        ],
        "duration_path" => [
            [
                "type"  => "string",
                "val"   => "sure"
            ]
        ],
        "level_path"    => [
            [
                "type"  => "string",
                "val"   => "zorluk"
            ]
        ],
        "name"      => "api1"
    ],

    'api_2' => [
        "url" => "http://www.mocky.io/v2/5d47f235330000623fa3ebf7",
        "task_id_path"  => [
            [
                "type"  => "own",
                "val"   => 0
            ]
        ],
        "duration_path" => [
            [
                "type"  => "key",
                "val"   => 0
            ], [
                "type"  => "string",
                "val"   => "estimated_duration"
            ],
        ],
        "level_path"    => [
            [
                "type"  => "key",
                "val"   => 0
            ], [
                "type"  => "string",
                "val"   => "level"
            ],
        ],
        "name"      => "api2"
    ],
];
