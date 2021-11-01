<?php

namespace Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class SurveyResponse extends Eloquent
{
    
    protected $table = 'survey_responses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'branch_id',
        'survey_mode_id',
        'api_version',
        'social_type_id',
        'social_review_id',
        'survey_type_id',
        'visit_datetime',
        'social_score',
        'social_raw_score',
        'status'
    ];
    
    
    // appends formatted date with response
    public $appends = ['formatted_visit_date'];
    
    /**
     * @return string
     *
     * format visit datetime to d-m-y
     */
    public function getFormattedVisitDateAttribute()
    {
        return Carbon::parse($this->visit_datetime)->format('d-m-y');
    }
    
    /**
     * @return mixed
     *
     * scope to return reviews with tripadvisor reviews
     */
    public function scopeWithTripAdvisorCount()
    {
        return $this->whereHas('socialType', function ($q) {
            $q->where('name', 'TripAdvisor')->count();
        });
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * review belongsto a company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * review belongsto a branch
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * review belongsto a socialtype
     */
    public function socialType()
    {
        return $this->belongsTo(SocialType::class);
    }
}
