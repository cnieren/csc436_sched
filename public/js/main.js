
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

      remove: function() {
        var el = my.section;
        el.parentNode.removeChild(el);
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
      },

      adviserChosen: function() {
        my.advisorId = this.options[this.selectedIndex].value;
        my.advisorName = this.options[this.selectedIndex].text;
        var url = 'api/v1/advisors/' + my.advisorId + '/available/*';
        get(url).then(function(data) {
          calendarManager.remove();
          calendarManager.updateAvailables(data);
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
      times: null,
      template: 'scheduler'
    },
    that = {
      bindActions: function() {
        this.setupClndr();
      },
      showSection: function(data) {
        var prevSection = adviserManager.section(),
        tmpl = Handlebars.getTemplate(my.template);

        prevSection.insertAdjacentHTML('afterend', tmpl(JSON.parse(data)));
        my.section = document.getElementsByClassName('panel')[2];
        my.calendar = document.getElementById('cal');
        my.times = my.section.querySelectorAll('select')[0];
      },
      remove: function() {
        if(my.section === null) return;

        var el = my.section;
        el.remove();
      },
      updateAvailables: function(data) {
        this.showSection(data);
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
          weekends: false,

          eventRender: function(event, element) {
            // Remove the event if it is double clicked
            element.bind('dblclick', function() {              
              $('#calendar').fullCalendar('removeEvents', event._id);
            });
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
          },         

        });
      }
    };

    return that;
  };


  gatherTemplates();

  var categoryManager = category(document.getElementsByClassName('panel')[0]),
      adviserManager = adviser(),  
      calendarManager = calendar();

  categoryManager.bindActions();

}(jQuery));