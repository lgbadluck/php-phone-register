<?php
include("database.php");
// add new record
if( isset($_GET['ac']) && $_GET['ac']==="add" ) {
    $phone = $db->real_escape_string($_POST['phone']);
    $fname = $db->real_escape_string($_POST['fname']);
    $lname = $db->real_escape_string($_POST['lname']);
    $sql = "INSERT INTO phones (phone,fname,lname) VALUES ('$phone', '$fname', '$lname')";
    $db->query($sql);
}
if( isset($_GET['ac']) && $_GET['ac']==="del" ) {
    $id = (int) $_GET['id'];
    $sql = "DELETE FROM phones WHERE id=$id";
    $db->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
            td.delete {
  text-align: center;
}
    </style>
    <title>Phone Register</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Phone</th>
            <th>FirstName</th>
            <th>LastName</th>

            </th>
        </tr>

    <?php
    $sql = "SELECT * FROM phones";
    $res = $db->query($sql);
    if($res->num_rows === 0){
        echo "<tr><td colspan='4'> No records</td><tr>";
    } else {
        while ( ($row = $res->fetch_array()) !== null ) {
            echo "<tr>";
            echo "<td>", $row['id'], "</td>";
            echo "<td>", $row['phone'], "</td>";
            echo "<td>", $row['fname'], "</td>";
            echo "<td>", $row['lname'], "</td>";
            echo "<td class='delete'> <a href='index.php?ac=del&id={$row['id']}'>Delete it!</a> </td>";
            echo "</tr>";
        }
    }
    //list all contacts
    ?>
    <tr>
        <form action="index.php?ac=add" method="post">
        <td>&nbsp;</td>
        <td><input type="text" name="phone" id="_phone"></td>
        <td><input type="text" name="fname" id="_fname"></td>
        <td><input type="text" name="lname" id="_lname"></td>
        <td><input type="submit"></td>
        </form>
    </tr>
    </table>
</body>
</html>