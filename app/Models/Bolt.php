<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolt extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'enabled'];

    public function Server()
    {
        return $this->belongsTo(Server::class);
    }
}
