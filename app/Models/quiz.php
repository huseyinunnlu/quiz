<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class quiz extends Model
{
    use HasFactory;
    protected $fillable=['title','description','finished_at','status']; //db ye veri kaydetmek icin fillable olan yerleri tabımlamamız lazım

    protected $dates=['finished_at'];

    protected $appends = ['details','my_rank'];

    public function my_result(){
        return $this->hasOne('App\Models\Result')->where('user_id',auth()->user()->id); // bunun anlamı kullanıcının o quizde verisi varmı anlamına gelir 

    }

    public function results(){
        return $this->hasMany('App\Models\Result');
    }

    public function getDetailsAttribute() {
        if($this->results()->count())
        {
        return [
            'average'=> round( $this->results()->avg('point')),
            'join_count'=>$this->results()->count(),
        ];
        }
     return null;
    
    }

    public function getFinishedAttribute($date){
    	return $date ? Carbon::parse($date) : null;
    }

    public function questions() {
    	return $this->hasMany('App\Models\Questions');
    }

    public function topTen(){
        return $this->results()->orderByDesc('point')->take(10);
    }

    public function getMyRankAttribute() {
        $rank=0;
        foreach ($this->results()->orderByDesc('point')->get() as $result){
            $rank+=1;
            if (auth()->user()->id == $result->user_id) {
                return $rank;
            }
        }
    }

    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'onUpdate' => true,
                'source' => 'title'
            ]
        ];
    }

}
	