<?php
include_once('include/header.php');

if(empty($_SESSION['user'])){
    header('location:login.php');
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT u.name,b.*
    FROM bookings b 
    INNER JOIN users u ON u.id = b.user_id
    WHERE b.ride_id = " . $id;

    $stmt=$connection->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();

}
?>
    <section class="login1 services1">
        <div class="container">
            <div class="login-heading">
                <h1>Passenger Details</h1>
                <ul>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a class="active" href="manage-rides.php">manage-rides</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="ride-list">
        <div class="container">
            <div class="list-table">
                <table>
                    <thead>
                        <tr>
                            <th>SR. No.</th>
                            <th>Name</th>
                            <th>
                                Total Tickets
                            </th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sr = 1;
                    while($row=$result->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $sr++; ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['total_tickets'] ?></td>
                            <td><?php echo $row['payment_type'] ?></td>
                                <?php if($row['status'] == 1){ ?>
                                    <td>
                                        Approve
                        </td>
                        <?php } ?>
                                <?php if($row['status'] == 0){ ?>
                                    <td>
                                        Cancel
                        </td>
                        <?php } ?>
                        <?php if($row['status'] == 1){ ?>
                            <td>
                                <a style="color:Red" href="booking_decline.php?id=<?php echo $row['id'] ?>">Decline</a>
                        </td>
                        <?php }else{ ?>
                            <td>-</td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

   <?php
include_once('include/footer.php');
?>