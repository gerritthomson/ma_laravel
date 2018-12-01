@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Submit a link</h1>
            <form action="/submit" method="post">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                    <label for="artist">Artist</label>
                    <input type="text" class="form-control" id="artist" name="artist" placeholder="ARTIST" value="{{ old('artist') }}">
                    @if($errors->has('artist'))
                        <span class="help-block">{{ $errors->first('artist') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                    <label for="key">key</label>
                    <textarea class="form-control" id="key" name="key" placeholder="key">{{ old('key') }}</textarea>
                    @if($errors->has('key'))
                        <span class="help-block">{{ $errors->first('key') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection