<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'featured_image',
        'status',
        'barcode',
        'quantity',
        'price',
        'cost',
        'category_id',
        'supplier_id',
        'added_by',
    ];

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
        return $this->belongsTo(User::class,'added_by');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
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
