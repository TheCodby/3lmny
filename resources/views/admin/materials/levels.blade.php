<div class="modal fade" id="showLevels" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Levels</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="card-header">Add level</div>
                    <div class="card-body">
                        <form action="{{route('admin.levels.add')}}" method='POST'>
                            @csrf
                            <div class='form-group row align-items-center' >
                                <div class="col-8"><input type="text" name='name' placeholder='Level name' id='subject' class="form-control"></div>
                                <div class="col-4"><button type='submit' class="btn btn-primary float-end">Add</button></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($levels as $level)
                                <tr>
                                    <th scope="row">{{$level->id}}</th>
                                    <td>{{$level->name}}</td>
                                    <td>{{$level->created_at}}</td>
                                    <td>{{$level->updated_at}}</td>
                                    <td><a href='{{route("admin.levels.delete", $level->id)}}' class='btn btn-outline-danger'>Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>					
</div>
<script>
	$(document).ready( function() {
		$('#keywords2').tagsInput();
	});
</script>
