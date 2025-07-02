<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequirement extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'description', 'budget', 'deadline'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}