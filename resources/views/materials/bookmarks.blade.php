@extends('templates.layout')

@section('title', __('titles.bookmarks'))

@section('content')
	<div class='container'>
		<div class="row justify-content-center">
			<div class="col-sm-8">
				@foreach ($bookmarks as $material)
					<div class="row mb-3">
						<div class="col-sm-12 mx-auto">
							<div class="card shadow card-hover custom-card">
							<img src="{{asset('storage/uploads/materials/'.$material->path) ?? ''}}" class="img-fluid card-img">
								<div class="card-body">
									<div class='ms-2'>
									<h5 class="card-title mb-0">{{$material->subject}}</h5>
									@php
										@$keywords = explode(",", $material->keywords)
									@endphp
									@foreach ($keywords as $keyword)
										<p class="badge rounded-pill bg-primary mb-0">{{$keyword}}</p>
									@endforeach
									<p class='mb-0'>Type: {{$material->typeRow->name ?? 'None'}}</p>
									<p class='mb-0'>Level: {{$material->levelRow->name ?? 'None'}}</p>
									<p class="card-text mb-0 fs-6">{{mb_substr($material->description, 0, 50, 'utf-8')}}</p>
									<p class="card-text mb-0"><small class="text-muted">Last Updated {{$material->updated}}</small></p>
									<a href="{{route('materials.show', $material->id)}}" class="stretched-link mb-0"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				<div class="row mb-3">
					{{ $bookmarks->links() }}
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready( function() {
			var keywords = [];
			$('#keywords').tagsInput();
			$('#keywords').tagsInput({
				'onAddTag': function(input, value) {
					console.log('tag added', input, value);
				},
				'onRemoveTag': function(input, value) {
					console.log('tag removed', input, value);
				},
				'onChange': function(input, value) {
					console.log('change triggered', input, value);
				}
			});
		});
	</script>
@endsection