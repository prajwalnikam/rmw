<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'budget', 'deadline'];

    public function jobRequirements()
    {
        return $this->hasMany(JobRequirement::class);
    }
}