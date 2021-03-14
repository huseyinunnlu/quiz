<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\quiz;
use App\Models\answer;
use App\Models\Result;
use App\Models\questions;

class MainController extends Controller
{
	public function dashboard() {
		 $quizzes = Quiz::where('status','publish')->where(function($query){
		 	$query->whereNull('finished_at')->orWhere('finished_at','>',now());
		 })->withCount('questions')->paginate(5);
		 $results = auth()->user()->result;
		return view('dashboard',compact('quizzes','results'));
	}    

	public function quiz_detail($slug) {
	    $quiz = Quiz::whereSlug($slug)->with('my_result','results','topTen.user')->withCount('questions')->first() ?? abort(404,'Quiz Bulunamadı'); // my resulttu result model de tanımladık
		return view('quiz_detail',compact('quiz'));
		// topTen.user kullanma amacı top ten deki user id leri ile users tablosundan veri çekildi 
	}



	public function quiz_join($slug) {
		$quiz = Quiz::whereSlug($slug)->with('questions.my_answer','my_result')->first() ?? abort(404,'Quiz Bulunamadı');
		if($quiz->my_result){
			return view('quiz_result',compact('quiz'));
		}
		return view('quiz',compact('quiz'));
	}



	public function result(Request $request,$slug) {
		$quiz = Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404,'Quiz Bulunamadı');
		$correct = 0;

		if($quiz->my_result){
			return abort(404,'Bu Quize daha önce katıldınız');
		}

		foreach ($quiz->questions as $question) {
			
			Answer::create([
				'user_id'=>auth()->user()->id,
				'questions_id'=>$question->id,
				'answer'=>$request->post($question->id),
			]);

			if($question->correct_answer===$request->post($question->id)){
				$correct+=1;
			}
		}

		$point = round( (100 / count($quiz->questions)) * $correct);
		$wrong = count($quiz->questions) - $correct;

		Result::create([
			'user_id'=>auth()->user()->id,
			'quiz_id'=>$quiz->id,
			'point'=>$point,
			'correct'=>$correct,
			'wrong'=>$wrong,
		]);
		return redirect()->route('quiz.detail',$quiz->slug)->withSuccess("Başarıyla Quizi Bitirdin puanın: ".$point);
	}
}
