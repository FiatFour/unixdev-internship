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


    protected $fillable = [
        'id',
        'name',
    ];

    public function scopeSearch($query, $s, $request)
    {
        return $query->where(function ($q) use ($s, $request) {
            if (!empty($s)) {
                $q->where(function ($q2) use ($s, $request) {
                    $q2->where('departments.name', 'like', '%' . $s . '%');
                    $q2->orWhere('survey_forms.name', 'like', '%' . $s . '%');
                });
            }
            if (!empty($request->name)) {
                $q->where('departments.id', $request->name);
            }
            if (!empty($request->search)) {
                $q->where('survey_forms.name', 'like', '%' . $request->search . '%');
            }
        });
    }
}
