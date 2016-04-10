
<!-- this is just for testing -->
<link href="{{ elixir('css/app.css') }}" rel="stylesheet">
<!-- this is just for testing -->

<?php $images = $album->images()->get(); ?>

<div class="AlbumPreview">
    <!--
    <div class="AlbumPreview__links">
        <i class="fa fa-camera-retro"></i>
        <a href="{{ url('/album', $album->id) }}">View Album ({{ $images->count() }})</a>
    </div> 
    -->
    <div class="AlbumPreview__content">
        @for($i = 0; $i < $maxImages and $i < $images->count(); $i++)
            <div class="AlbumPreview__thumb" 
                 title="{{ $images->get($i)->description }}">
                <a href="{{ $images->get($i)->getPath() }}"
                   data-lightbox="{{ $album->id }}"
                   data-title="{{ $images->get($i)->description }}">
                    <img src="{{ $images->get($i)->getThumbPath() }}">
                </a>
            </div>
        @endfor
    </div>
</div>

<!-- this is just for testing -->
<script src="{{ elixir('js/bundle.js') }}"></script>
<!-- this is just for testing -->
