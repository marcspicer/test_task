<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    public function userData($data)
{
        $this->description = $data['description'];
        $this->file = $data['file'];
        $this->user_id = $data['user_id'];
        $this->save();
        return 1;
}
}
