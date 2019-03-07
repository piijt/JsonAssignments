<?php
abstract class DbP {
    const DBHOST = 'localhost';
    const DBUSER = 'root';
    const USERPWD = '4216@';
    const DB = 'newworld';
    const DSN = "mysql:host=".self::DBHOST.";dbname=".self::DB;
}
