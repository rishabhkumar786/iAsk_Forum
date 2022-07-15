$(document).on('submit', '.answer_form', function() {

    var formID = $(this).closest("form").attr("id"); //imp
    // var x = document.getElementById(formID).elements.length;  this will give id of form
    // console.log(x);
    var text_answer = document.getElementById(formID).elements.namedItem("textanswer").value;
    var question_id_from_form = document.getElementById(formID).elements.namedItem("question_id").value;
    document.getElementById('answer_post_button' + question_id_from_form).innerHTML = "posted!!";

    $.ajax({
        url: "/Login System/php/question_bank_answer_submit.php",
        type: "POST",
        data: { reg: "success", type1: text_answer, type2: question_id_from_form },

    });

    setTimeout(function() {
        document.getElementById(formID).reset();
        document.getElementById('answer_post_button' + question_id_from_form).innerHTML = ' <button type="submit" class="mt-2 btn btn-primary answer_submitt_button">Post</button>';
    }, 1000);
});



$('.accept_request').click(function() {
    // console.log("in");
    var receiver_id = $(this).closest(".accept_request").attr("id");
    var sender_id = $(this).closest(".accept_request").attr("name");

    // console.log(receiver_id);
    // console.log(sender_id);

    // console.log("out");

    $.ajax({
        url: "/Login System/php/request.php",
        type: "POST",
        data: { reg: "acceptrequest", type1: sender_id, type2: receiver_id },

    });

});

$('.delete_request').click(function() {
    // console.log("in");
    var receiver_id = $(this).closest(".delete_request").attr("id");
    var sender_id = $(this).closest(".delete_request").attr("name");

    // console.log(receiver_id);
    // console.log(sender_id);

    // console.log("out");
    $.ajax({
        url: "/Login System/php/request.php",
        type: "POST",
        data: { reg: "deleterequest", type1: sender_id, type2: receiver_id },

    });
});

$(".answer_submitt_button").click(function() {
    $(this).parent("form").submit();
});

$('.downvote').on({
    'click': function() {
        var id = $(this).closest(".downvote").attr("id");
        var sub_id = id.substring(9);
        //console.log(sub_id);
        document.getElementById('span_' + sub_id).innerHTML = '<img width="30" height="30" src="essential/downvote_set.png"></i>';
    }
});

$('.followbutton').click(function() {
    var receiver_id = $(this).closest(".followbutton").attr("id");
    var sender_id = $(this).closest(".followbutton").attr("name");



    $(this).text(function(_, text) {
        return text === "+Follow" ? "Unfollow" : "+Follow";
    });
    if ($(this).text() == "+Follow") {
        $(this).removeClass('unfollow');
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-success');
        // console.log("in follow");
        $.ajax({
            url: "/Login System/php/request.php",
            type: "POST",
            data: { reg: "cancelrequest", type1: sender_id, type2: receiver_id },

        });
    } else if ($(this).text() == "Unfollow") {
        $(this).addClass('unfollow');
        $(this).addClass('btn-primary');
        $(this).removeClass('btn-success');
        // console.log("in unfollow");
        // console.log(receiver_id);
        // console.log(sender_id);

        $.ajax({
            url: "/Login System/php/request.php",
            type: "POST",
            data: { reg: "torequest", type1: sender_id, type2: receiver_id },

        });

    }
});