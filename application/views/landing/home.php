
<div id="landing">
    <div class="container">
        <div class="row">
            <div class="span5">
                <h1>Daycare management made easy!</h1>
                <p>
                    Manage your daycare center with a secure online system.
                    <?php echo $this->conf->settings()->name; ?> allows you to keep a register of children enrolled, billing, emergency contacts, individuals authorized to
                    pickup with ability to upload their photo and set unique pin of each for safety of the children.
                </p>
                <p><a href="<?php echo site_url('register'); ?>" class="btn btn-primary btn-action register-link">Get Started Now</a></p>
            </div>
            <div class="span7">

            </div>
        </div>
    </div>
</div>

<div id="content" class="txt-middle">
    <div class="container">
        <!--div class="row">
            <div class="span12">
                <h2>Features</h2>
                <hr class="dashed">
            </div>
        </div-->
        <div class="row">
            <div class="span4 bouncy">
                <div class="icon_wrapper">
                    <i class="glyphicons-display animated"></i>
                </div>
                <h2>Neat design</h2>
                <p><?php echo $this->conf->settings()->name; ?> is built on the awesome frontend framework Bootstrap for an easy and impressive access to all features</p>
            </div>
            <div class="span4 bouncy">
                <div class="icon_wrapper">
                    <i class="glyphicons-font animated"></i>
                </div>
                <h2>Easy to learn and use</h2>
                <p>Here at iCoolPix Designs, we do all the heavy work so you don't have to. Just register/login and start working. It is that easy! </p>
            </div>
            <div class="span4 bouncy">
                <div class="icon_wrapper">
                    <i class="glyphicons-airplane animated"></i>
                </div>
                <h2>Continuous upgrades</h2>
                <p>
                    We hear you! You want a feature, bug fixed, or just saying hi... we are on it! Even if it's just saying hi back.
                    Your thoughts matter to us, so say something.
                </p>
            </div>
        </div>
        <hr class="dashed">
        <!--div class="row">
            <div class="span4">
                <a class="thumbnail" href="">
                    <img alt="image" src="http://quickimage.it/400x200">
                </a>
                <h2>Image 1</h2>
                <p>Optional subtext to help better explain the image above can go here.</p>
            </div>
            <div class="span4">
                <a class="thumbnail" href="">
                    <img alt="image" src="http://quickimage.it/400x200">
                </a>
                <h2>Image 2</h2>
                <p>Optional subtext to help better explain the image above can go here.</p>
            </div>
            <div class="span4">
                <a class="thumbnail" href="">
                    <img alt="image" src="http://quickimage.it/400x200">
                </a>
                <h2>Image 3</h2>
                <p>Optional subtext to help better explain the image above can go here.</p>
            </div>
        </div-->
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.register-link').click(function(){
            $('.pg-content').load('<?php echo site_url('dashboard/load/register'); ?>')
        });

    });
</script>