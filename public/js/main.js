
(function($){

  var gatherTemplates = function() {
    var templates = ['adviser', 'scheduler'];

    templates.forEach(function(elem) {
      Handlebars.getTemplate(elem);
    });
  };

  var get = function(url, async) {
    return new Promise(function(resolve, reject) {
      var req = new XMLHttpRequest();
      req.open('GET', url);

      req.onload = function() {
        if(req.status >= 200 && req.status < 400) {
          resolve(req.response);
        } else {
          reject(Error(req.statusText));
        }
      };

      req.onerror = function() {
        reject(Error("Network Error"));
      };

      req.send();
    });
  };

  var category = function(el) {
    var my = {
      section: el,
      selector: el.querySelectorAll('select')[0],
      categoryId: null,
      categoryName: null,

      getAdvisers: function() {
        var url = 'api/v1/categories/' + my.categoryId + '/advisors/*';

        get(url).then(function(data) {
          adviserManager.remove();
          adviserManager.showSection(data);
          adviserManager.bindActions();
        });
      },

      selectorChanged: function() {
        my.categoryId = this.options[this.selectedIndex].value;
        my.categoryName = this.options[this.selectedIndex].text;
        my.getAdvisers();
      }
    },

    that = {
      bindActions: function() {
        my.selector.addEventListener('change', my.selectorChanged);
      },
      section: function() {
        return my.section;
      },
      selector: function() {
        return my.selector;
      },
      categoryId: function() {
        return my.categoryId;
      },
      remove: function() {
        if (my.section === null) return;

        var el = my.section;
        el.remove();
        adviserManager.remove();
      }
    };

    return that;
  };

  var adviser = function() {
    var my = {
      section: null,
      selector: null,
      template: 'adviser',
      advisers: [],
      advisorId: null,
      advisorName: null,
      unavailables: null,
      appointments: null,
    },
    that = {
      bindActions: function() {
        my.selector.addEventListener('change', that.adviserChosen);
      },

      showSection: function(data) {
        var prevSection = categoryManager.section(),
        tmpl = Handlebars.getTemplate(my.template);
        
        prevSection.insertAdjacentHTML('afterend', tmpl(JSON.parse(data)));
        my.section = document.getElementsByClassName('panel')[1];
        my.selector = my.section.querySelectorAll('select')[0];
        Handlebars.scrollToDiv('advisors-panel');
      },

      adviserChosen: function() {
        my.advisorId = this.options[this.selectedIndex].value;
        my.advisorName = this.options[this.selectedIndex].text;

        // Get and set unavailables
        var url = 'api/v1/advisors/' + my.advisorId + '/unavailable/*';
        get(url).then(function(data) {
          my.unavailables = data;                   
        });

        // Get and set appointments
        var url = 'api/v1/advisors/' + my.advisorId + '/appointments';
        get(url).then(function(data) {
          my.appointments = data;         

          calendarManager.remove();
          calendarManager.updateAvailables();
          calendarManager.bindActions(); 
        });        
      },

      advisers: function(data) {
        if(data === undefined)
          return my.advisers;
        my.advisers = data;
      },
      section: function() {
        return my.section;
      },
      selector: function() {
        return my.selector;
      },
      template: function() {
        return my.template;
      },
      selectedName: function() {
        return my.advisorName;
      },
      selectedId: function() {
        return my.advisorId;
      },
      unavailables: function() {
        return my.unavailables;
      },
      appointments: function() {
        return my.appointments;
      },
      remove: function() {
        if (my.section === null) return;

        var el = my.section;
        el.remove();
        calendarManager.remove();
      }
    };

    return that;
  };

  var calendar = function() {
    var my = {
      section: null,
      calendar: null,
      template: 'scheduler',
      selectedEvents: [],
      saveButton: null,
    },
    that = {
      bindActions: function() {
        this.setupClndr();                
        
        var jsonUnavailables = jQuery.parseJSON(adviserManager.unavailables());
        var jsonAppointments = jQuery.parseJSON(adviserManager.appointments());  

        console.log(jsonAppointments);      

        $('#calendar').fullCalendar('addEventSource', {
            events: jsonUnavailables,
            color: 'black',
            textColor: 'white',
            editable: false
        });

        $('#calendar').fullCalendar('addEventSource', {
            events: jsonAppointments,            
            textColor: 'black',
            editable: false
        });

        my.saveButton.addEventListener('click', that.saveEvents);
      },
      showSection: function() {
        var prevSection = adviserManager.section(),
        tmpl = Handlebars.getTemplate(my.template);

        prevSection.insertAdjacentHTML('afterend', tmpl());
        my.section = document.getElementsByClassName('panel')[2];
        my.calendar = document.getElementById('cal');
        my.saveButton = document.getElementById('confirm-button');
        Handlebars.scrollToDiv('calendar-panel');        
      },
      remove: function() {
        if(my.section === null) return;

        var el = my.section;
        el.remove();
      },
      updateAvailables: function() {
        this.showSection();
      },
      selectedEVents: function(){
        return my.selectedEvents;
      },
      section: function() {
        return my.section;
      },
      saveEvents: function() {        

        var loggedUserId = $('#logged-in-user-id').val();
        var createdAppts = [];
        var userCreatedEvents = getUserCreatedEvents();
        var numOfEventsToCreate = userCreatedEvents.length;
        // For each event we have, lets create a new object
        // that has all the info we need , then create the appointment
        // thru the API.
        jQuery.each(userCreatedEvents, function(i, o) {
          var start = moment(o._start._d).format("YYYY-MM-DD HH:mm:ss");
          var end = moment(o._end._d).format("YYYY-MM-DD HH:mm:ss");

          var obj = { category:categoryManager.categoryId(),
                      advisor:adviserManager.selectedId(),
                      studentId:loggedUserId,
                      start:start,
                      end:end
                    };

          // POST each appointment to our API controller
          var ajaxPost = jQuery.post('api/v1/appointments/', obj)
            .done(function(data) {
              // Success   
              createdAppts.push(data); 
              // We don't actually want to show the confirmation panel
              // until all the events have been created
              // because AJAX is parallel..the second argument is a hack around this               
              confirmationManager.showSection(createdAppts, numOfEventsToCreate);
            })
            .fail(function(data) {
              // Log what failed
              console.log(data.responseText);
            })
          
        }); 
      },     
      setupClndr: function() {
        $('#calendar').fullCalendar({
          allDaySlot: false,
          defaultView:'agendaWeek',
          editable: true,
          eventOverlap: false,
          minTime: "08:00:00",
          maxTime: "18:00:00",              
          selectable: true,
          selectHelper: true,
          slotEventOverlap: false,
          timezone: 'local',
          weekends: false,

          eventRender: function(event, element) {            
            // Remove the event if it is double clicked.
            // Only remove events that are new or editable ... had to do these checks
            // so as to no have JS throw undefined errors. 
            if (typeof event.source === 'undefined' || 
              typeof event.source.editable === 'undefined' || 
              event.source.editable) {
                element.bind('dblclick', function() {              
                  $('#calendar').fullCalendar('removeEvents', event._id);

                  // We've removed an event..lets check to see if any user
                  // created events still exist; otherwise remove the save
                  // button.
                  if (getUserCreatedEvents().length < 1) {
                    $('#confirm-button').hide();
                  }                  
                });
            }
          },

          select: function(start, end) {                    
            var title = "Appointment with " + adviserManager.selectedName();
            var eventData;
            if (title) {
              eventData = {
                title: title,
                start: start,
                end: end
              };
              $('#calendar').fullCalendar('renderEvent', eventData, true);
            }
            $('#calendar').fullCalendar('unselect');

            // After the event is rendered and unselected let's 
            // check if any user created events still exist and display
            // save button if so                  
            if (getUserCreatedEvents().length > 0) {
              $('#confirm-button').show();
            }
          },         

        });
      }
    };

    return that;
  };

  var confirmation = function() {
    var my = {
      section: null,
      template: 'confirmation',
      appointments: null
    },
    that = {
      showSection: function(data, count) {
        // See line ~245 where count is passed in for the 
        // explanation
        if (data.length != count) {
          return;
        }

        that.remove();
        categoryManager.remove();
        $('.jumbotron').remove();

        tmpl = Handlebars.getTemplate(my.template);
        $('#navbar-container').append(tmpl(data));
        my.section = document.getElementsByClassName('panel')[3];        
        Handlebars.scrollToDiv('confirmation-panel');
      },
      section: function() {
        return my.section;
      },
      template: function() {
        return my.template;
      },
      remove: function() {
        if (my.section === null) return;

        var el = my.section;
        el.remove();
      }
    };

    return that;
  };


  gatherTemplates();

  var categoryManager = category(document.getElementsByClassName('panel')[0]),
      adviserManager = adviser(),  
      calendarManager = calendar(),
      confirmationManager = confirmation();

  categoryManager.bindActions();

}(jQuery));

// Will return an array of all the user created
// events from fullCalendar
function getUserCreatedEvents() {
  var allEvents = $('#calendar').fullCalendar('clientEvents');

  // Filter out the events that the user created
  var createdEvents = jQuery.grep(allEvents, function(e) {
    return (e._id.indexOf('_fc') > -1);
  });

  return createdEvents;
}