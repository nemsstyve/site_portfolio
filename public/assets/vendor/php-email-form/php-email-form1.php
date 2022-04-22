<?php
/*---------------------------------------------------------------*/
/*
    Titre : Formulaire complet d'envoi de mail                                                                            
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=57
    Auteur           : Mathieu                                                                                            
    Date édition     : 01 Sept 2004                                                                                       
    Date mise à jour : 13 Sept 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - refactoring du code en PHP 7                                                                                        
    - fonctionnement du code vérifié                                                                                    
    - correction du code                                                                                                  
    - amélioration du code                                                                                               
    - modification de la description                                                                                      
*/
/*---------------------------------------------------------------*/?>
     <form name="contact_form" method="post" action="">
    <table width="500">
    <tr>
     <td valign="top">
      <label for="nom">Nom *</label>
     </td>
     <td valign="top">
      <input  type="text" name="nom" maxlength="50" size="30" value="<?php if (
isset($_POST['nom'])) echo htmlspecialchars($_POST['nom']);?>">
     </td>
    </tr>
    <tr>
     <td valign="top"">
      <label for="prenom">Prénom *</label>
     </td>
     <td valign="top">
      <input  type="text" name="prenom" maxlength="50" size="30" value="<?php if
 (isset($_POST['prenom'])) echo htmlspecialchars($_POST['prenom']);?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <label for="email">Email Addresse *</label>
     </td>
     <td valign="top">
      <input  type="text" name="email" maxlength="80" size="30" value="<?php if 
(isset($_POST['email'])) echo htmlspecialchars($_POST['email']);?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <label for="telephone">Téléphone</label>
     </td>
     <td valign="top">
      <input  type="text" name="telephone" maxlength="30" size="30" value="
<?php if (isset($_POST['telephone'])) echo htmlspecialchars($_POST['telephone'])
;?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <label for="commentaire">Commentaire *</label>
     </td>
     <td valign="top">
      <textarea  name="commentaire" cols="28" rows="10"><?php if (isset($_POST[
'commentaire'])) echo htmlspecialchars($_POST['commentaire']);?></textarea>
     </td>
    </tr>
    <tr>
     <td colspan="2" style="text-align:center">
      <input type="submit" value=" Envoyer ">
     </td>
    </tr>
    </table>
    </form>

<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "votre@email";
    $email_subject = "Le sujet de votre email";
 
    function died($error) {
        // your error code can go here
        echo 
"Nous sommes désolés, mais des erreurs ont été détectées dans le" .
" formulaire que vous avez envoyé. ";
        echo "Ces erreurs apparaissent ci-dessous.<br /><br />";
        echo $error."<br /><br />";
        echo "Merci de corriger ces erreurs.<br /><br />";
        die();
    }
 
 
    // si la validation des données attendues existe
     if(!isset($_POST['nom']) ||
        !isset($_POST['prenom']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['commentaire'])) {
        died(
'Nous sommes désolés, mais le formulaire que vous avez soumis semble poser' .
' problème.');
    }
 
     
 
    $nom = $_POST['nom']; // required
    $prenom = $_POST['prenom']; // required
    $email = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $commentaire = $_POST['commentaire']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
    if(!preg_match($email_exp,$email)) {
      $error_message .= 
'L\'adresse e-mail que vous avez entrée ne semble pas être valide.<br />';
    }
   
      // Prend les caractères alphanumériques + le point et le tiret 6
      $string_exp = "/^[A-Za-z0-9 .'-]+$/";
   
    if(!preg_match($string_exp,$nom)) {
      $error_message .= 
'Le nom que vous avez entré ne semble pas être valide.<br />';
    }
   
    if(!preg_match($string_exp,$prenom)) {
      $error_message .= 
'Le prénom que vous avez entré ne semble pas être valide.<br />';
    }
   
    if(strlen($commentaire) < 2) {
      $error_message .= 
'Le commentaire que vous avez entré ne semble pas être valide.<br />';
    }
   
    if(strlen($error_message) > 0) {
      died($error_message);
    }
 
    $email_message = "Détail.\n\n";
    $email_message .= "Nom: ".$nom."\n";
    $email_message .= "Prenom: ".$prenom."\n";
    $email_message .= "Email: ".$email."\n";
    $email_message .= "Telephone: ".$telephone."\n";
    $email_message .= "Commentaire: ".$commentaire."\n";
 
    // create email headers
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $email_message, $headers);
    ?>
     
    <!-- mettez ici votre propre message de succès en html -->
     
    Merci de nous avoir contacter. Nous vous contacterons très bientôt.
  }
<?php
  if(isset($_POST['submit'])){
    $to = "name@example.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
  ?>