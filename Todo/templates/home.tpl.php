
<?php

include 'header.tpl.php';
?>
<main id="home" >
<p class="homes">Empieza a gestionar tus tareas<p><a href="/dashboard">Editar</a>
<div id="scroll">
<?php
   
            if (isset($data)) {
                if (count($data) > 0) {
        ?>
                  <table class="table">
                        <thead>
                            <tr>
                                <th>Task Title</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>

                        </thead>   
                        <?php

                        foreach ($data as $valor) {
                            echo "<tr>";
                            foreach ($valor as $key => $value) {
                                if ($key == "id") {
                                    $Task = $value;
                                }
                                echo "<td>" . $value . "</td>";
                            }
                           
                            echo "</tr>";
                        }
                    
                        ?>
                    
                    </table>
                <?php
            }}
        
?>
</table>
</div>
</main>
<?php
include 'templates/footer.tpl.php';
?>


