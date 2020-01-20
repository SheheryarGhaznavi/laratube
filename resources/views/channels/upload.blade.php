@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <upload-video inline-template :channel="{{ $channel }}">
            <div class="col-md-8">
                <div class="card p-3 d-flex justify-content-center align-items-center" v-if=!selected>

                    {{-- Hidden Input Field --}}
                    <input type="file" class="d-none" multiple ref="video" id="video" @change="upload">
                    {{-- Hidden Input Field --}}

                    <a onclick="document.getElementById('video').click()"><i style="color:red; font-size:70px" class="fa fa-youtube-play"></i></a>
                    <p class="text-center">Upload Videos</p>
                </div>

                <div class="card p-3" v-else>
                    <div class="my-4">
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress bar animated" role="progressbar" style="width:50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center align-items-center" style="height:180px;color:white;font-size:18px;background:#808080">
                                    Loading Thumbnail .....
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    My Awesome Video
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </upload-video>
    </div>
@endsection