$(document).ready(function () {

    (function ($) {
        "use strict";


        jQuery.validator.addMethod('answercheck', function (value, element) {
            return this.optional(element) || /^\bcat\b$/.test(value)
        }, "type the correct answer -_-");

        // validate contactForm form
        $(function () {
            $('#contactForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },

                    phone: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 20
                    },
                    captcha:{
                        required:true,
                        equalTo:'#captcha_valid'
                    }
                },
                messages: {
                    name: {
                        required: "<strong class='text-danger'>Please enter your name</strong>",
                        minlength: "<span class='text-danger'>Name is too short</span>"
                    },
                    phone: {
                        required: "<strong class='text-danger'>Please enter phone number</strong>",
                        minlength: "<span class='text-danger'>Number is too short</span>"
                    },
                    email: {
                        required: "<strong class='text-danger'>Please enter email</strong>",
                        email:'<span class="text-danger">Please enter valid email</span>'
                    },
                    message: {
                        required: "<strong class='text-danger'>Please enter a message</strong>",
                        minlength: "<span class='text-danger'>Message is too short</span>'"
                    },
                    captcha:{
                        required:"<strong class='text-danger'>Enter captcha</strong>",
                        equalTo:'<span class="text-danger">Invalid captcha</span>'
                    }
                },
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        data: $(form).serialize(),
                        url: "/contact",
                        success: function () {
                            $('#contactForm :input').attr('disabled', 'disabled');
                            $('#contactForm').fadeTo("slow", 1, function () {
                                $(this).find(':input').attr('disabled', 'disabled');
                                $(this).find('label').css('cursor', 'default');
                                $('#success').fadeIn()
                                $('.modal').modal('hide');
                                $('#success').modal('show');
                            })
                        },
                        error: function () {
                            $('#contactForm').fadeTo("slow", 1, function () {
                                $('#error').fadeIn()
                                $('.modal').modal('hide');
                                $('#error').modal('show');
                            })
                        }
                    })
                }
            })
        })

    })(jQuery)
})