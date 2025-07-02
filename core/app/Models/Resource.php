<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'role',
        'experience',
        'monthly_salary',
        'hourly_salary',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}