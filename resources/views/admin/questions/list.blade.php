<x-app-layout>
	<x-slot name="header">Sorular</x-slot>
	<div class="card">
		<div class="card-body">
			<h6 class="card-title">
				<a href="{{route('questions.create',$quiz->id)}}" class="btn btn-sm btn btn-primary"><i class="fa fa-plus"></i>Soru ekle </a>
			<table class="table table-bordered">
				<a href="{{route('quizzes.edit',$quiz->id)}}">{{$quiz->title}}  </a>- Quizine Ait Sorular
			</h6>
				<thead>
					<tr>
						<th scope="col">Soru</th>
						<th scope="col">Fotoğraf</th>
						<th scope="col">1.Cevap</th>
						<th scope="col">2.Cevap</th>
						<th scope="col">3.Cevap</th>
						<th scope="col">4.Cevap</th>
						<th scope="col">Doğru cevap</th>
						<th scope="col" style="width: 150px;">İşlemler</th>
					</tr>
				</thead>
				<tbody>
				@foreach($quiz->questions as $question)
					<tr>
						<td scope="row">{{$question->question}}</th>
						<td><img src="{{$quiz->image}}"></td>
						<td>{{$question->answer1}}</td>
						<td>{{$question->answer2}}</td>
						<td>{{$question->answer3}}</td>
						<td>{{$question->answer4}}</td>
						<td>{{$question->correct_answer}}</td>
						<td>
							<a href="{{route('questions.edit',[$quiz->id,$question->id])}}" class="btn btn-primary"> <i class="fa fa-pen"></i> </a>
							<a href="{{route('questions.destroy',[$quiz->id,$question->id])}}" class="btn btn-danger"> <i class="fa fa-times"></i> </a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		
		</div>
	</div>

</x-app-layout>
