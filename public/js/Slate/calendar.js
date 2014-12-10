var Slate = Slate || {};

Slate.calendar = (function($, undefined) {
    'use strict';

    //  Defaults for this module
    var $el,
        eventTemplate = {
            title: 'Available',
            isNew: true,
        },
        removedEvents = [],
        defaults = {
            editable: true,
            weekends: false,
            defaultView: 'agendaWeek',
            selectOverlap: false,
            eventOverlap: false,
            selectHelper: true,
            selectable: true,
            minTime: "08:00:00",
            maxTime: "17:00:00",
            height: 'auto',
            contentHeight: 'auto',
            allDayDefault: false,
            allDaySlot: false,
            defaultTimedEventDuration: '00:30:00',
            forceEventDuration: true,
            timezone: 'local',

            /**
             * The default callback function that fullCalendar will use
             * when a new event is created
             */
            select: function(start, end) {
                // Using the defined event template add
                // start and end properties to the object
                var newEvent = Object.create(eventTemplate, {
                    start: {
                        writeable: true,
                        configurable: true,
                        value: start
                    },
                    end: {
                        writeable: true,
                        configurable: true,
                        value: end
                    }
                });

                // Render the event to the calendar
                $el.fullCalendar('renderEvent', newEvent, true);

                // Trigger the calendar changed event
                changed();
            },

            /**
             * The default callback function that fullCalendar will use
             * when an event is rendered to the screen
             */
            eventRender: function(event, element) {
                if(!event.source || !event.source.editable)
                    return;

                // Remove editable events when the are double clicked
                element.on('dblclick', function() {
                    removedEvents.push(event);
                    $el.fullCalendar('removeEvents', event._id);
                    changed();
                });
            },

            /**
             * The default callback function that fullCalendar will use
             * when an event is droped after dragging
             */
            eventDrop: function(event) {
                Slate.utils.defineProperty(event, 'isModified', true);
                changed();
            },

            /**
             * The default callback function that fullCalendar will use
             * when an event is resized
             */
            eventResize: function(event) {
                Slate.utils.defineProperty(event, 'isModified', true);
                changed();
            }
        };

    /**
     * Trigger the calendar changed event to allow external listeners
     * to take an action when an event changes
     */
    function changed() {
        $el.trigger('calendarChanged');
    }

    /**
     * Initialize the calendar module for a page
     * 
     * @param  {element} el    The DOM element to use for the calendar
     * @param  {object} option optional: options used to change the default
     * behavior of the fullCalendar
     */
    function init(el, option) {
        $el = $(el);
        var options = $.extend({}, defaults, typeof option == 'object' && option);
        defaults = options;
    }

    /**
     * Show the fullCalendar on the page
     * Call this function after you have set your prefered settings
     */
    function displayCalendar() {
        $el.fullCalendar(defaults);
    }

    /**
     * Change the event template object that is used to make new events
     */
    function setEvent(template) {
        eventTemplate = template;
    }

    /**
     * Get an array of all events the calendar knows about
     * 
     * @param  {function} filter A filtering function to limit the
     * events returned
     * @return {array}           An array of events
     */
    function getAllEvents(filter) {
        if(typeof filter === 'function')
            return $el.fullCalendar('clientEvents', filter);
        
        return $el.fullCalendar('clientEvents');
    }

    /**
     * Get only the new events from the calendar
     * Events that didn't exist when the calendar was loaded
     * 
     * @return {array} An array of new events
     */
    function getNewEvents() {
        return $el.fullCalendar('clientEvents', function(event) {
            return event.isNew;
        });
    }

    /**
     * Get only the events that have been modified since the calendar
     * was loaded
     * 
     * @return {array} An array of modified events
     */
    function getModifiedEvents() {
        return $el.fullCalendar('clientEvents', function(event) {
            return event.isModified;
        });
    }

    /**
     * Get only the events that have been deleted from the calendar
     * since it was loaded

     * @return {array} An array of deleted events
     */
    function getDeletedEvents() {
        return removedEvents;
    }

    /**
     * Extend the behavior of the calendar when an event is dropped
     * after being dragged from its origional location
     * 
     * @param  {function} func A function that implements the
     * desired drop behavior
     */
    function eventDrop(func) {
        // Extend the current functionality to include the new function
        defaults.eventDrop = (function(_super) {
            return function() {
                func();
                return _super.apply(this, arguments);
            };
        })(defaults.eventDrop);
    }

    /**
     * Extend the behavior of the calendar when an event is resized

     * @param  {function} func A function that implement the desired
     * resize behavior
     */
    function eventResize(func) {
        // Extend the current functionality to include the new function
        defaults.eventResize = (function(_super) {
            return function() {
                func();
                return _super.apply(this, arguments);
            };
        })(defaults.eventResize);
    }

    // The public interface for this module
    return {
        init: init,
        getAllEvents: getAllEvents,
        getNewEvents: getNewEvents,
        getModifiedEvents: getModifiedEvents,
        getDeletedEvents: getDeletedEvents,
        setEventTemplate: setEvent,
        display: displayCalendar,
        setEventDrop: eventDrop,
        setEventResize: eventResize
    };
})(jQuery);