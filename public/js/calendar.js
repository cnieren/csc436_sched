var Slate = Slate || {};

Slate.calendar = (function($, undefined) {
    'use strict';

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

            select: function(start, end) {
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
                $el.fullCalendar('renderEvent', newEvent, true);
                changed();
            },

            eventRender: function(event, element) {
                if(!event.source || !event.source.editable)
                    return;
                element.on('dblclick', function() {
                    removedEvents.push(event);
                    $el.fullCalendar('removeEvents', event._id);
                    changed();
                });
            },

            eventDrop: function(event) {
                defineProperty(event, 'isModified', true);
                changed();
            },

            eventResize: function(event) {
                defineProperty(event, 'isModified', true);
                changed();
            }
        };

    function defineProperty(obj, key, value) {
        var config = {
            value: value,
            writeable: true,
            enumerable: true,
            configurable: true
        };
        Object.defineProperty(obj, key, config);
    }

    function changed() {
        $el.trigger('calendarChanged');
    }

    function init(el, option) {
        $el = $(el);
        var options = $.extend({}, defaults, typeof option == 'object' && option);
        defaults = options;
    }

    function displayCalendar() {
        $el.fullCalendar(defaults);
    }

    function setEvent(template) {
        eventTemplate = template;
    }

    function getAllEvents(filter) {
        if(typeof filter === 'function')
            return $el.fullCalendar('clientEvents', filter);
        
        return $el.fullCalendar('clientEvents');
    }

    function getNewEvents() {
        return $el.fullCalendar('clientEvents', function(event) {
            return event.isNew;
        });
    }

    function getModifiedEvents() {
        return $el.fullCalendar('clientEvents', function(event) {
            return event.isModified;
        });
    }

    function getDeletedEvents() {
        return removedEvents;
    }

    function eventDrop(func) {
        defaults.eventDrop = (function(_super) {
            return function() {
                func();
                return _super.apply(this, arguments);
            };
        })(defaults.eventDrop);
    }

    function eventResize(func) {
        defaults.eventResize = (function(_super) {
            return function() {
                func();
                return _super.apply(this, arguments);
            };
        })(defaults.eventResize);
    }

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