@extends('templates.layout')

@section('title', $material->subject)

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-avatar@1.0.3/dist/avatar.min.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            @if(session()->has('message'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <div>
                {{ session()->get('message') }}
                </div>
            </div>
            @endif
            @if(!$errors->isEmpty())
			<div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
			  <div>
				@foreach ($errors->all() as $error)
					<div>{{ $error }}</div>
				@endforeach
			  </div>
			</div>
			@endif
            <div class="col-md-4 mb-3 order-md-2">
                <img src="{{asset('images/materials/1.jpeg')}}" class="img-fluid hoverimage" style='border-radius:30px;'>
            </div>
            <div class="col-md-8 mb-3 order-md-1">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title">{{$material->subject}}</h2>
                        @php
                            @$keywords = json_decode($material->keywords)
                        @endphp
                        @foreach ($keywords as $keyword)
                            <p class="badge rounded-pill bg-primary mb-0 fs-6">{{$keyword}}</p>
                        @endforeach
                        <p class='mt-2'>{{$material->description}}</p>
                        <div class='d-flex justify-content-between'>
                            <div class="rating" style='align-self: center;'>
                                <i class="rating__star far fa-star"></i>
                                <i class="rating__star far fa-star"></i>
                                <i class="rating__star far fa-star"></i>
                                <i class="rating__star far fa-star"></i>
                                <i class="rating__star far fa-star"></i>
                            </div>
                            <a href="{{$material->url}}" class="btn btn-primary float-end"><i class="fas fa-box-open"></i> Open</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8">
                @if(!$comments->isEmpty())
                    <h3>Comments</h3>
                @endif
                @foreach($comments as $comment)
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <div class='row justify-content-between'>
                                <div class="col-4">
                                    <div class='d-flex'>
                                        <img src="{{asset('images/users/default.png')}}" class='avatar avatar-32 bg-light rounded-circle text-white top-0'>
                                        <h5 class="mx-2 card-title">{{$comment->user->username}}<p class="card-text text-muted fs-6">{{$comment->created}}</p></h5>
                                    </div>
                                </div>
                                @if(Auth::user())
                                    <div class="col-4 d-flex justify-content-end">
                                        <a href='#' class='ms-2' title="Report User"><i class="fas fa-flag"></i></a>
                                        @if(Auth::user()->user_type == '2' || Auth::user()->id == $comment->u_id)
                                        <a class='ms-2' href='{{route("materials.commend.delete", ["id" => $comment->m_id, "commentID" => $comment->id])}}' title="Delete Comment"><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                        @if(Auth::user()->user_type == '2')
                                            <a href='#' class='ms-2' title="Ban User"><i class="fas fa-user-slash"></i></a>
                                            <a href='#' class='ms-2' title="Warn User"><i class="fas fa-exclamation-triangle"></i></a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <p class="card-text">{{$comment->comment}}</p>
                        </div>
                    </div>
                @endforeach
                @auth
                    <h3>Add Your Comment</h3>
                    <form method='POST' action='{{route("materials.commend.add", $material->id)}}'>
                        @csrf
                        <div class="form-floating">
                            <textarea class="form-control shadow" name='comment' placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px;resize: none;border-radius:30px;background-color:#fff"></textarea>
                            <label for="floatingTextarea2">Leave a comment here</label>
                        </div>
                        <div class='d-flex justify-content-center'><button type='submit' class="btn btn-primary mt-2"><i class="fas fa-comment-dots"></i> Add Comment</a></div>
                    </form>
                @endauth
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const ratingStars = [...document.getElementsByClassName("rating__star")];
        let i2 = 0;
        for (i2; i2 < {{$rate}}; i2++)
        {
            ratingStars[i2].className = "rating__star fas fa-star";
        }
        function executeRating(stars) {
            const starClassActive = "rating__star fas fa-star";
            const starClassInactive = "rating__star far fa-star";
            const starsLength = stars.length;
            let i;
            stars.map((star) => {
                star.onclick = () => {
                    let active = 0;
                    i = stars.indexOf(star);
                    if (star.className===starClassInactive) {
                        for (i; i >= 0; --i)
                        {
                            stars[i].className = starClassActive;
                            active++;
                        }
                    } else {
                        for (i; i < starsLength; ++i) stars[i].className = starClassInactive;
                    }
                    console.log(active)
                    request = $.ajax({
                        url: "{{route('materials.rate', $material->id)}}",
                        type: "post",
                        data: {"rate": active},
                    });
                };
            });
        }
        executeRating(ratingStars);
    </script>
@endsection