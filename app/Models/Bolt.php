<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolt extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'enabled', 'customer_id'];

    public function Server()
    {
        return $this->belongsTo(Server::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
