<div class="table-scrollable">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Username</th>
				<th scope="col">E-mail</th>
				<th scope="col">Registered At</th>
				<th scope="col">Show</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<th scope="row">{{$user->id}}</th>
					<td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
					<td>{{$user->created_at}}</td>
					<td><a href='#' class='btn btn-outline-primary'>Show</a></td>
					<td><a href='#' class='btn btn-outline-success'>Edit</a></td>
					<td><a href='#' class='btn btn-outline-danger'>Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $users->links() }}
</div>
<script>
    @if(isset($search))
        var isSearchUser = true
    @else
        var isSearchUser = false
    @endif
</script>