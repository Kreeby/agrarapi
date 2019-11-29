<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Answer extends Model {
	public $table = "answers";

    protected $fillable = ['text','id_question', 'api_token'];
    
    public function answer()
    {
    	return $this->belongsTo(Answer::class);
    }
    public function lists()
    {
    	return $this->hasMany(Lists::class);
    }
}