<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{

    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /*
     * Return Created Entity
     * @return Illuminate\Database\Eloquent\Model
     */

    public function getModel()
    {
        return $this->model;
    }

    protected function getLangCode()
    {
        $lang_code = app()->getLocale();

        return $lang_code;
    }


}
