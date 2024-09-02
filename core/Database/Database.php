<?php

namespace Core\Database;

class Database implements DatabaseInterface
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function getInstance() {

    }

    private function connect() {

    }

    public function insert() {

    }

    public function first() {

    }

    public function delete() {

    }

    public function update() {

    }

    public function get() {

    }
}
