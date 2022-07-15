function likes(param1, param2) {

    $.ajax({
        url: "/Login System/php/likes.php",
        type: "POST",
        data: { reg: "success", type1: param1, type2: param2 },
        success: function(data) {
            document.getElementById('l' + param1).innerHTML = param2 + 1;
        }
    });
}

function dislikes(param1, param2) {

    $.ajax({
        url: "/Login System/php/dislikes.php",
        type: "POST",
        data: { reg: "success", type1: param1, type2: param2 },
        success: function(data) {
            document.getElementById('d' + param1).innerHTML = param2 + 1;
        }
    });
}

function share_post(param1, param2) {

    $.ajax({
        url: "/Login System/php/dislikes.php",
        type: "POST",
        data: { reg: "share", type1: param1, type2: param2 },
        success: function(data) {
            document.getElementById('d' + param1).innerHTML = "Shared";
        }
    });
}

function create_thread() {

    $.ajax({
        url: "/Login System/create_new_thread.php",
        type: "POST",
        data: { reg: "proceed" },
        success: function(data) {
            console.log("succ");
        }
    });
}

function upvote(param1, param2) {

    $.ajax({
        url: "/Login System/php/upvote.php",
        type: "POST",
        data: { reg: "success", type1: param1, type2: param2 },
        success: function(data) {
            document.getElementById('u' + param1).innerHTML = param2 + 1;
        }
    });
}

function downvote(param1, param2) {

    $.ajax({
        url: "/Login System/php/downvote.php",
        type: "POST",
        data: { reg: "success", type1: param1, type2: param2 },
        success: function(data) {
            document.getElementById('dd' + param1).innerHTML = param2 - 1;
        }
    });
}

function accept_req(param1, param2) {
    console.log("has reached function");
    $.ajax({
        url: "/Login System/php/request_handler.php",
        type: "POST",
        data: { reg: "acc", type1: param1, type2: param2 },
        success: function(data) {
            location.reload();
        }
    });
}

function delete_req(param1, param2) {
    console.log("has reached function");
    $.ajax({
        url: "/Login System/php/request_handler.php",
        type: "POST",
        data: { reg: "dle", type1: param1, type2: param2 },
        success: function(data) {
            location.reload();
        }
    });
}