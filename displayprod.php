<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_POST["action"])) {
    $conn = new mysqli('localhost', 'root', '', 'test_1');
    if ($_POST["action"] == "fetch") {
        $query = "select * from prod_info order by prod_id desc";
        $res = mysqli_query($conn, $query);
        $output = '

			<table class="table table-bordered table-striped">  
    <tr>
     <th width="10%">ID</th>
     <th width="10%">Image</th>
     <th width="10%">Name</th>
     <th width="70%">Details</th>
    </tr>

			';
        while ($row = mysqli_fetch_array($res)) {
            $output .= '

				<tr>
					<td>' . $row["prod_id"] . '</td>
					<td>
						 <img src="data:image/jpeg;base64,' . base64_encode($row['prod_img']) . '" height="100" width="100" class="img-thumbnail" />
					</td>
					<td>' . $row["prod_name"] . '</td>
					<td>' . $row["prod_info"] . '</td>

				</tr>

				';
        }
        $output .= '</table>';
        echo $output;
    }

    if ($_POST["action"] == "insert") {
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $pname = $_POST["prod_name"];
        $pinfo = $_POST["pinfo"];
        $query = "INSERT INTO prod_info(prod_img,prod_info,prod_name) VALUES ('$file','$pinfo','$pname')";
        if (mysqli_query($conn, $query)) {
            echo 'Product Inserted into Database';
        }
    }
    if ($_POST["action"] == "update") {
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $pname = $_POST["prod_name"];
        $pinfo = $_POST["pinfo"];
        $query = "UPDATE prod_info SET prod_img = '$file', prod_name = '$pname' , prod_info = '$pinfo' WHERE prod_id = '" . $_POST["image_id"] . "'";
        if (mysqli_query($conn, $query)) {
            echo 'Product Updated into Database';
        }
    }
    if ($_POST["action"] == "delete") {
        $query = "DELETE FROM prod_info WHERE prod_id = '" . $_POST["image_id"] . "'";
        if (mysqli_query($conn, $query)) {
            echo 'Product Deleted from Database';
        }
    }
}
?>