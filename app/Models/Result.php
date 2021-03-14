<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable=['user_id','quiz_id','point','correct','wrong'];

    public function user() {
    	return $this->belongsTo('App\Models\User'); //user modeline gidip id ye göre kullanıcı bilgilerini almak için bağlantı kuruldu ve quiz e gidip baglantı kurulcak
    }
    public function quiz() {
    	return $this->belongsTo('App\Models\quiz');
	}
}
