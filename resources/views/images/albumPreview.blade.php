
<?php $images = $album->images()->get(); ?>

<div class="AlbumPreview">
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

