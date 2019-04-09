function answerUpvote(answerId) {
    console.log("Upvote data:" + answerId);
    var dataToSend = "aid=" + answerId + "&vote=Upvote";
    console.log(dataToSend);
    $.ajax({
        type: "POST",
        url: "aupdown.php",
        data: dataToSend,
        success: function(data) {
            location.reload();
        }
    });
};

function answerDownvote(answerId) {
    console.log("AnswerId for downvote: "+ answerId);
    var dataToSend = "aid=" + answerId + "&vote=Downvote";
    $.ajax({
        type: "POST",
        url: "aupdown.php",
        data: dataToSend,
        success: function(data) {
            location.reload();   
        }
    });
};

$("document").ready(function() {
    var qno = parseInt($("#qno").text());
    $.ajax({
      type: "POST",
      url: "qcheckud.php",
      data: "q="+qno,
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
                url: "qupdown.php",
                data: "q=" + qno + "&vote=Upvote",
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
                url: "qupdown.php",
                data: "q=" + qno + "&vote=Downvote",
                success: function(data) {
                    location.reload();
                }
            });
        }
    );
});