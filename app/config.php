<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 05/08/2016
 * Time: 19:55
 */

$sep = DIRECTORY_SEPARATOR;

return [
    "db_name" => "ameliemazoomintv",
    "db_host" => "5.135.191.187",
    "db_user" => "ameliemazoomintv",
    "db_pass" => "M5XZ8xsQDXLKxKYU",
    "namespace_entity" => "ORM\\Entity",
    "namespace_repository" => "ORM\\Repository",
    "dir_entity" => sprintf("%s%s..%sORM%sEntity%s", __DIR__, $sep, $sep, $sep, $sep),
    "dir_repository" => sprintf("%s%s..%sORM%sRepository%s", __DIR__, $sep, $sep, $sep, $sep),
];