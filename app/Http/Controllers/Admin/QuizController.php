<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quiz;
use App\Http\Requests\QuizCreateRequest; // bunun için request oluşturmak gerekli
use App\Http\Requests\QuizUpdateRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::withCount('questions');

        if(request()->get('title')){
            $quizzes = $quizzes->where('title','LIKE','%'.request()->get('title').'%');
        }
        if(request()->get('status')){
            $quizzes = $quizzes->where('status',request()->get('status'));
        }

        $quizzes = $quizzes->paginate(5);
        return view('admin.quizzes.list',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request) //CreateQuizRequest oluşturulan request adı
    {
        Quiz::create($request->post()); //db ye veri ekleme baska bi yolu icin Laravel 8 ile Quiz Uygulaması Ders #7 28:00 dk video
       return redirect()->route('quizzes.index')->withSucces('Quiz Başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
         $quiz = Quiz::with('topTen.user','results.user')->withCount('questions')->find($id)?? abort(404,'Quiz Bulunamadı');
        return view('admin.quizzes.show',compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404,'Quiz Bulunamadı'); //$değişken = Dbismi::find($id);
        return view('admin.quizzes.edit',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404,'Quiz Bulunamadı');

        Quiz::find($id)->update($request->except(['_method','_token'])); //method ve tokeni haricindekileri güncelle demek   
        return redirect()->route('quizzes.index')->withSucces('Quiz Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id) ?? abort('404','Quiz Bulunamadı');
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSucces('Quiz Silme İşlemi başarılı');
    }
}
