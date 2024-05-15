<h1> <?= $title ?> </h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>nom</th>
            <th>prenom</th>
            <th>email</th>
            <th>Mot de passe </th>
        </tr>

    </thead>
    <tbody>
        <?php 

            foreach($user as $v){
                echo "<tr>";
                    foreach($v as $vv){
                        echo "<td>".$vv."<td>";
                    }
                echo "</tr>";
            }
        ?>
    </tbody>


</table>