<?php

namespace App;

// use App\Models\ModelBinding as Model;
use Illuminate\Database\Eloquent\Model;

class SyncToken extends Model
{
    protected $table = 'synctoken';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'timestamp',
    ];
}
