<?php //var_dump($user);?>


<form action="/user/edit/<?= $user['id']?>" method="post">

    <input type="hidden" id="id" name="id" value="<?= $user['id']?>">

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?= $user['nom']?>">

    <label for="prenom">Prenom :</label>
    <input type="text" id="prenom" name="prenom"value="<?= $user['prenom']?>"><br>

    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email"value="<?= $user['email']?>"><br>

    <label for="password"> Password :</label><br>
    <input type="password" id="password" name="password"value="<?= $user['password']?>"><br><br>

    <label for="password"> Password :</label><br>
    <select name="id_role">
        <?php
        foreach($roles as $role) {
            if($user['id_role']== $role['id']){
                echo "<option value=".$role['id']." selected>".$role['libelle']."</option>";
            }else{
                echo "<option value=".$role['id'].">".$role['libelle']."</option>";
            }
               
        }?>

<br><br><input type="submit" value="Valider">
</form> 