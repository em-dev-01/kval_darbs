<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'address',
    'due_date',
    'status',
  ];

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
