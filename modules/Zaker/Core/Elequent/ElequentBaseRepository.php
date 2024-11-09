<?php

namespace Zaker\Core\Elequent;

use Zaker\Core\Repositories\BaseInterface;


abstract class ElequentBaseRepository implements  BaseInterface
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function store(array $inputs)
    {
        $this->model->create($inputs);
    }

    public function findBy(array $conditions)
    {
        foreach ($conditions as $column => $value) {
            $query = $this->model->where($column, $value);
        }
        return $query->first();
    }

}
