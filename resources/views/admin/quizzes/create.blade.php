<x-app-layout>
	<x-slot name="header">Quiz Oluştur</x-slot>
	<div class="card">
		<div class="card-body">
			<form action="{{route('quizzes.store')}}" method="post">
				@csrf
				<div class="form-group">
					<label>Quiz Başlığı</label>
					<input type="text" name="title" class="form-control" value="{{old('title')}}">
				</div>
				<div class="form-group">
					<label>Quiz Açıklama</label>
					<textarea name="desc" class="form-control" rows="4">{{old('desc')}}</textarea>
				</div>
				<div class="form-group">
					<input id="isFinished" @if(old('finished_at')) checked @endif type="checkbox">
					<label>Bitiş tarihi olacak mı </label>
				</div>
				<div id="finishedInput" class="form-group" @if(!old('finished_at')) style="display: none;"@endif >
					<label>Bitiş tarihi</label>
					<input type="datetime-local" name="finished_at" value="{{old('finished_at')}}" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-sm">Oluştur</button>
				</div>
			</form>
		</div>
	</div>
	<x-slot name="js">
		<script>
			$('#isFinished').change(function(){
				if($('#isFinished').is(':checked')){
					$('#finishedInput').show();
				}else{
					$('#finishedInput').hide();	
				}
			})
		</script>
	</x-slot>
</x-app-layout>	