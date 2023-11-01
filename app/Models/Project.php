<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'city',
    'county',
    'parish',
    'village',
    'street',
    'house',
    'apartment',
    'due_date',
    'status',
  ];

  protected $casts = [
    'status' => StatusEnum::class
  ];

  public function users()
  {
    return $this->belongsToMany(User::class, 'users_projects', 'project_id', 'user_id');
  }
}
