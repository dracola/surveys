<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
	public $timestamps = false;
    protected $fillable = [
    	'name'
    ];

    /**
     * Users in survey
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
