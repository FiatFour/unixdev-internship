<?php

namespace App\Models;

use App\Models\Traits\PrimaryUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyForm extends Model
{
    use HasFactory, PrimaryUuid;
    public $timestamps = true;

    public $incrementing = false;
    protected $keyType = 'string';


}
