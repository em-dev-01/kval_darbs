<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
      'task_title',
      'unit',
      'amount',
      'task_cost_per_unit',
      'material_cost_per_unit',
    ];

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
