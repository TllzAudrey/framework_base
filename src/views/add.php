
<form action="/user/add" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom">

    <label for="prenom">Prenom :</label>
    <input type="text" id="prenom" name="prenom"><br>

    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email"><br>

    <label for="password"> Password :</label><br>
    <input type="password" id="password" name="password"><br><br>

    <label for="password"> Password :</label><br>
    <select name="id_role">
        <?php
        foreach($roles as $role) {
                echo "<<option value=".$role['id'].">".$role['libelle']."</option>";
               
            }?>

<br><br><input type="submit" value="Valider">
</form> 