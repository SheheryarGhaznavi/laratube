@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $channel->name }}</div>

                <div class="card-body">
                
                
                    {{-- Channel Update Form Start --}}
                    <form action="{{ route('channel.update',$channel->id) }}" method="post" enctype="multipart/form-data">
                        @csrf   @method('PATCH')

                        
                        {{-- Image Field Start --}}
                        <div class="from-group row justify-content-center">
                            <div onclick="document.getElementById('image').click()" class="channel-avatar">
                                <div class="channel-avatar-overlay">
                                        <img src="https://img.icons8.com/ios/64/000000/camera.png">
                                </div>
                            </div>
                        </div>
                        {{-- Hidden Input Field --}}
                        <input class="d-none" type="file" name="image" id="image">
                        {{-- Image Field End --}}

                        
                        {{-- Name Field Start --}}
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ $channel->name }}" class="form-control">
                        </div>
                        {{-- Name Field End --}}
                        

                        {{-- Description Field Start --}}
                        <div class="form-group">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea name="description" id="description" cols="3" rows="3" class="form-control">{{ $channel->description }}</textarea>
                        </div>
                        {{-- Description Field End --}}
                        

                        {{-- Submit Button Start --}}
                        <button type="submit" class="btn btn-info">Update</button>
                        {{-- Submit Button End --}}


                    </form>
                    {{-- Channel Update Form End --}}
                
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
