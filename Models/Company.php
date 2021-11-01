<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Eloquent;


class Company extends Eloquent
{
    protected $table = 'companies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'key_name',
        'status'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     * a company has many branches
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
