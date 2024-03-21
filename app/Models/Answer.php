<?php

namespace App\Models;

use App\Models\Traits\PrimaryUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory, PrimaryUuid;

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

}
