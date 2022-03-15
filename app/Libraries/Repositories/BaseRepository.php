<?php namespace App\Libraries\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

abstract class BaseRepository extends Repository
{
    public function create(array $data) {
        if (Schema::hasColumn($this->model->getTable(), 'created_by') && Auth::user()){
            $data['created_by'] = Auth::user()->id;
        }
        return $this->model->create($data);
    }
}