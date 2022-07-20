<?php
  include "config.php";
  $flag=0;

  if(isset($_POST['submit'])) {
    $from=$_GET['id'];
    $to_id=$_POST['to_id'];
    $to_name=$_POST['to_name'];
    $amount=$_POST['amount'];

    $sql="SELECT * FROM user where id='$from'";
    $query=mysqli_query($conn,$sql);
    $sql1=mysqli_fetch_array($query);

    $sql="SELECT * FROM user where id='$to_id' and `name`='$to_name'";
    $query=mysqli_query($conn,$sql);
    $sql2=mysqli_fetch_array($query);

    if($amount < 0) {
      echo '<script type="text/javascript">';
      echo ' alert("Oops! Negative values cannot be transferred.");';
      echo '</script>';
    }
    else if($amount > $sql1['balance']) {
      echo '<script type="text/javascript">';
      echo ' alert("Sorry! Insufficient Balance.");';
      echo '</script>';
    }
    else if($amount==0) {
      echo '<script type="text/javascript">';
      echo ' alert("Zero value cannot be transferred.");';
      echo '</script>';
    } else {
      $newbal=$sql1['balance']-$amount;
      $sql="UPDATE user set balance='$newbal' where id='$from'";
      mysqli_query($conn,$sql);

      $newbal=$sql2['balance']+$amount;
      $sql="UPDATE user set balance='$newbal' where id='$to_id'";
      mysqli_query($conn,$sql);

      $sender=$sql1['name'];
      $receiver=$sql2['name'];
      $sql="INSERT INTO transaction(`sender`,`receiver`,`amount`) VALUES ('$sender','$receiver','$amount')";
      $query=mysqli_query($conn,$sql);

      if($query) {
        $flag=1;
      }

      $newbal=0;
      $amount=0;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABC Bank | Transactions</title>
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include "navbar.html" ?>
  <div class="container" id="container1">
    <h2><u>Transact Money</u></h2>
    <?php
      include 'config.php';
      $id = $_GET['id'];
      $sql = "SELECT * FROM  user where id=$id";
      $res = mysqli_query($conn, $sql);
      if (!$res) {
          echo "Error : " . $sql . "<br>" . mysqli_error($conn);
      }
      $rows = mysqli_fetch_assoc($res);
    ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>E-Mail</th>
        <th>Balance</th>
      </tr>
      <tr>
        <td><?php echo $rows['id']; ?></td>
        <td><?php echo $rows['name']; ?></td>
        <td><?php echo $rows['email']; ?></td>
        <td><?php echo $rows['balance']; ?></td>
      </tr>
    </table>
    <form name="transfer" method="POST" class="form">
      <label>Transfer To:</label>
      <div class="creds">
        <label>Account ID: </label>
        <input type="number" name="to_id" required>
        <label>Holder's Name: </label>
        <input type="text" name="to_name" required>
      </div>
      <label>Amount: </label>
      <input type="number" name="amount" required>
      <div style="text-align: center;">
        <button type="submit" name="submit" class="tran-btn" style="font-size:1.3rem; height:2rem; width:6rem;">Transfer</button>
      </div>
    </form>
  </div>
  <div class="container" id="container2" style="display:none;">
    <h2>Transaction Successful.</h2>
  </div>
  <?php if($flag==1){ ?>
  <script>
    document.getElementById("container1").style.display = "none";
    document.getElementById("container2").style.display = "block";
  </script>
  <?php }?>
</body>
</html>