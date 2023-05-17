<?php include './components/header.php'; ?>

    <div class="ui bg">

        <!-- Top Navigation Bar -->
        <?php include './components/top-menu.php'; ?>

        <!-- BODY Content -->
        <div class="ui grid">
            <!-- Left menu -->
            <?php include './components/side-menu.php'; ?>
            
            <!-- right content -->
            <div class="twelve wide column">
                <h1>Adopt this Child</h1>


                <?php

                    if(isset($_POST['submit'])) {
                        $cid = $_GET['cid'];
                        $firstname = $_POST['fname'];
                        $lastname = $_POST['lname'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $address = $_POST['address'];
                        $name = $_POST['cdname'];
                       

                        $sql = "INSERT INTO adopt (ad_firstname, ad_lastname, ad_email, ad_phone, ad_address, cid, ad_cdname) 
                                    VALUES ('$firstname', '$lastname', '$email', '$phone', '$address', '$cid',' $name')";
                                
                        

                        if ($conn->query($sql) === TRUE ) {
                            echo "<script> alert('New record created successfully'); </script>";
                            $unsponsored_page = './adopt_done.php';
                            header('Location: ' . $unsponsored_page);
                                
                                
                        } else {
                            echo "<script> alert('Error in Insertion'); </script>";
                        }
                        $conn->close();
                        
                    } else {

                    }
                    
                ?>


                <form action="<?php $_PHP_SELF ?>" method="post" class="ui form">
                    <h4 class="ui dividing header">Child's Details</h4>
                    <img class="ui small top aligned circular image" src="img/defaultimg.png">

                    <?php
                        if(isset($_GET['cid'])) {
                            $cid = $_GET['cid'];
                        } else {
                            $unsponsored_page = './child-gallery-sponsored.php';
                            header('Location: ' . $unsponsored_page);
                        }

                        $sql = "SELECT cid, cname, cdob, cyoe, cclass FROM children WHERE cid='$cid'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $dob = $row["cdob"];
                                $age = (date('Y') - date('Y',strtotime($dob))); 
                    ?>

                    <span>
                        <div class="description">
                            <div class="ui horizontal list">
                                <div class="item">
                                    <div class="content">
                                        <div>Name:</div> <strong><?php echo $row["cname"]; ?></strong>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <div>Age:</div> <strong><?php echo $age; ?></strong>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                    <div>Class:</div> <strong><?php echo $row["cclass"]; ?></strong>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                    <div>Year of enroll:</div> <strong><?php echo $row["cyoe"]; ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                    
                    <?php
                            }
                        }
                    ?>

                    <h4 class="ui dividing header">Personal Information</h4>
                    <div class="fields">
                        <div class="eight wide field">
                            <label>First Name</label>
                            <input type="text" name="fname" placeholder="First Name" required>
                        </div>
                        <div class="eight wide field">
                            <label>Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="fields">
                        <div class="eight wide field">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="eight wide field">
                            <label>Phone No.</label>
                            <input type="tel" name="phone" placeholder="Phone / Mobile" required>
                        </div>
                    </div>

                    <div class="field">
                        <label>Address</label>
                        <div class="field">
                        <div class="sixteen wide field">
                            <input type="text" name="address" placeholder="Address" required>
                        </div>
                        </div>
                    </div>
                    <div class="eight wide field">
                            <label>Child Name</label>
                            <input type="text" name="cdname" placeholder="child Name" required>
                        </div>
                    
                    <button name="submit" class="ui primary button" tabindex="0">Sent Request</button>
                </form>

            </div>

            <span class="p-20"></span>

        </div>
    </div>
    
<?php include './components/footer.php'; ?>