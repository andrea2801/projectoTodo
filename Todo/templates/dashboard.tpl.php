
<?php
include 'header.tpl.php';
?>
 <main >
    <section class="container" >
    <div id="scroll">
        <?php
   
            if (isset($data)) {
                if (count($data) > 0) {
                    
        ?>
                  <table class="table" >
                        <thead>
                            <tr>
                                <th>Task Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Remove</th>
                                <th>Edit(no va )</th>
                            </tr>

                        </thead>   
                        <?php

                        foreach ($data as $valor) {
                            echo "<tr>";
                            foreach ($valor as $key => $value) {

                           
                                if ($key == "titulo") {
                                    $Taskt = $value;
                                }
                                echo "<td>" . $value . "</td>";
                            }
                            echo "<td><form action=' ". BASE . "dashboard/delete' method='POST'> <input type='hidden' name='Taskt' value='$Taskt'><input type='submit' value='-'></form></td>";
                            echo "<td><form action='' method='post'><input type='submit' name='edit' value='+-'><input type='hidden' name='Taskt' value='$Taskt'></form></td>";
                            echo "</tr>";
                        }
                    
                        ?>
                    
                    </table>
                    
                <?php
            }}
        
            if (isset($_POST['edit'])) {
                ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Task Title</th>
                         <th>Description</th>
                         <th>Date</th>
                        </tr>
                    </thead>
                    <tr>
                        <form action="<?= BASE ?>dashboard/edit" method="POST">
                            <?php
                            //no me salia
                            }
                            ?>

                        </form>
                    </tr>
                </table>
                </div>
                
            <?php
        
            ?>
            <h2>Crear  una nueva tarea</h2>
                 <form action="<?= BASE ?>dashboard/insert" method="POST">
            <tbody>
                <tr>
                <td><input required type="text" name="title" placeholder="titulo"></td>
                <td><input required type="text" name="desc" placeholder="Descripcion de la tarea"></td>

                    <td><input required type="date" name="date"></td>

                    <td><button type="submit">Crear</button></td>
                </tr>
            </tbody>
        </table></form>
            <?php
        
            ?>

</table>
    </main>
<?php
include 'templates/footer.tpl.php';
?>