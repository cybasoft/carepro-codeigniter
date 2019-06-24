$(document).ready(function() {
    $('.daycare_register').submit(function(e) {
        e.target.checkValidity();
        $('.loading_div').show();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img_preview').attr('src', e.target.result);
                $("#avatar").attr('value', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".user-edit-fileinput").change(function() {
        $("#img_preview").attr("src", "");
        $("#img_preview").removeClass("mr-3");
        $("#img_preview").addClass("d-block");
        $("#img_div").addClass("ml-3");
        $("#edit_image").val('');
        $("#customer_image").val('');
        $("#profile_image").val('');
        readURL(this);
    });
    $(".reset_btn").click(function() {
        $("#avatar").attr('value', '');
        $("#edit_image").val('');
        $("#customer_image").val('');
        $("#profile_image").val('');
        $("#img_preview").attr('src', '../assets/img/daycare/default-user-image.png');
    });

    $(".notifictions").delay(2000).hide("slide", {
        direction: "right"
    }, 5000);
});