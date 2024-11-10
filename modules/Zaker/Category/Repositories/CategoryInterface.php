<?php

namespace Zaker\Category\Repositories;
use Zaker\Core\Repositories\BaseInterface;

interface CategoryInterface extends BaseInterface
{
    public function allExceptById($id);
}
