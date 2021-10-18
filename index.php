# PDO-4ever

<form action="index.php" method="POST">
  <div>
        <p>
        <label for="firstname">Firstname :</label>
        <input type="text" id="firstname" name="firstname">
        <?php if(isset($errors['firstname'])) { echo $errors['firstname']; } ?>
        </p>
  </div>

  <div>
        <p>
        <label for="lastname">Lastname :</label>
        <input type="text" id="lastname" name="lastname">
        <?php if(isset($errors['lastname'])) { echo $errors['lastname']; } ?>
        </p>
  </div>
    
    <div class="button">
        <button type="submit">Envoyer</button>
    </div>
    </p>
   
</form>

<?php

require_once 'connect.php';

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($friends as $friend) {
    echo "<ul><li>" .$friend['firstname'] . ' ' . $friend['lastname']."</li></ul>";
}



if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    
    
    if($firstname == ""){
        $errors['firstname'] = "Entrez votre prénom";
    }
    if(strlen($firstname) > 45){
        $errors['firstname'] = "votre prénom est trop long";
        
    if($lastname == ""){
        $errors['lastname'] = "Entrez votre nom";
        }
    if(strlen($lastname) > 45){
        $errors['larstname'] = "votre nom est trop long";
    }

    if(empty($errors));
    }

  
    $query = "INSERT INTO friend (`firstname` , `lastname`) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    
    $statement->bindValue(':firstname' , $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname' , $lastname, \PDO::PARAM_STR);
    
    $statement->execute();
    
    $friends = $statement->fetchAll();
    
    header('location: /');
  
    foreach($friends as $friend) {
        echo "<ul>\<li>" .$friend['firstname'] . ' ' . $friend['stname']."</li></ul>";
    }

}  
