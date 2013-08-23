<div id='contact_container'>
  <div class='row-fluid title-frame'>
    <div class='span12'>
      <h2>
        Get in touch
      </h2>
      <?php
      	echo $this->Form->create("Contact_us", array("id" => "Contact_us", "url" => array("controller" => "main", "action" => "contact"), 'class'=>'form-horizontal')); 
      ?>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span10'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='span6 left-frame'>
            <label class='control-label' for='email_address'>
              Email:
            </label>
          </div>
          <div class='span6 right-frame'>
            <div class='controls'>
              <input id='contact_email_address' name='email_address' placeholder='Email address' type='text'>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class='span2'>
      <div class='contact_email_symbol'></div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span12'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='span6 left-frame'>
            <label class='control-label' for='full_name'>
              Name:
            </label>
          </div>
          <div class='span6 right-frame'>
            <div class='controls'>
              <input id='full_name' name='full_name' placeholder='Name' type='text'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span12'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='span6 left-frame'>
            <label class='control-label' for='message_subject'>
              Subject:
            </label>
          </div>
          <div class='span6 right-frame'>
            <div class='controls'>
              <input id='message_subject' name='message_subject' placeholder='Subject' type='text'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span12'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='span6 left-frame'>
            <label class='control-label' for='message_body'>
              Message:
            </label>
          </div>
          <div class='span6 right-frame'>
            <div class='controls'>
              <textarea id='message_body' name='message_body' placeholder='Message' rows='5'></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span12'>
      <div id='submit_contact_us_link'>
        Send
      </div>
    </div>
  </div>
</div>
