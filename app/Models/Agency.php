<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    public const ACTIVE = 1;

    public const INACTIVE = 2;

    public const BASE_REF_URL = "/register?aff_code=";

    protected $table = 'agencies';

    protected $appends = ['ref_link'];

    protected $hidden = [
        'password', 
    ];

    public function getRefLinkAttribute()
    {
        return env('DOMAIN') . self::BASE_REF_URL . $this->code;
    }
}
