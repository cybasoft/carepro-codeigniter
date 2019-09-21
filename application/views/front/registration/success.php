<?php $this->load->view("front/registration/header");  ?>


<body>
<style>
    .card-header {
        background-color: #5CBDEA;
    }

    .email_img {
        width: 100px;
    }

    p {
        color: #5a5757;
    }

    span {
        color: #EB6C6A;
        font-weight: 700;
    }
    .card-body{
        font-family: Verdana;
    }
</style>
<div class="container">
        <div class="row mt-5 pt-3">
            <div class="card offset-sm-3 col-sm-6 mt-5 p-0">
                <div class="card-header text-center">
                    <img src="/assets/img/content/mail-1454731_960_720.png" class="email_img">
                </div>
                <div class="card-body">
                    <h5>Hello <?php echo $user_name ?>,</h5>
                    <p>Thanks for signing up for CarePRO. We're very excited to have you on board.<br />
                        To get started, </p>

                    <h5 class="text-center">Please check your email to confirm your account.</h5><br />
                    Thanks,<br />
                    <span>Daycare Team</span>
                </div>
            </div>
        </div>
    </div>
</body>

<?php $this->load->view("front/registration/footer");  ?>