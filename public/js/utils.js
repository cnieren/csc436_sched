var Slate = Slate || {};

Slate.utils = (function($, undefined) {
    'use strict';

    function get(url) {
        return Promise.resolve($.get(url));
    }

    function getJSON(url) {
        return Promise.resolve($.getJSON(url));
    }

    function post(url, data) {
        return Promise.resolve($.post(url, data));
    }

    function put(url, data) {
        return Promise.resolve($.ajax({
            type: 'PUT',
            url: url,
            data: data
        }));
    }

    function destroy(url, data) {
        return Promise.resolve($.ajax({
            type: 'DELETE',
            url: url,
            data: data
        }));
    }

    return {
        get: get,
        getJSON: getJSON,
        post: post,
        put: put,
        destroy: destroy
    };
    
})(jQuery);