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
        var base_url = $(this).data("site-url");
        $("#avatar").attr('value', '');
        $("#edit_image").val('');
        $("#customer_image").val('');
        $("#profile_image").val('');
        $("#img_preview").attr('src', base_url + 'assets/img/content/default-user-image.png');
    });

    $(".notifictions").delay(2000).hide("slide", {
        direction: "right"
    }, 5000);

    $("#stripe_toggle").click(function(){
        var checkBoxes = $("input[name=stripe_toggle]");
        if(checkBoxes.prop("checked") == false){
            if($(".live_stripe").hasClass('d-none')){
                $(".live_stripe").removeClass('d-none');
                $(".test_stripe").addClass('d-none');
            }
        }else if(checkBoxes.prop("checked") == true){
            if($(".test_stripe").hasClass('d-none')){
                $(".test_stripe").removeClass('d-none');
                $(".live_stripe").addClass('d-none');
            }
        }
    });
});