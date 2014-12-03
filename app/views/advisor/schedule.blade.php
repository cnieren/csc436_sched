@section('content')
<div class="panel panel-default" id="calendar-panel">
	<div class="panel-heading">
		<h4 class="panel-title">
			My Schedule
		</h4>
        <button id="confirm-button" type="button">
            <i class="fa fa-floppy-o"></i> Save
        </button>
	</div>
	<div class="panel-body">
		<div class="inner-well-padding">
			<div id='calendar'></div>
		</div>
	</div>
</div>


@stop

@section('js')

{{ HTML::script('js/calendar.js') }}
{{ HTML::script('js/utils.js') }}
<script type="text/javascript">
$(document).ready(function() {

    // page is now ready, initialize the calendar...

    var options = {eventSources: [] },
        $confirmButton = $('#confirm-button'),
        $calendar = $('#calendar');

    var unavailReq = Slate.utils.getJSON('api/v1/advisors/3/unavailable')
    .then(function(data) {
        data.forEach(function(elem) {
            elem.type = 'unavailable';
        });
        addEventSource(data);
    });

    var appointmentReq = Slate.utils.getJSON('api/v1/advisors/3/appointments')
    .then(function(data) {
        data.forEach(function(elem) {
            elem.type = 'appointment';
        });
        addEventSource(data);
    });

    // Bind to the calendar changed event
    $calendar.one('calendarChanged', function(e) {
        $confirmButton.show();
    });

    $confirmButton.one('click', function(e) {
        e && e.preventDefault();
        var newEvents = Slate.calendar.getNewEvents();
        var modified = Slate.calendar.getModifiedEvents();
        var removed = Slate.calendar.getDeletedEvents();

        console.log('New', newEvents);
        console.log('modified', modified);
        console.log('removed', removed);

        var testAppointment = {
            id: 7,
            category: 1,
            advisor: 3,
            studentId: 1,
            start: '2014-12-04 12:00:00',
            end: '2014-12-04 12:30:00'
        };

        var url = 'api/v1/appointments/';

        Slate.utils.put(url, testAppointment)
        .then(function(data) {
            console.log(data);
        }, function(err) {
            console.error(err);
        });

        // Slate.utils.post(url, testAppointment)
        // .then(function(data) {
        //     console.log(data);
        // }, function(err) {
        //     console.error(err);
        // });

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

});
</script>
@stop