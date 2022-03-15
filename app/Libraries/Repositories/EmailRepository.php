<?php namespace App\Libraries\Repositories;

use App\Libraries\Repositories\BaseRepository;
use App\Models\Email;
use App\Libraries\Helpers;

class EmailRepository extends BaseRepository
{
    public function model()
    {
        return Email::class;
    }

    public function create(array $input)
    {
        // Pre-proccess data
        $data = [
            'token'       => Helpers::uuid(),
            'user_id'     => isset($input['user'], $input['user']->id) ? $input['user']->id : null,
            'dinner_id'   => isset($input['dinner_id']) ? $input['dinner_id'] : null,
            'sender_id'   => isset($input['sender'], $input['sender']->id) ? $input['sender']->id : null,
            'email_type'  => isset($input['email_type']) ? $input['email_type'] : null,
            'region_id'   => isset($input['user'], $input['user']->region_id) ? $input['user']->region_id : null,
            'sent_at'     => date('Y-m-d H:i:s'),
        ];

        // Create instance
        return parent::create($data);
    }
}