@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="row">
                        <div class="col-8">
                            <h2>Upload image</h2>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    <h3>{{ session('success') }}</h3>
                                </div>
                            @endif

                            @if($errors->any())
                                @foreach($errors->all() as $key => $value)
                                    <div class="alert alert-danger">
                                        <h3>{{ $value }}</h3>
                                    </div>
                                @endforeach
                            @endif

                            <form action="/store" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control" placeholder="Write description">
                                </div>

                                <input type="submit" name="submit" value="submit" class="btn btn-primary">
                            </form>

                            <br>


                            @if($data)
                                @foreach($data as $key => $value)
                                    <div class="alert alert-info">
                                        <h4>Post added by: <strong> <a href="{{ route('user_profile', $value->id) }}">{{ $value->name }}</a></strong></h4>
                                        <img style="height: 150px" src="{{ asset('images/' . $value->image) }}">
                                        <br><br>
                                        <h4>Description: {{ $value->description }}</h4>
                                    </div>
                                @endforeach
                            @endif

                            {{ $data->links() }}

                        </div>

                        <div class="col-4">
                            <h2>Lorem ipsum dolor</h2>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



