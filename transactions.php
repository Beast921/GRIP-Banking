<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABC Bank | Transaction History</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php include "navbar.html"; ?>
  <div class="container">
    <h2><u>Transaction History</u></h2>
    <table>
      <tr>
        <th>S. No.</th>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Amount</th>
        <th>Date & Time</th>
      </tr>
      <?php 
        include 'config.php';
        $sql="SELECT * FROM transaction";
        $query=mysqli_query($conn,$sql);
        while($rows=mysqli_fetch_assoc($query)) {
      ?>
        <tr>
          <td><?php echo $rows['sno']; ?></td>
          <td><?php echo $rows['sender']; ?></td>
          <td><?php echo $rows['receiver']; ?></td>
          <td><?php echo $rows['amount']; ?></td>
          <td><?php echo $rows['datetime']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>