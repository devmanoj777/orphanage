<?php include './admin_components/admin_header.php' ?>

    <div class="ui container">

        <!-- Top Navigation Bar -->
        <?php include './admin_components/admin_top-menu.php' ?>

        <!-- BODY Content -->
        <div class="ui grid">
            <!-- Left menu -->
            <?php include './admin_components/admin_side-menu.php' ?>

            <!-- right content -->
            <div class="twelve wide column">
                <h1>Adoption Requests</h1>

                <?php
                    if(isset($_GET['del']) && $_GET['cid']) {
                        $ad_id = $_GET['del'];
                        $cid = $_GET['cid'];

                        $sql = "DELETE FROM adopt WHERE id = $ad_id";
                        $del_result = mysqli_query($conn, $sql);

                    }
                    
                ?>

                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone.No</th>
                            <th>Children ID</th>
                            <th>Children name</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $sql = "SELECT * FROM adopt";
                            $result = $conn->query($sql);
    
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                        ?>

                        <tr>
                            <td><?php echo $row['ad_firstname']; ?></td>
                            <td><?php echo $row['ad_email']; ?></td>
                            <td><?php echo $row['ad_phone']; ?></td>
                            <td><?php echo $row['cid']; ?></td>
                            <td><?php echo $row['ad_cdname']; ?></td>
                            <td>
                                <a 
                                    onclick="return confirm('Are you sure you want to delete this post and all its comments?');" 
                                    class="ui red button"
                                    href="adopt_reqs.php?del=<?php echo $row['id']; ?>&cid=<?php echo $row['cid']; ?>">
                                    Delete
                                </a>
                            </td>
                        </tr>

                        <?php
                                }
                            }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
    
<?php include './admin_components/admin_footer.php' ?>