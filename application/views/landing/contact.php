<div id="header">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h1>Contact Us</h1>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
			<div class="span2"></div>
            <div class="span5">
                <h2><i class="glyphicons-envelope"></i> Email Us</h2>
				<?php echo form_open('landing/send_mail'); ?>
                <fieldset>
                    <div class="control-group">
                        <div class="controls">
                            <input class="span5" name="name" type="text" placeholder="Your Full Name">
                        </div>
                        <div class="controls">
                            <input class="span5" name="email" type="email" placeholder="Your Email">
                        </div>
                        <div class="controls">
                            <input class="span5" name="subject" type="text" placeholder="Message Subject">
                        </div>
                        <div class="controls">
                            <textarea class="span5 textarea" name="message" id="textarea" rows="6" placeholder="Your Message"></textarea>
                        </div>
                        <button class="btn btn-primary">Send Message</button>
                    </div>
                </fieldset>
				<?php echo form_close(); ?>
            </div>
            <!--div class="span5">
                        <h2><i class="glyphicons-google_maps"></i> Address</h2>
                        <address>
                           <?php echo $this->conf->settings()->street; ?>
                            <br>
							<?php echo $this->conf->settings()->city; ?>,
							<?php echo $this->conf->settings()->state; ?>
							<?php echo $this->conf->settings()->zip; ?>
                        </address>
						<hr/>
                        <h2><i class="glyphicons-phone"></i> Phone</h2>
                        <address>
                            Phone: <?php echo $this->conf->settings()->phone; ?>
                            <br>
                            Fax: <?php echo $this->conf->settings()->fax; ?>
                        </address>
                    </div-->
                <!--div class="thumbnail map">
                    <iframe style="width: 100%; height: 100%; border: none;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Newport,+RI,+United+States&amp;aq=2&amp;oq=newport,+United+States&amp;sll=37.371249,-122.03476&amp;sspn=0.053887,0.077162&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=Newport,+Rhode+Island&amp;ll=41.490102,-71.312828&amp;spn=0.068905,0.154324&amp;z=13&amp;output=embed"></iframe>
                </div-->
        </div>
    </div>
</div>
