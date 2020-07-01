<?php

namespace App;
 use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['title','subtitle','author','published_at','publisher','pages','description','website' ,'created_by'];

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
