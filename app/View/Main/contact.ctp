<div id='contact_container'>
  <div class='row-fluid title-frame'>
    <div class='span10'>
      <h2>
        Get in touch
      </h2>
      <?php
      	echo $this->Form->create("Contact_us", array("id" => "Contact_us", "url" => array("controller" => "main", "action" => "contact"), 'class'=>'form-horizontal')); 
      ?>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span8'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='left-frame'>
            <label class='control-label' for='email_address'>
              Email:
            </label>
          </div>
          <div class='right-frame'>
            <div class='controls'>
              <div id='contact_email_container'>
                <input id='contact_email_address' name='email_address' placeholder='Email address' type='text'>
              </div>
            </div>
            <div id='contact_email_symbol_container'></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span10'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='left-frame'>
            <label class='control-label' for='full_name'>
              Name:
            </label>
          </div>
          <div class='right-frame'>
            <div class='controls'>
              <div id='full_name_container'>
                <input id='full_name' name='full_name' placeholder='Name' type='text'>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span10'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='left-frame'>
            <label class='control-label' for='message_subject'>
              Subject:
            </label>
          </div>
          <div class='right-frame'>
            <div class='controls'>
              <div id='message_subject_container'>
                <input id='message_subject' name='message_subject' placeholder='Subject' type='text'>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span10'>
      <div class='control-group'>
        <div class='row-fluid'>
          <div class='left-frame'>
            <label class='control-label' for='message_body'>
              Message:
            </label>
          </div>
          <div class='right-frame'>
            <div class='controls'>
              <div id='message_body_container'>
                <textarea id='message_body' name='message_body' placeholder='Message' rows='5'></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span10'>
      <div id='submit_contact_us_container'>
        <div id='submit_contact_us_button'>
          Send
          <i class='icon-envelope icon-white'></i>
        </div>
      </div>
    </div>
  </div>
  <div class='row-fluid form-row'>
    <div class='span10'>
      <div class='alert alert-success'>
        <em>
          Success!
        </em>
        Thank you for your message, I'll be in contact soon.
      </div>
      <div class='alert alert-error'>
        <em>
          Error!
        </em>
        The message could not be sent. You can try contacting me at efblundell[at]hotmail.co.uk instead.
      </div>
    </div>
  </div>
</div>
