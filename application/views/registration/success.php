<?php  $this->load->view("custom_layouts/header");  ?>
</head>
<body>
<?php if (!empty($this->session->flashdata('verify_email'))) : ?>
                        <div class="alert alert-primary alert-dismissable col-8 offset-2 mt-5">
                            <?php echo $this->session->flashdata('verify_email'); ?>
                        </div>
                    <?php endif; ?>
</body>
</html>
