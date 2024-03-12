<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\PrimaryUuid;

class Department extends Model
{
    use HasFactory, PrimaryUuid;

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'manager_id',
        'name',
    ];

    public function scopeSearch($query, $s, $request)
    {

        return $query->where(function ($q) use ($s, $request) {
            if (!empty($s)) {
                $q->where(function ($q2) use ($s, $request) {
                    $q2->where('departments.name', 'like', '%' . $s . '%');
                    $q2->orWhere('users.name', 'like', '%' . $s . '%');
                });
            }
            if (!empty($request->name)) {
                $q->where('departments.id', $request->name);
            }
            if (!empty($request->manager)) {
                $q->where('departments.manager_id', $request->manager);
            }
        });
    }

}
