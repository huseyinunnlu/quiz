<x-app-layout>
	<x-slot name="header">{{$quiz->title}}</x-slot>

	<div class="card">
		<div class="card-body row">
			<div class="col-md-4">
				<ul class="list-group">
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


						<table class="table table-bordered mt-3">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Ad Soyad</th>
									<th scope="col">Puan</th>
									<th scope="col">Doğru</th>
									<th scope="col">Yanlış</th>
									<th scope="col">İşlemler</th>
								</tr>
							</thead>
							<tbody>
								@foreach($quiz->results as $result)
								<tr>
									<th scope="row">{{$loop->iteration}}</th>
									<td>{{$result->user->name}}</td>
									<td>{{$result->point}}</td>
									<td>{{$result->correct}}</td>
									<td>{{$result->wrong}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>



					</div>	
				</div>
			</div>
		</x-app-layout>

