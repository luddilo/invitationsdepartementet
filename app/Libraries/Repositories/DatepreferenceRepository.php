<?php namespace App\Libraries\Repositories;

use App\Models\Datepreference;
use App\Libraries\Repositories\BaseRepository;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DatepreferenceRepository extends BaseRepository
{

    /**
    * Configure the Model
    *
    **/
    public function model()
    {
      return 'App\Models\Datepreference';
    }

	public function search($input)
    {
        $query = Datepreference::query();

        $columns = Schema::getColumnListing('datepreferences');
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
            throw new HttpException(1001, "Datepreference not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "Datepreference not found");
        }

        return $model->delete();
    }
}
