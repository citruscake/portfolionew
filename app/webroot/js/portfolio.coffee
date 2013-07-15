$ ->
	initialiseModels = ->
		window.Project = Backbone.Model.extend({})

		window.ProjectView = Backbone.View.extend
			tagName : 'div'
			idAttribute : 'project_id'
			template : _.template $('#project_container_template').html()
			render : ->
				attributes = this.model.toJSON()
				this.$el.html this.template attributes
				return this
		
		window.ProjectThumbnailView = Backbone.View.extend
			tagName : 'li'
			template : _.template $('#thumbnail_button_template').html()
			render : ->
				attributes = this.model.toJSON()
				this.$el.html this.template attributes
				$(this.el).addClass 'thumbnail'
				$(this.el).attr 'id', this.model.get 'id'
				return this
	
		window.ProjectCollection = Backbone.Collection.extend
			model : Project
			idAttribute : 'project_id'
			methodURL:
				'read' : '/main/projects/fetch'
			sync : (method,model,options) ->

				if model.methodURL && model.methodURL[method.toLowerCase()]
					options.url = model.methodURL[method.toLowerCase()]
				Backbone.sync(method, model, options)
	
		window.ProjectThumbnailsView = Backbone.View.extend
			tagName : 'ul'
				
			render : ->
		
				for project in this.collection.models
					this.renderProject project
				$(this.el).addClass 'thumbnails'
				return this
			
			renderProject : (project) ->
				projectThumbnailView = new ProjectThumbnailView
					model : project
				this.$el.append projectThumbnailView.render().el
	
		window.ProjectCollectionView = Backbone.View.extend
			tagName : 'div'
				
			render : (project_id) ->

				project = this.collection.get project_id
				projectView = new ProjectView
					model : project
				this.$el.append projectView.render().el
				return this
	
	$.get '/main/templates/fetch', (json) ->
		templates = $.parseJSON json
		for template in templates
			$('#templates').append template
		initialiseModels()
		window.projectCollection = new ProjectCollection()
		projectThumbnailsView = new ProjectThumbnailsView
			collection : projectCollection
		projectCollection.fetch
			success : (collection,response) ->
				$('#thumbnail_gallery').html projectThumbnailsView.render().el
	
	$(document).ready ->
	
		$('#thumbnail_gallery').on 'click', '.thumbnail', (event) ->
			project_id = $(event.target).parent().attr 'id'
			project = projectCollection.get project_id
			projectCollectionView = new ProjectCollectionView
				collection : projectCollection
			$('#project_container').html projectCollectionView.render(project_id).el