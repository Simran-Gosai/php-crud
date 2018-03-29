<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['make']) ) {
    $sql = "UPDATE `autos` SET 
	`make` = :make, `model` = :model, `year` = :year, `mileage` = :mileage 
	WHERE `autos_id` = :autos_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],

':model' => $_POST['model'],

':year' => $_POST['year'],

':mileage' => $_POST['mileage'],

        ':autos_id' => $_POST['autos_id']));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}



$stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}
$n=htmlentities($row['make']);
$e=htmlentities($row['year']);
$p=htmlentities($row['model']);
$g=htmlentities($row['mileage']);
?>
<p><b>Edit User</b></p>
<form method="post">
<p><b>Make:</b>
<input type="text" name="make" value="<?= $n ?>"></p>
<p><b>Year:</b>
<input type="text" name="year" value="<?=$e?>"></p>
<p><b>Model:</b>
<input type="text" name="model" value="<?=$p?>"></p>
<p><b>Mileage:</b>
<input type="text" name="mileage" value="<?=$g?>"></p>
<input type="hidden" name="autos_id" value="<?= $autos_id ?>">
<p><input type="submit" value="Save"/>
<a href="index.php">Cancel</a></p>
</form>
