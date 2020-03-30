<?php
$username = "";
$password = "";
$userError = "";
if(isset($_POST['formSubmit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
     if ($username == "" || $password == ""){
         $userError = "please  complete the form";
     } else {

         $xmlUser = new DOMDocument();

         //nice formatting

         $xmlUser->preserveWhiteSpace = false;
         $xmlUser -> formatOutput = true;

         //load my xml file

         $xmlUser -> load('users.xml');

         //DOM list
        $users = $xmlUser->getElementsByTagName('user');

        //DOMXPath
         $userXPath = new DOMXPath($xmlUser);
         $query =   "users/user[username='$username' and password='$password']/role  ";
       //DOM List of logged in user
       $login = $userXPath->evaluate($query);

       if ($login == 'user'){
           header("Location: user.php");
       } else {
           header ("Location: staff.php");
       }



         //print the XML FILE

        /*for ($i = 0 ; $i < $users->length; $i++) {
            $validUser = $users->item($i)->getElementsByTagName('username')[0]->textContent;
             $validPassword = $users->item($i)->getElementsByTagName('password')[0]->textContent;
            $role = $users->item($i)->getElementsByTagName('role')[0]->textContent;

             if ($username == $validUser and $password == $validPassword){

                 for ($i = 0; $i < $tickets->length; $i++){
                     if($role == 'user')

                     $userID = $users->item($i)->getElementsByTagName('id')[0]->textContent;
                   $ticketID =  $tickets->item($i)->getElementsByTagName('userid')[0]->textContent . '</div>';
                    print '<div> printed by'. $userID . 'and ticket number'.$ticketID.'</div>';

                }
            }

        }*/



     }
}
?>
<form action='' method='post'>
    <fieldset>
        <legend>Enter Username and Password</legend>

        <h3><label for='username'>Username:</label>
            <input type='text'  name='username'/></h3>


        <h3><label for='password'>Password:</label>
        <input type='text' name='password'/></h3>

        <span style='color:red;'> <?= $userError ?></span>


</fieldset>
<p><input type='submit' value='Submit' name='formSubmit'></p>
</form>