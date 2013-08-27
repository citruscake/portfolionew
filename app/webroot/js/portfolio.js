(function() {
  $(function() {
    var loadProjects;
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
            $(this.el).find('.clickable_frame').attr('id', this.model.get('id'));
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
            $('#thumbnail_gallery').find('.thumbnail-frame').eq(0).children('img').eq(0).trigger('click');
            return console.log($('#thumbnail_gallery').find('.thumbnail-frame').eq(0).children('img').eq(0));
          }
        });
        return $('#thumbnail_gallery').on('click', '.thumbnail', function(event) {
          var project, project_id;
          project_id = $(event.target).attr('id');
          console.log($(event.target));
          project = projectCollection.get(project_id);
          projectCollectionView = new ProjectCollectionView({
            collection: projectCollection
          });
          $('#project_container').html(projectCollectionView.render(project_id).el);
          return $('#main_image').baseline(27);
        });
      });
    };
    return $(document).ready(function() {
      $('#about_me_link').on('click', function(event) {
        return $.get('/main/about', function(about_view) {
          return $('#app_container').html(about_view);
        });
      });
      $('#projects_link').on('click', function(event) {
        return $.get('/projects', function(projects_view) {
          $('#app_container').html(projects_view);
          return loadProjects();
        });
      });
      $('#contact_me_link').on('click', function(event) {
        return $.get('/main/contact', function(contact_view) {
          return $('#app_container').html(contact_view);
        });
      });
      $('#app_container').on('click', '#view_cv_button', function(event) {
        var url;
        url = '/pdf/CV.pdf';
        return window.open(url, '_blank');
      });
      $('#app_container').on('focus', 'input, textarea', function(event) {
        var id;
        id = event.target.id;
        return $('#' + id).parent().animate({
          'background-color': '#aaaaaa'
        }, 100);
      });
      $('#app_container').on('focusout', 'input, textarea', function(event) {
        var id;
        id = event.target.id;
        return $('#' + id).parent().animate({
          'background-color': 'rgb(192, 179, 189)'
        }, 100);
      });
      return $('#projects_link').trigger('click');
    });
  });

}).call(this);
