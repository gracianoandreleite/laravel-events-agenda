<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function subscribers() {
        return $this->belongsToMany('App\Models\User');
    }
    public function isFull() {
        return $this->subscribers->count() >= $this->available_slots;
    }
    public function hasPassed() {
        return strtotime($this->date . ' ' . $this->time) <= time();
    }
}
