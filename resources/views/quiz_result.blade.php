<x-app-layout>
	<x-slot name="header">{{$quiz->title}} - Sonuçları</x-slot>

	<div class="card">
		<div class="card-body">
			<h3><strong>Puanınız: {{$quiz->my_result->point}}</strong></h3>
			<p class="card-text">
				<form method="post" action="{{route('quiz.result',$quiz->slug)}}"> 
					@csrf
					@foreach($quiz->questions as $question)
					@if($question->correct_answer == $question->my_answer->answer)
					<i class="fa fa-check text-success"></i>
					@else
					<i class="fa fa-times text-danger"></i>
					@endif
					@if($question->image)
					<img src="{{asset($question->image)}}" style="width:30%;">
					@endif
					<strong>{{$loop->iteration}}.Soru:</strong>{{$question->question}}
					<br> 
					<small>Bu soruyu katılan kişilerin %<strong>{{$question->true_percent}}</strong> 'i doğru cevapladı!</small>
					<div class="form-check mt-2">
						@if('answer1' == $question->correct_answer)
						<i class="fa fa-check text-success"></i>
						@elseif($question->my_answer->answer == 'answer1')
						<i class="far fa-circle"></i>
						@endif
						<label class="form-check-label" for="quiz{{$question->id}}1">
							{{$question->answer1}}
						</label>

					</div>
					<div class="form-check">
						@if('answer2' == $question->correct_answer)
						<i class="fa fa-check text-success"></i>
						@elseif($question->my_answer->answer == 'answer2')
						<i class="far fa-circle"></i>
						@endif
						<label class="form-check-label" for="quiz{{$question->id}}2">
							{{$question->answer2}}
						</label>
					</div>
					<div class="form-check">
						@if('answer3' == $question->correct_answer)
						<i class="fa fa-check text-success"></i>
						@elseif($question->my_answer->answer == 'answer3')
						<i class="far fa-circle"></i>
						@endif
						<label class="form-check-label" for="quiz{{$question->id}}3">
							{{$question->answer3}}
						</label>
					</div>
					<div class="form-check">
						@if('answer4' == $question->correct_answer)
						<i class="fa fa-check text-success"></i>
						@elseif($question->my_answer->answer == 'answer4')
						<i class="far fa-circle"></i>
						@endif
						<label class="form-check-label" for="quiz{{$question->id}}4">
							{{$question->answer4}}
						</label>
					</div>


					@if(!$loop->last)
					<hr>
					@endif
					@endforeach
				</form>
			</p>
		</div>
	</div>
</x-app-layout>
