<x-app-layout>
	<x-slot name="header">{{$quiz->title}}</x-slot>

	<div class="card">
		<div class="card-body row">
			<div class="col-md-4">
				@if($quiz->my_rank)
				<li class="list-group-item d-flex justify-content-between align-items-center">
						Sıralama
						<span class="badge badge-success badge-pill">{{$quiz->my_rank}} . </span>
				</li>
				@endif
				<ul class="list-group">
					@if($quiz->my_result)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Puanım
						<span class="badge badge-success badge-pill">{{$quiz->my_result->point}}</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Doğru / Yanlış Sayısı
						<span class="badge badge-danger badge-pill">{{$quiz->my_result->correct}} / {{$quiz->my_result->wrong}}</span>
					</li>
					@endif
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Soru sayısı
						<span class="badge badge-pill">{{$quiz->questions_count}}</span>
					</li>
					@if($quiz->finished_at)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Son katılım tarihi
						<span title="{{$quiz->finished_at}}" class="badge badge-pill">
							@if($quiz->finished_at< now()) Quiz Süresi Bitti @else{{$quiz->finished_at->diffForHumans()}}@endif</span>
					</li>
					@endif
					@if($quiz->details)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Katılımcı Sayısı
						<span class="badge badge-pill">{{$quiz->details['join_count']}}</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Ortalama Puan
						<span class="badge badge-pill">{{$quiz->details['average']}}</span>
					</li>
					@endif
				</ul>
				@if(count($quiz->topTen)>0)
				<div class="card mt-3">
					<div class="card-body">
						<h5 class="card-title">İlk 10</h5>
						<ul class="list-group">
							@foreach($quiz->topTen as $result)
							<li class="list-group-item" style="display: flex; align-items: center;"><strong>{{$loop->iteration}}. </strong>
								<img style="width: 13%; border-radius: 50%; margin: 0 10px;" src="{{$result->user->profile_photo_url}}">
								<span @if(auth()->user()->id==$result->user_id)class="text-success"@endif>{{$result->user->name}}
								</span> 
								- {{$result->point}} Puan </li>
								@endforeach
							</ul>
						</div>
					</div>
					@endif
				</div>
				<div class="col-md-8">
					@if($quiz->image)
					<img src="{{$quiz->image}}">
					@endif
					<p class="card-text">{{$quiz->desc}}</p>
					@if($quiz->my_result)
					<a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-success">Quizi Görüntüle</a>
					@elseif($quiz->finished_at)
						@if(!$quiz->finished_at > now())
						<a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-primary">Quize Başla</a>
						@endif
					@else
					<a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-primary">Quize Başla</a>
					@endif

				</div>	
			</div>
		</div>
	</x-app-layout>

