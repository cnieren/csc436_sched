
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
  }

  var category = function(el) {
    var my = {
      section: el,
      selector: el.querySelectorAll('select')[0],
      categoryId: null,

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
        el.parentNode.removeChild(el)
      }
    };

    return that;
  }

  var adviser = function() {
    var my = {
      section: null,
      selector: null,
      template: 'adviser',
      advisers: [],
      advisorId: null,
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

      remove: function() {
        if (my.section === null) return;

        var el = my.section;
        el.remove();
        calendarManager.remove();        
      }
    };

    return that;
  }

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
        $(my.calendar).clndr({
          clickEvents: {
            click: function(target) {
                console.log(target.date._i);

                calendarManager.remove();
                calendarManager.updateAvailables(null);
                calendarManager.bindActions();
              
            },
            onMonthChange: function(month) {
              console.log('you just went to ' + month.format('MMMM, YYYY'));
            }
          }
        });
      }
    };

    return that;
  }


  gatherTemplates();

  var categoryManager = category(document.getElementsByClassName('panel')[0]),
    adviserManager = adviser();
    calendarManager = calendar();

    categoryManager.bindActions();

}(jQuery));

$(document).ready( function() {

  // assuming you've got the appropriate language files,
  // clndr will respect whatever moment's language is set to.
  // moment.locale('ru');


  $('.list-group-item').click(function() {
    $(this).toggleClass( "list-group-item-info" );
  });
});