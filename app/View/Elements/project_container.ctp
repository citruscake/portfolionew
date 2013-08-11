<div class='row-fluid'>
  <div class='span8'>
    <div class='title-container'>
      <h2>
        <%= title %>
      </h2>
    </div>
  </div>
  <div class='span4'>
    <div class='live-link-container'>
      <a href="<%= live_site_url %>">
      	<div id ="live-link-button">
      		<h4>
      			View Live Site >
      		</h4>
      	</div>
      </a>
    </div>
  </div>
</div>
<div class='row-fluid'>
  <div class='span12'>
    <div class='row-fluid'>
      <div class='span12'>
        <div class='row-fluid'>
          <div class='span12'>
            <div class='image-outer-container'>
              <div class='image-inner-container'>
                <img id="main_image" src="<%= image_url[0] %>" />
              </div>
            </div>
          </div>
        </div>
        <!-- /.row-fluid -->
        <!-- /	.span12 -->
        <!-- /		.alts-outer-container -->
        <!-- /			.alts-inner-container -->
        <!-- /				.row-fluid -->
        <!-- /					:plain -->
        <!-- /						<% _.each(image_url, function(url) { %> -->
        <!-- /							<div class="alt-frame span1" style="background-image:url('<%= url %>')"> -->
        <!-- /							</div> -->
        <!-- /						<% }); %> -->
        <div class='row-fluid'>
          <div class='span12'>
            <div class='body-container'>
              <%= body %>
            </div>
          </div>
        </div>
        <div class='row-fluid'>
          <div class='span12'>
            <div class='technology-container'>
              <div class='row-fluid languages'>
                <div class='span2'>
                  Languages:
                </div>
                <div class='span10'>
                  <ul class='thumbnails'>
                    <% if (!(languages['language'] instanceof Array)) { %>
                    	<li class="thumbnail"><%= languages['language'] %></li>
                    <% } else {
                    	_.each(languages['language'], function(item) { %>
                    		<li class="thumbnail"><%= item %></li>
                    	<% }); 
                    } %>
                  </ul>
                </div>
              </div>
              <div class='row-fluid libraries'>
                <div class='span2'>
                  Libraries:
                </div>
                <div class='span10'>
                  <ul class='thumbnails'>
                    <% if (!(libraries['library'] instanceof Array)) { %>
                    	<li class="thumbnail"><%= libraries['library'] %></li>
                    <% } else {
                    	_.each(libraries['library'], function(item) { %>
                    		<li class="thumbnail"><%= item %></li>
                    	<% }); 
                    } %>
                  </ul>
                </div>
              </div>
              <div class='row-fluid tools'>
                <div class='span2'>
                  Tools:
                </div>
                <div class='span10'>
                  <ul class='thumbnails'>
                    <% if (!(tools['tool'] instanceof Array)) { %>
                    	<li class="thumbnail"><%= tools['tools'] %></li>
                    <% } else {
                    _.each(tools['tool'], function(item) { %>
                    	<li class="thumbnail"><%= item %></li>
                    	<% });
                    } %>
                  </ul>
                </div>
              </div>
              <div class='row-fluid others'>
                <div class='span2'>
                  Other:
                </div>
                <div class='span10'>
                  <ul class='thumbnails'>
                    <% if (!(others['other'] instanceof Array)) { %>
                    	<li class="thumbnail"><%= others['other'] %></li>
                    <% } else {
                    	_.each(others.other, function(item) { %>
                    		<li class="thumbnail"><%= item %></li>
                    	<% }); 
                    } %>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
