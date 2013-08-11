$ ->
	loadProjects = ->
		projectCollectionView = null
		projectCollection = null

		initialiseModels = ->
			window.Project = Backbone.Model.extend({})

			window.ProjectView = Backbone.View.extend
				tagName : 'div'
				idAttribute : 'project_id'
				template : _.template $('#project_container_template').html()
				render : ->
					attributes = this.model.toJSON()
					this.$el.html this.template attributes
					console.log attributes
					return this
		
			window.ProjectThumbnailView = Backbone.View.extend
				tagName : 'li'
				template : _.template $('#thumbnail_button_template').html()
				render : ->
					attributes = this.model.toJSON()
					this.$el.html this.template attributes
					$(this.el).addClass 'thumbnail'
					$(this.el).find('.clickable_frame').attr 'id', this.model.get 'id'
					return this
	
			window.ProjectCollection = Backbone.Collection.extend
				model : Project
				idAttribute : 'project_id'
				methodURL:
					'read' : '/projects/action/fetch'
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
					console.log project_id
					projectView = new ProjectView
						model : project
					this.$el.append projectView.render().el
					return this
	
		$.get '/projects/templates/fetch', (json) ->
			templates = $.parseJSON json
			for template in templates
				$('#templates').append template
			initialiseModels()
			projectCollection = new ProjectCollection()
			projectThumbnailsView = new ProjectThumbnailsView
				collection : projectCollection
			console.log projectCollection
			projectCollection.fetch
				success : (collection,response) ->
					$('#thumbnail_gallery').html projectThumbnailsView.render().el
					$('#thumbnail_gallery').find('.thumbnail-frame').eq(0).children('img').eq(0).trigger 'click'
					console.log $('#thumbnail_gallery').find('.thumbnail-frame').eq(0).children('img').eq(0)
					
			$('#thumbnail_gallery').on 'click', '.thumbnail', (event) ->
			#if $('event.target').hasClass('thumbnail')
				project_id = $(event.target).attr 'id'
			#else if $('event.target').hasClass('thumbnail_frame')
			#	project_id = $(event.target).parent().attr 'id'
		
				console.log $(event.target)
			
				#project_id = $(event.target).parent().find('.thumbnail').attr 'id'
				project = projectCollection.get project_id
				projectCollectionView = new ProjectCollectionView
					collection : projectCollection
				$('#project_container').html projectCollectionView.render(project_id).el
				
				#alert $('#thumbnail_gallery').find('.thumbnail-frame')
	
	$(document).ready ->
		
		$('#about_me_link').on 'click', (event) ->
			$.get '/main/about', (about_view) ->
				$('#app_container').html about_view
		
		
		$('#projects_link').on 'click', (event) ->
			$.get '/projects', (projects_view) ->
				$('#app_container').html projects_view
				loadProjects()

				
		$('#contact_me_link').on 'click', (event) ->
			$.get '/main/contact', (contact_view) ->
				$('#app_container').html contact_view