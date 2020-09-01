<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 'crm', 'phone', 'specialties'
    ];

    protected $visible = [
        'id', 'name', 'crm', 'phone', 'specialties'
    ];

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function toArray()
    {
        $this->load('specialties');
        return parent::toArray();
    }
}
