<?php
    require_once 'connect.php';

    function createTable($sql, $columns, $type){
        global $db;

        $result = $db->query($sql);
        if($result){
            if($result->num_rows > 0) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                $keys = $columns;
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

                        if($type == "books"){
                            if(isset($_SESSION['logged']) && $_SESSION['admin'] == 1)
                                generateDeleteForm($row);

                            if(isset($_SESSION['logged']) && $_SESSION['admin'] == 0)
                                generateRentForm($row);
                        }

                        if($type == "rents"){
                            generateReturnForm($row);
                        }
                        
                        echo '</tr>';
                    }
                echo '</table>';
            } else echo '<h2 class="empty_table">Brak danych</h2>';

        } else echo $db->error;
    }


    function generateDeleteForm($row){
        echo '<td class="form-column">
            <form method="post" action="php/delete.php" class="form-table">
                <input type="hidden" name="id_ksiazka" value="'.$row['id_ksiazka'].'">
                <input type="hidden" name="id_autor" value="'.$row['id_autor'].'">
                <input type="hidden" name="id_tytul" value="'.$row['id_tytul'].'">
                <input type="submit" value="USUŃ" class="delete-btn">
            </form>
        </td>';
    }

    function generateRentForm($row){
        echo '<td class="form-column">
            <form method="post" action="php/Rental.php" class="form-table">
                <input type="hidden" name="id_ksiazka" value="'.$row['id_ksiazka'].'">
                <input type="hidden" name="id_user" value="'.$_SESSION['user'].'">
                <input type="hidden" name="action" value="rent">
                <input type="submit" value="Wypożycz" class="delete-btn">
            </form>
        </td>';
    }

    function generateReturnForm($row){
        if($row['Data zwrotu'] == null){
            echo '<td class="form-column">
                <form method="post" action="php/Rental.php" class="form-table">
                    <input type="hidden" name="id_wypozyczenie" value="'.$row['id'].'">
                    <input type="hidden" name="action" value="return">
                    <input type="submit" value="Zwróć" class="delete-btn">
                </form>
            </td>';
        }
    }
?>