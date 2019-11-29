<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Forum extends Model {
	public $table = "questions";

    protected $fillable = ['name','text', 'token', 'added_by', 'category', 'added_to'];
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function lists()
    {
    	return $this->hasMany(Lists::class);
    }
}