@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ $channel->name }}
                    <a href="{{ route('video.index',$channel->id) }}">Upload Videos</a>
                </div>

                <div class="card-body">
                
                
                    @if($channel->editable())
                        {{-- Channel Update Form Start --}}
                        <form action="{{ route('channel.update',$channel->id) }}" method="post" enctype="multipart/form-data">
                            @csrf   @method('PATCH')


                            {{-- Image Field Start --}}
                            <div class="from-group row justify-content-center">
                                <div class="channel-avatar">

                                    <div onclick="document.getElementById('image').click()" class="channel-avatar-overlay">
                                        <img src="https://img.icons8.com/ios/64/000000/camera.png">
                                    </div>

                                    <img src="{{ $channel->image() }}">
                                </div>
                            </div>

                            {{-- Subscribe Button --}}
                            @include('subscriptions.subscribe-button')
                            {{-- Subscribe Button --}}

                            {{-- Hidden Input Field --}}
                            <input class="d-none" type="file" name="image" id="image">
                            {{-- Hidden Input Field --}}
                            
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
                    @else
                        <div class="from-group row justify-content-center">
                            <div class="channel-avatar">
                                <img src="{{ $channel->image() }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="text-center">{{ $channel->name }}</h4>
                            <p class="text-center">{{ $channel->description }}</p>
                        </div>
                        
                        {{-- Subscribe Button --}}
                        <div class="text-center">
                            <subscribe-button :channel="{{ $channel }}" :initial-subscription="{{ $channel->subscription }}" />
                        </div>
                        {{-- Subscribe Button --}}

                    @endif
                
                
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Videos
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($videos as $key => $video)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{ $video->thumbnail }}" width="40px" height="40ox" alt="" srcset="">
                                    </td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->view }}</td>
                                    <td>{{ $video->percentage == 100 ? 'Live' : 'Processing' }}</td>
                                    <td>
                                        @if ($video->percentage === 100)
                                            <a target="blank" href="/video/{{$video->id}}" class="btn btn-sm btn-info">View</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <div class="row justify-content-center">
                            {{ $videos->links() }}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
