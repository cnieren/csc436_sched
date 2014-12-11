(function($) {
    var options = {eventSources: [] },
        $confirmButton = $('#confirm-button'),
        $calendar = $('#calendar');

    var loggedInUserId = $('#logged-in-user-id').val();

    var unavailReq = Slate.utils.getJSON('api/v1/advisors/' + loggedInUserId + '/unavailable')
    .then(function(data) {
        data.forEach(function(elem) {
            elem.type = 'unavailable';
        });
        addEventSource(data);
    });

    var appointmentReq = Slate.utils.getJSON('api/v1/advisors/' + loggedInUserId + '/appointments')
    .then(function(data) {
        data.forEach(function(elem) {
            elem.type = 'appointment';
        });
        addEventSource(data);
    });

    // Bind to the calendar changed event
    $calendar.on('calendarChanged', function(e) {
        $confirmButton.show();
    });

    Promise.all([unavailReq, appointmentReq]).then(function() {
        // Initialize the calendar with the options
        Slate.calendar.init('#calendar', options);

        // Set a custom event template
        // used when a new event is created
        Slate.calendar.setEventTemplate({
            title: 'Unavailable',
            type: 'unavailable',
            isNew: true,
            color: '#969696',
            textColor: 'white'
        });

        // Display the calendar to the user
        Slate.calendar.display();
    }).catch(function() {
        networkError();
    });

    var addEventSource = function(events, editable) {
        editable = editable === undefined ? true : editable;
        options.eventSources.push({
            events: events,
            color: '#969696',
            textColor: '#eee',
            editable: editable
        });
    };

    var networkError = function() {
        var template = Handlebars.getTemplate('alert');
        var message = {
            severity: 'danger',
            title: 'Network Error',
            message: 'Please try again'
        };

        var el = document.getElementById('calendar');
        el.insertAdjacentHTML('beforebegin', template(message));
    };

    $confirmButton.on('click', function(e) {
        e && e.preventDefault();

        // when all the changes are done:
        // hide the save button and display a success message
        Slate.calendar.saveChanges(loggedInUserId).then(function() {
            $confirmButton.hide();

            var template = Handlebars.getTemplate('alert');
            var message = {
                severity: 'success',
                title: 'Success',
                message: 'All changes saved'
            };

            var el = document.getElementById('calendar');
            el.insertAdjacentHTML('beforebegin', template(message));

            $('.alert').show().delay(1500).slideUp('slow', function() {
                $(this).remove();
            });
        });
    });
})(jQuery);
