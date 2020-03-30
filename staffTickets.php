<?php
session_start();
if(!isset($_SESSION['username'])){
    header ('Location: index.php');
} else
    {

    $xmldoc = new DOMDocument();

    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    $xmldoc->load('xml/tickets.xml');
    $tickets = $xmldoc->getElementsByTagName("ticket");





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
<header><h1 class="jumbotron">Support Staff Ticket Management</h1> </header>
<body>
<?php for ($i = 0; $i<$tickets->length; $i++){ ?>
<div class="card">
    <h5 class="card-header">Ticket # <?= $tickets->item($i)->getElementsByTagName("id")[0]->textContent?></h5>
    <div class="card-body">
        <h5 class="card-title">Status: <?= $tickets->item($i)->getElementsByTagName("status")[0]->textContent?></h5>
        <p class="card-text">Description: <?= $tickets->item($i)->getElementsByTagName("description")[0]->textContent?></p>
        <a href="#" class="btn btn-primary">Details</a>
    </div>
</div>
<?php }?>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
