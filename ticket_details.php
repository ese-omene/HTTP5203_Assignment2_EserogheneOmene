<?php
session_start();

//var_dump($_SESSION['userID']);

$id = $_SESSION['id']; // ticket ID
$user = $_SESSION['userID']; //user ID


//print $id;

if(!isset($_SESSION['id'])){
    header('Location: index.php');
} else {

    $xmldoc = new DOMDocument();

    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    $id = $_SESSION['id'];
    $ticketXml = simplexml_load_file("xml/tickets.xml");
    $ticketDetails = $ticketXml->xpath("/tickets/ticket[id='$id']/message");

    $userRole = simplexml_load_file('xml/users.xml');
    $role = $userRole->xpath("/users/user[id='$user']/role");

    if (isset($_POST['ticketDetails'])){

        $desc = $_POST['message'];
        $date = $_POST['date'];
      //  var_dump($desc);
        //var_dump($date);
        //var_dump($user);
        $newMsg = $ticketXml->ticket->addChild('message');
        $newDesc = $newMsg->addChild('description', $desc);
        $newDate = $newMsg->addChild('date', $date);
        $newUserID = $newMsg->addChild('userid', $user);
        $ticketXml->saveXML('xml/tickets.xml');


       if ($role =='user'){
           header('location:userTickets.php');
       } else {
           header('location:staffTickets.php');
       }




       // $xmldoc->load('xml/tickets.xml');
        //$tickets = $xmldoc->getElementsByTagName('ticket');

//        $newTicket = $xmldoc->createElement('ticket');//<ticket>
//        $newMessage = $xmldoc->createElement('message');//<message>
//        $newDescription = $xmldoc->createElement('description', $desc);//<description>
//        $newDate = $xmldoc->createElement('date', $date);//<date>
//        $newUser = $xmldoc->createElement('userid', $user);//<userid>
//        $newMessage->appendChild($newDescription);
//        $newMessage->appendChild($newDate);
//        $newMessage->appendChild($newUser);
//        $newTicket->appendChild($newMessage);
//
//        $xmldoc->save('xml/tickets.xml');





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
<header><h1 class="jumbotron"> Management for Ticket #<?=$id?> </h1> </header>
<body>

    <div class="card">
        <h5 class="card-header">Message Log</h5>
        <div class="card-body">


            <?php foreach($ticketDetails as $description){?>
                <h5 class="card-title">Date:  <?=$description->date ?></h5>
            <p class="card-text">Description: <?=$description->description ?></p>
                <h6 class="card-subtext">Logged by: user <?=$description->userid ?></h6>
            <?php }?>


            <div class="card">
                <h5 class="card-header">New Messages</h5>
                <div class="card-body">
            <form action=" " method="post">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD">
                </div>
                <div class="form-group">
                    <label for="message">New Message</label>

                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                <input type="hidden" name="id" value="<?=$id?>" />
                <input type="hidden" name="userID" value="<?=$user?>" />
                <input type="submit" class="button btn btn-primary" name="ticketDetails" value="Submit" />
            </form>
                </div>
            </div>



        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>

