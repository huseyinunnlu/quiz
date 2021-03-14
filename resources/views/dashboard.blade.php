<x-app-layout>
	<x-slot name="header">Anasayfa</x-slot>

	<div class="row">
		<div class="col-md-8">
			<div class="list-group">
				@foreach($quizzes as $quiz)
				<a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">{{$quiz->title}}</h5>
						<small>@if($quiz->finished_at) {{$quiz->finished_at->diffForHumans()}} <br> Bitecek @else @endif</small>
					</div>
					<p class="mb-1">{{Str::limit($quiz->desc,100)}}</p>
					<small>{{$quiz->questions_count}} Tane Soru</small>
				</a>
				@endforeach
				<div style="margin: 15px 0;">
					{{$quizzes->links()}}
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					Quiz Sonuçları
				</div>
				<ul class="list-group list-group-flush">
					@foreach($results as $result)

					<li class="list-group-item"><a href="{{route('quiz.detail',$quiz->slug)}}">{{$result->quiz->title}}</a> <br> <strong>{{$result->point}}</strong> Puan</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</x-app-layout>

