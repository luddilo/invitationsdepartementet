<?php namespace App\Libraries\Repositories;

use App\Models\Match;
use App\Models\Dinner;
use App\Models\Note;
use App\Libraries\Repositories\BaseRepository;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MatchRepository extends BaseRepository
{

    /**
    * Configure the Model
    *
    **/
    public function model()
    {
      return 'App\Models\Match';
    }

	public function search($input)
    {
        $query = Match::query();

        $columns = Schema::getColumnListing('matches');
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
            throw new HttpException(1001, "Match not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "Match not found");
        }

        return $model->delete();
    }

    public function getByUserAndStatusId($user, $status_id) {
        return Match::where('user_id', $user->id)->where('status_id', $status_id);
    }

    public function assignNotes($id, $input){
        if (array_key_exists('note', $input)){
            $match = $this->find($id);
            $note = new Note([
                'content' => $input['note'],
                'author_id' => \Auth::user()->id
            ]);
            $match->user->notes()->save($note);
        }
    }

}
