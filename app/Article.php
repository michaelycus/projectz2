<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $fillable = array('title', 'source_url', 'project_url', 'publish_url', 'user_id', 'status');

	public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function actions()
    {
        return $this->morphMany('App\Action', 'actionable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeUnpublished($query)
    {
        $query->where('status', '!=', ARTICLE_STATUS_PUBLISHED);
    }

    public function scopePublished($query)
    {
        $query->where('status', '=', ARTICLE_STATUS_PUBLISHED);
    }

}