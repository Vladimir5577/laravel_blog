@extends('layouts.app')


@section('content')

	<div class="container">

		<div class="row">
			<div class="col-8">

				<h1>User Profile</h1>
				<div class="alert alert-info">
					<h4>Auth User id: {{ Auth::user()->id }}. Name: {{ Auth::user()->name }}</h4>
					<p>Id: {{ $data[0]->id }}</p>
					<img src="{{ asset('images/' . $data[0]->photo) }}" style="height: 170px;">
					<h2>Name: <strong>{{ $data[0]->name }}</strong> </h2>
					<h2>Email: <strong>{{ $data[0]->email }}</strong></h2>
					<h4>Rating: <strong>{{ $rating }}</strong></h4>
				</div>

				@if(Auth::user()->id == $data[0]->id)
					<form action="{{ route('upload_user_photo') }}" method="post"  enctype="multipart/form-data">
						@csrf
					  <div class="form-group">
					    <label for="exampleFormControlFile1">Update a photo</label>
					    <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
					  </div>
					  <input type="submit" name="submit" value="Update photo" class="btn btn-primary">
					</form>
				@endif

				<br>

				<div>
					<h4>Comment section.</h4>

					@if($errors->any())
						@foreach($errors->all() as $key => $value)
							<div class="alert alert-danger">
								<h3>{{ $value }}</h3>
							</div>
						@endforeach
					@endif

					@if(session('success'))
						<div class="alert alert-success">
							<h3>{{ session('success') }}</h3>
						</div>
					@endif

					@if(Auth::user()->id !== $data[0]->id)
						<form action="{{ route('add_comment') }}" method="post">
							@csrf
							<input type="hidden" name="user_author" value="{{ Auth::user()->id }}">
							<input type="hidden" name="user_recipient_comment" value="{{ $data[0]->id }}">
							<div class="form-group">
							    <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							 </div>
							<input type="submit" name="submit" value="Comment" class="btn btn-success">
						</form>

						<br><br>
                    @if(!$check_rate)
						<!-- Rating section -->
						<h3>Rating section</h3>


                            <form action="{{ route('rate_user') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_author" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="user_recipient_rate" value="{{ $data[0]->id }}">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="1">
                                  <label class="form-check-label" for="inlineRadio1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="rate" id="inlineRadio2" value="2">
                                  <label class="form-check-label" for="inlineRadio2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="rate" id="inlineRadio3" value="3">
                                  <label class="form-check-label" for="inlineRadio1">3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="rate" id="inlineRadio4" value="4">
                                  <label class="form-check-label" for="inlineRadio1">4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="rate" id="inlineRadio5" value="5">
                                  <label class="form-check-label" for="inlineRadio1">5</label>
                                </div>
                                <input type="submit" name="submit_rate" value="Rate" class="btn btn-success">
                            </form>
                        @endif

					@endif

				</div>

				<br><br>

				<h3>Comments</h3>
				@foreach($comment as $key => $value)
					<div class="alert alert-info">
						<h3>{{ $value->comment }}</h3>
						<p>Wrotten by: {{ $value->name }}</p>
					</div>
				@endforeach

			</div><!-- col-8 -->



			<div class="col-4">
				<h2>Duis aute irure dolor</h2>
				<p>
					 sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div>
		</div>

	</div>

@endsection
