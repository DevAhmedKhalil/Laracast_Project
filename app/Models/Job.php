<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @method static first()
 * @property mixed $id
 * @property mixed $employer
 * @property mixed $title
 */
class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

//    protected $fillable = ['employer_id', 'title', 'salary'];
    protected $guarded = []; # this means don't guard anything

    public function employer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        # this = Job
        return $this->belongsTo(Employer::class);
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
}
