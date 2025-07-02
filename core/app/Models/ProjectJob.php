<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_name',
        'project_desc',
    ];
    protected $table = 'project_job';

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
