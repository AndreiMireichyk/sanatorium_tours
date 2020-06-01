<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $guarded = [];

    public function setHash()
    {
        return $this->setAttribute('hash', base_convert($this->getAttribute('id'), 10, 36));
    }
}
