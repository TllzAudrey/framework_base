<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Mot de passe</th>
            <th colspan = 2> role </th>
            <th colspan = 2>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($users as $v) {
                echo "<tr>";
                    foreach($v as $vv) {
                        echo "<td>".$vv."</td>";
                    }
                    echo "<td>";
                        echo "<a href=\"/user/edit/".$v['id']."\">edit</a>";
                    echo "</td>";
                    echo "<td>";
                        echo "<a href=\"/user/delete/".$v['id']."\">delete</a>";
                    echo "</td>";

                echo "</tr>";
            }
        ?>
    </tbody>
</table>
