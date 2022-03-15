<?php namespace App\Libraries\Repositories;

use App\Models\Referrer;
use App\Libraries\Repositories\BaseRepository;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReferrerRepository extends BaseRepository
{

    /**
    * Configure the Model
    *
    **/
    public function model()
    {
      return 'App\Models\Referrer';
    }

	public function search($input)
    {
        $query = Referrer::query();

        $columns = Schema::getColumnListing('referrers');
        $attributes = array();

        foreach($columns as $attribute)
        {
            if(isset($input[$attribute]) and !empty($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] = $input[$attribute];
            }
            else
            {
                $attributes[$attribute] =  null;
            }
        }

        return [$query->get(), $attributes];
    }

    public function apiFindOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "Referrer not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "Referrer not found");
        }

        return $model->delete();
    }
}
