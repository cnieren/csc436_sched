var Slate = Slate || {};

Slate.utils = (function($, undefined) {
    'use strict';

    /**
     * Make and HTTP GET request to the specified url
     * The result will be the raw response from the server
     * 
     * @param  {string} url The url to make the GET request to
     * @return {Promise}    A Promise that will resolve when
     * the HTTP request finishes 
     */
    function get(url) {
        return Promise.resolve($.get(url));
    }

    /**
     * Make and HTTP GET request to the specified url
     * The result will be parsed as JSON 
     * 
     * @param  {string} url The url to make the GET request to
     * @return {Promise}     A Promise that will reslove when
     * the HTTP request finishes
     */
    function getJSON(url) {
        return Promise.resolve($.getJSON(url));
    }

    /**
     * Make an HTTP POST request to the specified url
     * 
     * @param  {string} url  The url to make the POST request to
     * @param  {[object]} data optional: the data to send with 
     * the post request
     * @return {Promise}      A Promise taht will resolve when 
     * the HTTP POST request finishes
     */
    function post(url, data) {
        return Promise.resolve($.post(url, data));
    }

    /**
     * Make an HTTP PUT request to the specified url
     * 
     * @param  {string} url  The url to make the PUT request to
     * @param  {[object]} data optional: the data to send with the
     * PUT request
     * @return {Promise}      A Promise that will resolve when
     * the HTTP PUT request finishes
     */
    function put(url, data) {
        return Promise.resolve($.ajax({
            type: 'PUT',
            url: url,
            data: data
        }));
    }

    /**
     * Make and HTTP DELETE reqpest to the specified url
     * 
     * @param  {string} url  The url to make the DELETE request to
     * @param  {[object]} data optional: the data to send with the
     * DELETE request
     * @return {Promise}      A Promise that will resolve when
     * the HTTP DELETE request finishes
     */
    function destroy(url, data) {
        return Promise.resolve($.ajax({
            type: 'DELETE',
            url: url,
            data: data
        }));
    }

    /**
     * Helper function used to define a new property on an existing object
     * 
     * @param  {object} obj   The object to add the property to
     * @param  {string} key   The name of the property to add
     * @param  {[type]} value The value to assign to the property
     */
    function defineProperty(obj, key, value) {
        var config = {
            value: value,
            writable: true,
            enumerable: true,
            configurable: true
        };
        Object.defineProperty(obj, key, config);
    }

    // The public interface for this module
    return {
        get: get,
        getJSON: getJSON,
        post: post,
        put: put,
        destroy: destroy,
        defineProperty: defineProperty
    };
    
})(jQuery);