function commentUpvote(commentId) {
    console.log("Upvote data:" + commentId);
    var dataToSend = "commentid=" + commentId + "&vote=Upvote";
    console.log(dataToSend);
    $.ajax({
        type: "POST",
        url: "commentupdown.php",
        data: dataToSend,
        success: function(data) {
            location.reload();
        }
    });
};

function commentDownvote(commentId) {
    console.log("commentId for downvote: "+ commentId);
    var dataToSend = "commentid=" + commentId + "&vote=Downvote";
    $.ajax({
        type: "POST",
        url: "commentupdown.php",
        data: dataToSend,
        success: function(data) {
            location.reload();   
        }
    });
};

$("document").ready(function() {
    var articleid = parseInt($("#articleid").text());
    $.ajax({
      type: "POST",
      url: "articlecheckud.php",
      data: "articleid="+articleid,
      success: function(data){
        if (data == "Upvoted") {
          console.log("Upvoted style");
          $("#upvote").attr("style", "background: rgba(0,255,0,0.7);");
        }
        else if (data == "Downvoted") {
          console.log("Downvoted style");
          $("#downvote").attr("style", "background: rgba(255,0,0,0.7);");
        }
        else {
          console.log("Resetted style");
          $("#upvote").attr("style", "background: white;");
          $("#downvote").attr("style", "background: white;");
        }
        console.log(data);
      }
    });
    $("#upvote").click(
        function() {
            console.log("Upvote question");
            $.ajax({
                type: "POST",
                url: "articleupdown.php",
                data: "articleid=" + articleid + "&vote=Upvote",
                success: function(data) {
                    location.reload();
                }
            });
        }
    );
    $("#downvote").click(
        function() {
            console.log("Downvote");
            $.ajax({
                type: "POST",
                url: "articleupdown.php",
                data: "articleid=" + articleid + "&vote=Downvote",
                success: function(data) {
                    location.reload();
                }
            });
        }
    );
});