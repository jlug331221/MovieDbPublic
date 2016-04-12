/**
 * Created by jmd-m on 4/8/2016.
 */

/*jshint esversion: 6 */

(function ($) {

    $.fn.albumloader = function (options) {

        var settings = $.extend({
            url: '',
            imagesPerLoad: 25,
        }, options);

        var data = null;
        var displayed = 0;
        var exhausted = false;
        var target = this;

        ajax({
            type: 'GET', url: settings.url
        }).then(
            (result) => {
                data = result;
                if (!data.images.length) {
                    target.append('<div class="Album__empty">Album is empty.</div>');
                } else load();
            },
            (xhr) => {
                console.error(`Could not load album: GET ${url} ${xhr.status} ${xhr.statusText}`);
                target.append('<div class="Album__empty">Could not load album.</div>');
            }
        ).catch(
            (error) => {
                console.error(error.message);
            }
        );

        function load() {
            removeLoader();

            var segment = {
                start: displayed,
                end: (displayed + settings.imagesPerLoad >= data.images.length) ?
                    data.images.length : displayed + settings.imagesPerLoad,
            };
            if (segment.end === data.images.length)
                exhausted = true;

            data.images.slice(segment.start, segment.end).map(image => {
                target.append(renderImage(image));
            });

            displayed = segment.end;

            if (!exhausted)
                addLoader();
        }

        function addLoader() {
            target.parent().append(renderLoader());
            $('.Album__loader').on('click', () => {
                load();
            });
        }

        function removeLoader() {
            $('.Album__loader-row').remove();
        }

        return this;
    };

    var ajax = function (options) {
        return new Promise(function (resolve, reject) {
            $.ajax(options).done(resolve).fail(reject);
        });
    };

    var renderImage = function (image) {
        return `<div class="AlbumPreview__thumb"
                     title="${image.description}">
                    <a href="${image.path}"
                       data-lightbox="album"
                       data-title="${image.description}">
                        <img src="${image.thumb}">
                    </a>
                </div>`;
    };

    var renderLoader = function () {
        return `<div class="Album__loader-row">
                    <button class="Album__loader btn btn-default">Load More</button>
                </div>`;
    };

}(jQuery));
