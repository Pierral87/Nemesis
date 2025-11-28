<?php
namespace ProjetTransfo\Classes;

class Config
{
    public static function getDatabaseConfig(): array
    {
        return [
            'host' => 'localhost',
            'dbname' => 'dialogue',
            'user' => 'root',
            'password' => ''
        ];
    }

    public static function getRootURL(): string 
    {
        return "http://localhost/nemesis/S16-PHPOO/10-transformation-poo/";
    }
}
