<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'added_by',
    ];


    public function products()
    {
        return $this->hasMany(Product::class,'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(class_basename($this))
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->logFillable()
            ->logOnlyDirty();
    }
}
