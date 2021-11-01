<?php

use Models\SurveyResponse;

require "bootstrap.php";
require "helpers.php";
/**
 * Reviews with companies, branches, socialtypes, where company status =1
 * and branch status =1 and brand_site = 0
 */
$reviews = SurveyResponse::with('company:id,name,status', 'branch:id,company_id,name,status,brand_site',
    'socialType:id,name')
    ->whereHas('company', function ($q) {
        $q->where('status', 1);
    })->whereHas('branch', function ($q) {
        $q->where('status', 1)->where('brand_site', 0);
    })
    ->get()->toArray();

/**
 * all Tripadvisor reviews
 */
$tripAdvisorReviews = SurveyResponse::whereHas('socialType', function ($q) {
    $q->where('name', 'TripAdvisor');
})->count();

/**
 * all facebook reviews
 */
$facebookReviews = SurveyResponse::whereHas('socialType', function ($q) {
    $q->where('name', 'Facebook');
})->count();

/**
 * all google reviews
 */
$googleReviews = SurveyResponse::whereHas('socialType', function ($q) {
    $q->where('name', 'Google');
})->count();


/**
 * all google reviews orderedby branch name
 */
$googleReviews = SurveyResponse::with([
    'branch' => function ($q) {
        $q->orderBy('name', 'asc');
    }
])->whereHas('socialType', function ($q) {
    $q->where('name', 'Google');
})->get();


/**
 * all google reviews orderedby visit_datetime.
 */
$googleReviews = SurveyResponse::
whereHas('socialType', function ($q) {
    $q->where('name', 'Google');
})->orderBy('visit_datetime', 'asc')->get();


echo 'tripAdvisorReviews:'.$tripAdvisorReviews;
echo 'facebookReviews:'.$facebookReviews;
echo 'googleReviews:'.$googleReviews;
