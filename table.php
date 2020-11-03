<?php
    require_once 'connect.php';

    function createTable($sql){
        global $db;

        $result = $db->query($sql);
        if($result){
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $keys = array_keys($rows[0]);
            echo '<table>';
                echo '<tr>';
                    foreach($keys as $key){
                        echo "<th>$key</th>";
                    }
                echo '</tr>';

                foreach($rows as $row){
                    echo '<tr>';
                    foreach($keys as $key){
                        echo '<td>'.$row[$key].'</td>';
                        
                    }
                    echo '<td class="form-column">
                        <form method="post" action="delete.php" class="form-table">
                            <input type="hidden" name="id_ksiazka" value="'.$row['id_ksiazka'].'">
                            <input type="hidden" name="id_autor" value="'.$row['id_autor'].'">
                            <input type="hidden" name="id_tytul" value="'.$row['id_tytul'].'">
                            <input type="submit" value="USUŃ" class="delete-btn">
                        </form>
                    </td>';

                    echo '</tr>';
                }
            echo '</table>';

        } else echo 'invalid sql';
    }
?>