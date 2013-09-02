<div class='row-fluid'>
  <div class='span6'>
    <div class='title-container'>
      <h2>
        <%= title %>
      </h2>
    </div>
  </div>
  <div class='span2'>
    <div class='live-link-container'>
      <?php
      	//<a href="<%= live_site_url %>">
      ?>
      <a href="#">
      	<% if(live_site_url != "") { %>
      		<div id="live_link_button">
      			<h4>
      				View live site <i class="icon-share icon-white"></i>
      		</h4>
      	<% } %>
      	</div>
      </a>
    </div>
  </div>
</div>
<div class='row-fluid'>
  <div class='span10'>
    <div class='row-fluid'>
      <div class='span10'>
        <div class='row-fluid'>
          <div class='span10'>
            <div class='image-outer-container'>
              <div class='image-inner-container'>
                <img id="main_image" src="<%= image_url %>" />
              </div>
            </div>
          </div>
        </div>
        <div class='row-fluid'>
          <div class='span10'>
            <div class='body-container'>
              <%= body %>
            </div>
          </div>
        </div>
        <div class='row-fluid'>
          <div class='span10'>
            <div id='technology-container'>
              <div class='row-fluid languages'>
                <div class='span2'>
                  Languages:
                </div>
                <div class='span8'>
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
                <div class='span8'>
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
                <div class='span8'>
                  <ul class='thumbnails'>
                    	<% if (!(tools['tool'] instanceof Array)) { %>
                    		<% if(tools['tool'] != undefined) { console.log(tools['tool']);%>
                    			<li class="thumbnail"><%= tools['tool'] %></li>
                    	<% 	}
                    	 } else {
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
                <div class='span8'>
                  <ul class='thumbnails'>
                    <% if (!(others['other'] instanceof Array)) { %>
                    	<li class="thumbnail"><%= others['other'] %></li>
                    <% } else {
                    	_.each(others['other'], function(item) { %>
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
