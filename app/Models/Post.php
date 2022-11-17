<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'post_title',
        'post_body',
        'featured_image',
        'status',
        'category_id',
        'user_id',
    ];
    protected static $logFillable = true;
    protected static $logName = 'post';
    protected static $logOnlyDirty = true;

    public function setStatusAttribute($status)
    {
        $this->attributes['status'] = ($status) ? 1 : 0;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
