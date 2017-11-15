

<!--NOTE: The Trello client library has been included as a Managed Resource.  To include the client library in your own code, you would include jQuery and then

<script src="https://api.trello.com/1/client.js?key=your_application_key">...

See https://trello.com/docs for a list of available API URLs

The API development board is at https://trello.com/api

The &dummy=.js part of the managed resource URL is required per http:doc.jsfiddle.net/basic/introduction.html#add-resources-->

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- ...  -->

  <!-- The client library requires jQuery  -->
  <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="https://api.trello.com/1/client.js?key=a2a93deccc7064def5f5011c2e9810d6"></script>
<style type="text/css">
    body {
    font-family: arial;
    font-size: 12px;
}

#loggedout {
    text-align: center;
    font-size: 20px;
    padding-top: 30px;
}
#loggedin { 
    display: none; 
}

#header {
    padding: 4px;
    border-bottom: 1px solid #000;
    background: #eee;
}

#output {
    padding: 4px;
}

.card { 
    display: block; 
    padding: 2px;
}
</style>
  <!-- ...  -->
</head>
<body>
    <div id="loggedout">
    <a id="connectLink" href="#">Connect To Trello</a>
</div>

<div id="loggedin">
    <div id="header">
        Logged in to as <span id="fullName"></span> 
        <a id="disconnect" href="#">Log Out</a>
    </div>
    
    <div id="output"></div>
</div>    
</body>
<script type="text/javascript">
    var onAuthorize = function() {
    updateLoggedIn();
    $("#output").empty();
    
    Trello.members.get("me", function(member){
        $("#fullName").text(member.fullName);
    
        var $cards = $("<div>")
            .text("Loading Cards...")
            .appendTo("#output");

        // Output a list of all of the cards that the member 
        // is assigned to
        Trello.get("members/me/cards", function(cards) {
            $cards.empty();
            $.each(cards, function(ix, card) {
                $("<a>")
                .attr({href: card.url, target: "trello"})
                .addClass("card")
                .text(card.name)
                .appendTo($cards);
            });  
        });
    });

};

var updateLoggedIn = function() {
    var isLoggedIn = Trello.authorized();
    $("#loggedout").toggle(!isLoggedIn);
    $("#loggedin").toggle(isLoggedIn);        
};
    
var logout = function() {
    Trello.deauthorize();
    updateLoggedIn();
};
                          
Trello.authorize({
    interactive:false,
    success: onAuthorize
});

$("#connectLink")
.click(function(){
    Trello.authorize({
        type: "popup",
        success: onAuthorize
    })
});
    
$("#disconnect").click(logout);

</script>
</html>
