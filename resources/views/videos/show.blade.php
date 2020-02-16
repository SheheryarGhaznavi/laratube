@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if ($video->editable())
                    <form action="" method="post">
                        @csrf @method('PATCH')
                @endif

                    <div class="card-header">{{$video->title}}</div>

                    <div class="card-body">
                        
                        <video-js id="my-video" class="vjs-default-skin" controls preload="auto" width="640" height="268">
                            <source src='{{ asset(Storage::url("videos/$video->id/$video->id.m3u8")) }}' type="application/x-mpegURL">
                        </video-js>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mt-3">
                                    
                                @if ($video->editable())
                                    <input type="text" name="title" value="{{ $video->title }}" class="form-control">
                                @else
                                    {{ $video->title }}
                                @endif
                                
                                </h4>
                                {{ $video->view }} {{ str_plural('view',$video->view) }}
                            </div>

                            <vote :default_vote='{{ $video->vote }}' entity_id="{{ $video->id }}" entity_owner="{{ $video->channel->user_id }}"> </vote>
                        </div>

                        <hr>

                        <div>
                            @if ($video->editable())
                                <textarea name="description" cols="3" rows="3" class="form-control">{{ $video->description }}</textarea>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-info btn-sm" type="submit">Update</button>
                                </div>

                            @else
                                {{ $video->description }}
                            @endif
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <div class="media">
                                <img src="https://picsum.photos/id/42/200/200" width="50" height="50" alt="" class="rounded-circle mr-3" >
                                <div class="media-body ml-2">
                                    <h5 class="mt-0 mb-0">{{ $video->channel->name }}</h5>
                                    <span class="small">Published on {{ $video->created_at->toFormattedDateString() }} </span>
                                </div>
                            </div>
                            <subscribe-button :channel="{{ $video->channel }}" :initial-subscription="{{ $video->channel->subscription }}" />
                        </div>

                    </div>

                @if ($video->editable())
                    </form>
                @endif

            </div>

            <comment :video='{{ $video }}' ></comment>
        </div>
    </div>
</div>
@endsection


@section('styles')
    <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" />

    <style>
        .thumbs-up-active, .thumbs-down-active {
            color: green
        }

        .w-full {
            width: 100% !important
        }

        .w-80 {
            width: 80% !important
        }
    </style>
@endsection


@section('scripts')
    <script src="https://vjs.zencdn.net/7.5.4/video.js"></script>

    <script>
        window.current_video = '{{ $video->id }}'
    </script>

    <script src="{{ asset('js/player.js') }}"></script>
@endsection