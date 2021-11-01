<?php

namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Branch extends Eloquent
{
    protected $table = 'branches';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'name',
        'brand_site',
        'status'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * a branch belongsTo a company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
