<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoCardFieldMap extends Model
{
    protected $table = 'photocard_field_maps';

    protected $fillable = [
        'photocard_template_id',
        'field_key',
        'source_type',
        'source_value',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(PhotoCardTemplate::class, 'photocard_template_id');
    }
}
