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
				events :
					'click #live_link_button' : 'openSite'
				render : ->
					attributes = this.model.toJSON()
					this.$el.html this.template attributes
					console.log attributes
					return this
				openSite : ->
					url = this.model.get 'live_site_url'
					window.open url, '_blank'
		
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
					#$('#about_me_link').trigger 'click'
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
				$('#main_image').baseline 27
				#alert $('#thumbnail_gallery').find('.thumbnail-frame')
	
	emailCheck = (email) ->
		#from http://stackoverflow.com/questions/2507030/email-validation-using-jquery
		regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
		regex.test(email)
		
	createPopover = (element, message) ->
		$(element).popover
			content : message
		$(element).popover 'show'
	
	toggleSubmit = (isLoading) ->
		if isLoading == true
			$('#submit_contact_us_button').css 'padding-top', '0.4em'
			$('#submit_contact_us_button').css 'padding-bottom', '0.4em'
			$('#submit_contact_us_button').html "<img src=\"/img/ajax-loader.gif\"/>"
		else
			$('#submit_contact_us_button').css 'padding-top', '0em'
			$('#submit_contact_us_button').css 'padding-bottom', '0em'
			$('#submit_contact_us_button').html "Send <i class=\"icon-envelope icon-white\" />"
	
	$(document).ready ->
		
		$('#about_me_link').on 'click', (event) ->
			$.get '/main/about', (about_view) ->
				$('#app_container').html about_view
				#$('#about_me_image').baseline 24
		
		$('#projects_link').on 'click', (event) ->
			$.get '/projects', (projects_view) ->
				$('#app_container').html projects_view
				loadProjects()

				
		$('#contact_me_link').on 'click', (event) ->
			$.get '/main/contact', (contact_view) ->
				$('#app_container').html contact_view
		
		$('#app_container').on 'click', '#view_cv_button', (event) ->
			url = '/pdf/CV.pdf'
			window.open url, '_blank'
		
		$('#app_container').on 'focus', 'input, textarea', (event) ->
			id = event.target.id
			$('#'+id).parent().animate
				'border-color' : '#333333'
			, 100
			$('#'+event.target.id).parent().popover 'destroy'

		$('#app_container').on 'focusout', 'input, textarea', (event) ->
			id = event.target.id
			$('#'+id).parent().animate
				'border-color' : '#999999'
			, 100
			
		$('#app_container').on 'keyup', '#contact_email_address', (event) ->
			email_address = $('#contact_email_address').val()
			if email_address != ""
				isEmail = emailCheck email_address
				if isEmail == true
					$('#contact_email_symbol_container').html "<i class=\"icon-ok\"></i>"
				else
					$('#contact_email_symbol_container').html "<i class=\"icon-remove\"></i>"
			else
				$('#contact_email_symbol_container').html ""
				
		$('#app_container').on 'click', '#submit_contact_us_button', (event) ->
			email_address = $('#contact_email_address').val()
			full_name = $('#full_name').val()
			message_subject = $('#message_subject').val()
			message_body = $('#message_body').val()
			
			if email_address == ""
				createPopover '#contact_email_container', "Please enter your email address."
			else if emailCheck(email_address) == false
				createPopover '#contact_email_container', "Your email address is invalid."
			else if full_name == ""
				createPopover '#full_name_container', "Please give your name."
			else if message_subject == ""
				createPopover '#message_subject_container', "Please give your message subject."
			else if message_body = ""
				createPopover '#message_body_container', "Please give your message body."
			else

				isLoading = true
				isTimerDone = false
				toggleSubmit isLoading
				$(this).doTimeout 'change_button', 300, ->
					isTimerDone = true
					if isLoading == false
						toggleSubmit isLoading
						
				data =
					email_address : $('#contact_email_address').val()
					full_name : $('#full_name').val()
					message_subject : $('#message_subject').val()
					message_body : $('#message_body').val()
				
				$.post '/main/contact', data, (json) ->
					isLoading = false
					if isTimerDone == true
						toggleSubmit isLoading
					
					response = $.parseJSON json
					if response.status == "success"
						$('.alert-success').css 'display', 'inline'
						$('.alert-success').animate
							'opacity' : 1
						, 300
					else
						$('.alert-error').css 'display', 'inline'
						$('.alert-error').animate
							'opacity' : 1
						, 300
					
					$('#app_container').off 'click', '#submit_contact_us_button'
					$('#contact_container label, #submit_contact_us_button, #message_body_container, #contact_email_container, #contact_email_symbol_container, #full_name_container, #message_subject_container').animate
						'opacity' : 0.4
					, 300
					$('#contact_container input, #contact_container textarea').prop 'disabled', true
					
		$('#projects_link').trigger 'click'