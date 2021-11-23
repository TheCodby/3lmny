@foreach ($contacts as $contact)
	<div class="modal fade" id="showContact{{$contact->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			  	<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">{{$contact->subject}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  	</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<dl>
								<dt>Name</dt>
								<dd>{{$contact->name}}</dd>
							</dl>
						</div>
						<div class="col-md-6">
							<dl>
								<dt>Subject</dt>
								<dd>{{$contact->subject}}</dd>
							</dl>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<dl>
								<dt>Email</dt>
								<dd>{{$contact->email}}</dd>
							</dl>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<dl>
								<dt>Message</dt>
								<dd>{{$contact->message}}</dd>
							</dl>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endforeach
<div class="table-scrollable">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Subject</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
				<th scope="col">Sent At</th>
                <th scope="col">Status</th>
				<th scope="col">Show</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($contacts as $contact)
				<tr>
					<th scope="row">{{$contact->id}}</th>
					<td>{{$contact->subject}}</td>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->email}}</td>
					<td>{{$contact->created_at}}</td>
                    <td style='font-size:26px'>@if($contact->admin_read == 0) <i class="fas fa-envelope" style='color:#008000' title='unread'></i> @else <i class="fas fa-envelope-open" style='color:#808080' title='read'></i> @endif</td>
					<td><button type='button' onclick='read({{$contact->id}})' class='btn btn-outline-Primary btn-md' data-bs-toggle="modal" data-bs-target="#showContact{{$contact->id}}">Show</button></td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $contacts->links() }}
</div>
<script>
	function read(id)
	{
		request = $.ajax({
			url: `/Admin/Contacts/${id}/Read`,
			type: "post",
		})
	}
</script>