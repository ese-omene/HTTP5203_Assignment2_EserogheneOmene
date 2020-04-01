<?php

session_start();
if(!isset($_SESSION['username'])){
    header ('Location: index.php');
} else {



    $xmldoc = new DOMDocument();

    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

   // $xmldoc->load('xml/tickets.xml');
  //  $tickets = $xmldoc->getElementsByTagName("ticket");
    $username = $_SESSION['username'];




    $userXml = simplexml_load_file("xml/users.xml");
    $ticketXml = simplexml_load_file("xml/tickets.xml");

    $userUserID = $userXml->xpath("/users/user[username='$username']/id");
  //  print_r($userUserID);
    $user = (string)$userUserID[0];
    $userFName = $userXml->xpath("/users/user[username='$username']/name/firstname ");
    $userLName = $userXml->xpath("/users/user[username='$username']/name/lastname ");
    $firstname = (string)$userFName[0];
    $lastname = (string)$userLName[0];



   // $ticketUserID = $ticketXml->xpath("/tickets/ticket[userid='$user']");
    //var_dump($ticketUserID);
   // $ticket = (string)$ticketUserID;



    $ticketDetails = $ticketXml->xpath("/tickets/ticket[message[userid='$user']]");
   // print_r($ticketDetails);
   if (isset($_POST['ticketDetails'])){
       $id = $_POST['id'];
       $_SESSION['id'] = $id;

       var_dump($id);
       var_dump($_SESSION['id']);
       header('Location: ticket_details.php');

   }

}
?>
<! DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <title>Ticketing System</title>
</head>
<header><h1 class="jumbotron">Ticket Management for <?=$firstname." ".$lastname?> </h1> </header>
<body>
<?php foreach($ticketDetails as $detail){?>
    <div class="card">
        <h5 class="card-header">Ticket # <?=$detail->id?></h5>
        <div class="card-body">
            <h5 class="card-title">Date:<?=$detail->message->date?> </h5>
            <p class="card-text">Description: <?=$detail->message->description?></p>

            <form action=" " method="post">
                <input type="hidden" name="id" value="<?=$detail->id?>" />
                <input type="submit" class="button btn btn-primary" name="ticketDetails" value="Details" />
            </form>
        </div>
    </div>
<?php }?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
