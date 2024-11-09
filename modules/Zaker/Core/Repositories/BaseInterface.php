<?php

namespace Zaker\Core\Repositories;

interface BaseInterface{

    public function all();
    public function store(array $inputs);
    public function findBy(array $conditions);
}
