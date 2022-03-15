<?php namespace App\Libraries\Repositories;

use App\Models\Address;
use App\Models\User;
use App\Libraries\Repositories\BaseRepository;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AddressRepository extends BaseRepository
{

    /**
    * Configure the Model
    *
    **/
    public function model()
    {
      return 'App\Models\Address';
    }

	public function search($input)
    {
        $query = Address::query();

        $columns = Schema::getColumnListing('addresses');
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
            throw new HttpException(1001, "Address not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if(empty($model))
        {
            throw new HttpException(1001, "Address not found");
        }

        return $model->delete();
    }

    public function assignAddress($id, $input) {
        if (array_key_exists('address_street', $input)){
            $dinner = $this->find($id);
            $address = Address::where('d', $id)->first();

            if (!$address) {
                $address = new Address();
            }

            $address->street = $input['address_street'];
            $address->zipcode = array_key_exists('address_zip',$input) ? $input['address_zip'] : '';
            $address->city =  array_key_exists('address_city',$input) ? $input['address_city'] : '';
            $address->country =  array_key_exists('address_country',$input) ? $input['address_country'] : 'SE';

            $dinner->address()->save($address);
        }
    }

    public function getAddressByUser($id) {
        $user = User::findOrFail($id);
        return $user->address;
    }
}
