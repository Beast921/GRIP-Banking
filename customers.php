<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Bank | View All Customers</title>
    <link rel="stylesheet" href="customers.css">
  </head>
  <body>
    <?php 
      include "config.php";
      $sql="SELECT *FROM user";
      $result=mysqli_query($conn,$sql);
    ?>
    <header>
      <?php include "navbar.html"; ?>
    </header>
    <div class="container">
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>E-Mail</th>
          <th>Balance</th>
          <th>Operation</th>
        </tr>
        <?php while($rows=mysqli_fetch_assoc($result)) { ?> 
          <tr>
            <td><?php echo $rows['id']; ?></td>
            <td><?php echo $rows['name']; ?></td>
            <td><?php echo $rows['email']; ?></td>
            <td><?php echo $rows['balance']; ?></td>
            <td><a href="selectedacc.php?id=<?php echo$rows['id']; ?>"><button class="tran-btn">Transact</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </body>
</html>