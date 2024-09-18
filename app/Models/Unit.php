<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'updated_by',
        'created_by',
    ];

    /**
     * Get the users for the unit.
     */
    public function users() {
        return $this->hasMany(User::class);
    }
}
