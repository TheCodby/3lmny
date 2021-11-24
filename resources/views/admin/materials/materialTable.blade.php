<div class="table-scrollable">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Subject</th>
				<th scope="col">Keywords</th>
				@if(isset($materialRequest))
					<th scope="col">Requested By</th>
				@endif
				<th scope="col">Created At</th>
				<th scope="col">Updated At</th>
				<th scope="col">Show</th>
				@if(!isset($materialRequest))
					<th scope="col">Edit</th>
				@endif
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($materials as $material)
				<tr>
					<th scope="row">{{$material->id}}</th>
					<td>{{$material->subject}}</td>
					@php
						@$keywords = explode(",", $material->keywords)
					@endphp
					<td>
					@foreach ($keywords as $keyword)
						<span class="badge rounded-pill bg-primary">{{$keyword}}</span>
					@endforeach
					</td>
					@if(isset($materialRequest))
						<td>{{$material->user->username}}</td>
					@endif
					<td>{{$material->created_at}}</td>
					<td>{{$material->updated_at}}</td>
					@if(isset($materialRequest))
						<td><a href='{{route("material.request", $material->id)}}' class='btn btn-outline-primary'>Show</a></td>
						<td><a href='{{route("material.request.delete", $material->id)}}' class='btn btn-outline-danger'>Delete</a></td>
					@else
						<td><a href='{{route("materials.show", $material->id)}}' class='btn btn-outline-primary'>Show</a></td>
						<td><a href='{{route("admin.materials.edit", $material->id)}}' class='btn btn-outline-success'>Edit</a></td>
						<td><a href='{{route("admin.materials.delete", $material->id)}}' class='btn btn-outline-danger'>Delete</a></td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $materials->links() }}
</div>
<script>
    @if(isset($search))
        var isSearch = true
    @else
        var isSearch = false
    @endif
</script>