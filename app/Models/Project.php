<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cost;
use App\Models\Problem;
use App\Models\ClientRequest;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'city',
    'county',
    'parish',
    'village',
    'street',
    'house',
    'apartment',
    'client_name',
    'client_email'
  ];

  public function users()
  {
    return $this->belongsToMany(User::class, 'users_projects', 'project_id', 'user_id');
  }

  public function costs(){
    return $this->hasMany(Cost::class);
  }

  public function problems(){
    return $this->hasMany(Problem::class);
  }

  public function client_request(){
    return $this->hasOne(ClientRequest::class);
  }
}
