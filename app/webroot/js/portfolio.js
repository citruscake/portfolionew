(function() {
  $(function() {
    var animatePage, createPopover, emailCheck, loadProjects, toggleSubmit;
    animatePage = function() {
      $('#app_container').css('opacity', 0.5);
      return $('#app_container').animate({
        'opacity': 1
      }, 200, "easeOutSine");
    };
    loadProjects = function() {
      var initialiseModels, projectCollection, projectCollectionView;
      projectCollectionView = null;
      projectCollection = null;
      initialiseModels = function() {
        window.Project = Backbone.Model.extend({});
        window.ProjectView = Backbone.View.extend({
          tagName: 'div',
          idAttribute: 'project_id',
          template: _.template($('#project_container_template').html()),
          events: {
            'click #live_link_button': 'openSite'
          },
          render: function() {
            var attributes;
            attributes = this.model.toJSON();
            this.$el.html(this.template(attributes));
            console.log(attributes);
            return this;
          },
          openSite: function() {
            var url;
            url = this.model.get('live_site_url');
            return window.open(url, '_blank');
          }
        });
        window.ProjectThumbnailView = Backbone.View.extend({
          tagName: 'li',
          template: _.template($('#thumbnail_button_template').html()),
          render: function() {
            var attributes;
            attributes = this.model.toJSON();
            this.$el.html(this.template(attributes));
            $(this.el).addClass('thumbnail');
            $(this.el).attr('id', this.model.get('id'));
            return this;
          }
        });
        window.ProjectCollection = Backbone.Collection.extend({
          model: Project,
          idAttribute: 'project_id',
          methodURL: {
            'read': '/projects/action/fetch'
          },
          sync: function(method, model, options) {
            if (model.methodURL && model.methodURL[method.toLowerCase()]) {
              options.url = model.methodURL[method.toLowerCase()];
            }
            return Backbone.sync(method, model, options);
          }
        });
        window.ProjectThumbnailsView = Backbone.View.extend({
          tagName: 'ul',
          render: function() {
            var project, _i, _len, _ref;
            _ref = this.collection.models;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              project = _ref[_i];
              this.renderProject(project);
            }
            $(this.el).addClass('thumbnails');
            return this;
          },
          renderProject: function(project) {
            var projectThumbnailView;
            projectThumbnailView = new ProjectThumbnailView({
              model: project
            });
            return this.$el.append(projectThumbnailView.render().el);
          }
        });
        return window.ProjectCollectionView = Backbone.View.extend({
          tagName: 'div',
          render: function(project_id) {
            var project, projectView;
            project = this.collection.get(project_id);
            console.log(project_id);
            projectView = new ProjectView({
              model: project
            });
            this.$el.append(projectView.render().el);
            return this;
          }
        });
      };
      return $.get('/projects/templates/fetch', function(json) {
        var projectThumbnailsView, template, templates, _i, _len;
        templates = $.parseJSON(json);
        for (_i = 0, _len = templates.length; _i < _len; _i++) {
          template = templates[_i];
          $('#templates').append(template);
        }
        initialiseModels();
        projectCollection = new ProjectCollection();
        projectThumbnailsView = new ProjectThumbnailsView({
          collection: projectCollection
        });
        console.log(projectCollection);
        projectCollection.fetch({
          success: function(collection, response) {
            $('#thumbnail_gallery').html(projectThumbnailsView.render().el);
            $('#thumbnail_gallery').find('.thumbnail-frame').eq(0).trigger('click');
            console.log($('#thumbnail_gallery').find('.thumbnail-frame').eq(0).children('img').eq(0));
            return animatePage();
          }
        });
        return $('#thumbnail_gallery').on('click', '.thumbnail, .thumbnail-frame', function(event) {
          var project, project_id;
          project_id = $(event.target).attr('id');
          project = projectCollection.get(project_id);
          projectCollectionView = new ProjectCollectionView({
            collection: projectCollection
          });
          $('#project_container').html(projectCollectionView.render(project_id).el);
          $('#project_container').css('opacity', 0.5);
          $('#project_container').animate({
            'opacity': 1
          }, 200, "linear");
          return $('#main_image').baseline(27);
        });
      });
    };
    emailCheck = function(email) {
      var regex;
      regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    };
    createPopover = function(element, message) {
      $(element).popover({
        content: message
      });
      return $(element).popover('show');
    };
    toggleSubmit = function(isLoading) {
      if (isLoading === true) {
        $('#submit_contact_us_button').css('padding-top', '0.4em');
        $('#submit_contact_us_button').css('padding-bottom', '0.4em');
        return $('#submit_contact_us_button').html("<img src=\"/img/ajax-loader.gif\"/>");
      } else {
        $('#submit_contact_us_button').css('padding-top', '0em');
        $('#submit_contact_us_button').css('padding-bottom', '0em');
        return $('#submit_contact_us_button').html("Send <i class=\"icon-envelope icon-white\" />");
      }
    };
    return $(document).ready(function() {
      var about_view, contact_view, current_view, detachView, projects_view;
      about_view = null;
      contact_view = null;
      projects_view = null;
      current_view = null;
      $('#about_me_link').on('click', function(event) {
        if (current_view !== null) {
          detachView();
        }
        current_view = "about";
        if (about_view === null) {
          return $.get('/main/about', function(view) {
            $('#app_container').html(view);
            return animatePage();
          });
        } else {
          $('#app_container').append(about_view);
          return animatePage();
        }
      });
      $('#projects_link').on('click', function(event) {
        if (current_view !== null) {
          detachView();
        }
        current_view = "projects";
        if (projects_view === null) {
          return $.get('/projects', function(view) {
            $('#app_container').html(view);
            $('#app_container').css('opacity', 0);
            return loadProjects();
          });
        } else {
          $('#app_container').append(projects_view);
          return animatePage();
        }
      });
      $('#contact_me_link').on('click', function(event) {
        if (current_view !== null) {
          detachView();
        }
        current_view = "contact";
        if (contact_view === null) {
          return $.get('/main/contact', function(view) {
            $('#app_container').html(view);
            return animatePage();
          });
        } else {
          $('#app_container').append(contact_view);
          return animatePage();
        }
      });
      detachView = function() {
        if (current_view === "about") {
          return about_view = $('#app_container').children().eq(0).detach();
        } else if (current_view === "projects") {
          return projects_view = $('#app_container').children().eq(0).detach();
        } else if (current_view === "contact") {
          return contact_view = $('#app_container').children().eq(0).detach();
        }
      };
      $('#app_container').on('click', '#view_cv_button', function(event) {
        var url;
        url = '/pdf/CV.pdf';
        return window.open(url, '_blank');
      });
      $('#app_container').on('click', 'a', function(event) {
        var url;
        event.preventDefault();
        url = $(event.target).attr('href');
        return window.open(url, '_blank');
      });
      $('#app_container').on('focus', 'input, textarea', function(event) {
        var id;
        id = event.target.id;
        $('#' + id).parent().animate({
          'border-color': '#333333'
        }, 100);
        return $('#' + event.target.id).parent().popover('destroy');
      });
      $('#app_container').on('focusout', 'input, textarea', function(event) {
        var id;
        id = event.target.id;
        return $('#' + id).parent().animate({
          'border-color': '#999999'
        }, 100);
      });
      $('#app_container').on('keyup', '#contact_email_address', function(event) {
        var email_address, isEmail;
        email_address = $('#contact_email_address').val();
        if (email_address !== "") {
          isEmail = emailCheck(email_address);
          if (isEmail === true) {
            return $('#contact_email_symbol_container').html("<i class=\"icon-ok\"></i>");
          } else {
            return $('#contact_email_symbol_container').html("<i class=\"icon-remove\"></i>");
          }
        } else {
          return $('#contact_email_symbol_container').html("");
        }
      });
      $('#app_container').on('click', '#submit_contact_us_button', function(event) {
        var data, email_address, full_name, isLoading, isTimerDone, message_body, message_subject;
        email_address = $('#contact_email_address').val();
        full_name = $('#full_name').val();
        message_subject = $('#message_subject').val();
        message_body = $('#message_body').val();
        if (email_address === "") {
          return createPopover('#contact_email_container', "Please enter your email address.");
        } else if (emailCheck(email_address) === false) {
          return createPopover('#contact_email_container', "Your email address is invalid.");
        } else if (full_name === "") {
          return createPopover('#full_name_container', "Please give your name.");
        } else if (message_subject === "") {
          return createPopover('#message_subject_container', "Please give your message subject.");
        } else if (message_body = "") {
          return createPopover('#message_body_container', "Please give your message body.");
        } else {
          isLoading = true;
          isTimerDone = false;
          toggleSubmit(isLoading);
          $(this).doTimeout('change_button', 300, function() {
            isTimerDone = true;
            if (isLoading === false) {
              return toggleSubmit(isLoading);
            }
          });
          data = {
            email_address: $('#contact_email_address').val(),
            full_name: $('#full_name').val(),
            message_subject: $('#message_subject').val(),
            message_body: $('#message_body').val()
          };
          return $.post('/main/contact', data, function(json) {
            var response;
            isLoading = false;
            if (isTimerDone === true) {
              toggleSubmit(isLoading);
            }
            response = $.parseJSON(json);
            if (response.status === "success") {
              $('.alert-success').css('display', 'inline');
              $('.alert-success').animate({
                'opacity': 1
              }, 300);
            } else {
              $('.alert-error').css('display', 'inline');
              $('.alert-error').animate({
                'opacity': 1
              }, 300);
            }
            $('#app_container').off('click', '#submit_contact_us_button');
            $('#contact_container label, #submit_contact_us_button, #message_body_container, #contact_email_container, #contact_email_symbol_container, #full_name_container, #message_subject_container').animate({
              'opacity': 0.4
            }, 300);
            return $('#contact_container input, #contact_container textarea').prop('disabled', true);
          });
        }
      });
      return $('#about_me_link').trigger('click');
    });
  });

}).call(this);
