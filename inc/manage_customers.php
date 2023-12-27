<?php if(!isset($is_inc)) { http_response_code(403); exit; } elseif($is_inc !== INC_NUMBER) { http_response_code(403); exit; }; ?>
<h1>Manage Bank Customers</h1>
<h2>Manage all bank customers in one dashboard</h2>
<span>
    <p>Edit customer's history by blocking, approving, locking, adding funds, e.t.c</p>
</span>
<hr/>

<h3>All bank customers</h3>

<?php 
    $limit = $_GET['mcfl'] ?? 15;
    $offset = $_GET['mcfs'] ?? 0;
    settype($limit, 'integer');
    settype($offset, 'integer');

    $sql = sprintf("SELECT * FROM accounts WHERE Type = 'client' ORDER BY ID DESC LIMIT %d, %d;", $offset, $limit);
    $connection->connect();
    $conn = $connection->get();

    $result = $conn->query($sql);
    if($result->num_rows > 0) {

        ?>
        <div class="scroll-x">
        <table class="layout-table">
            <tr>
                <th></th>
                <th>FIRSTNAME</th>
                <th>LASTNAME</th>
                <th>ACCOUNT STATUS</th>
                <th>ACCOUNT NUMBER</th>
                <th></th>
            </tr>

            <?php 
                $count = 1;
                while($row = $result->fetch_assoc()) {

                    echo '<tr>';
                    echo '<td>' . $count . '</td>';
                    echo '<td>' . $row['FirstName'] . '</td>';
                    echo '<td>' . $row['LastName'] . '</td>';
                    echo '<td>' . $row['Status'] . '</td>';
                    echo '<td>' . $row['AccountNumber'] . '</td>';
                    echo '<td> <a href="./?p=1.2' . '&edt-c-a=' . $row['ID'] . '">';
                    echo '<i class="bi bi-tools"></i> Manage</a> </td>';
                    echo '</tr>';

                    $count++;

                }
            ?>
        </table>
        </div>
        <br/>
        <br/>
        
        <?php

    } else {
        echo '<h4>We don\'t have any bank customers yet.</h4>';
    }


    if($result->num_rows >= 15) {
        $offset = ($offset < 15)? 15 : $offset + 14;
        $limit = ($limit < 15)? 15 : $limit + 15;
        ?>
            <a class="button" href="./?p=1.1<?php echo '&mcfl=' . $limit . '&mcfs=' . $offset; ?>">
            Load more... <i class="bi bi-chevron-double-right"></i></a>
            <?php
            if($offset >= 15 && $offset > 15) {
                $offset = ($offset >= 15)? $offset - 15 : 0;
                $limit = ($limit > 15)? $limit - 15 : 15;
                ?>
                
                    <a class="button" href="./?p=1.1<?php echo '&mcfl=' . $limit . '&mcfs=' . $offset; ?>" style="background-color:#111;">
                    <i class="bi bi-chevron-double-left"></i> Load less...</a>
                <?php
            }
    } elseif($offset >= 15) {
        $offset = ($offset >= 15)? $offset - 15 : 0;
        $limit = ($limit > 15)? $limit - 15 : 15;
        ?>
        
            <a class="button" href="./?p=1.1<?php echo '&mcfl=' . $limit . '&mcfs=' . $offset; ?>" style="background-color:#111;">
            <i class="bi bi-chevron-double-left"></i> Load less...</a>
        <?php
    }
?>
