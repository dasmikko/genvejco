<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shortlink extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i:s');
    }

   	/**
     * Get the phone record associated with the user.
     */
    public function shortlinkViews()
    {
        return $this->hasMany('App\ShortlinkView', 'shortlink_id', 'id');
    }

    public function shortlinkViewCount() {
        return $this->hasMany('App\ShortlinkView', 'shortlink_id', 'id')->selectRaw('shortlink_id ,count(*) as count')->groupBy('shortlink_id');
    }

    public function shortlinkViewsDesc()
    {
        return $this->hasMany('App\ShortlinkView', 'shortlink_id', 'id')->orderBy('shortlink_id', 'asc');
    }



    public function user() {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
