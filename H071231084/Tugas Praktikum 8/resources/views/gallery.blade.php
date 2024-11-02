@extends('layouts.main')

@section('content')
<div class="gallery" id="gallery">
        <h2>Gallery</h2>
        <div class="video-container">
            <x-video-wrapper src="videos/1.mov"> </x-video-wrapper>
            <x-video-wrapper src="videos/2.mov"> </x-video-wrapper>
            <x-video-wrapper src="videos/3.mov"> </x-video-wrapper>
            <x-video-wrapper src="videos/4.mov"> </x-video-wrapper>
            <x-video-wrapper src="videos/5.mov"> </x-video-wrapper>
            <x-video-wrapper src="videos/6.mov"> </x-video-wrapper>
        </div>
    </div>
@endsection