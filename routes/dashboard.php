<?php

session_start();
if (!isset($_SESSION['userdata'])) {
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
  
     $status = '<b style = "color:red">Not Voted</b>';
}
else
{
    $status = '<b style = "color:green">Voted</b>';
}

?>


<!DOCTYPE html>
<html>

<head>

    <title>Online voting System</title>
    <link rel="stylesheet" href="../css/stylesheet.css">


</head>

<body>

    <div id="mainSection">

        <div id="headerSection">
            <a href="../"><button id="backbtn"> Back</button></a>
            <a href="logout.php"> <button id="logoutbtn">Logout</button></a>
            <h1>Online Voting System</h1>
        </div>
        <hr>



        <div id="main_panel">

            <div id="Profile">

                <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"><br><br>

                <b>Name : </b> <?php echo $userdata['name'] ?> <br><br>
                <b>Mobile : </b><?php echo $userdata['mobile'] ?><br><br>
                <b>Address : </b><?php echo $userdata['address'] ?><br><br>
                <b>Status : </b><?php echo $status ?><br><br>



            </div>


            <div id="Group">
                <?php
                if ($_SESSION['groupsdata']) {

                    for ($i = 0; $i < count($groupsdata); $i++) {
                ?>
                        <div>
                            <img id="group_image" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                            <div id="left_side">
                                <b>Candidate Name : <?php echo $groupsdata[$i]['name'] ?> </b> <br><br>
                                <b>Votes : <?php echo $groupsdata[$i]['votes'] ?> </b> <br><br>
                            </div>

                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value=" <?php echo $groupsdata[$i]['votes'] ?>">
                                <input type="hidden" name="gid" value=" <?php echo $groupsdata[$i]['id'] ?>">
                                <?php 

                                if($_SESSION['userdata']['status']==0){

                                    ?>
                                             <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                        <?php
                                }
                                
                                else{

                                    ?>
                                             <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                        <?php


                                }
                                ?>
                                
                            </form>
                            <br><br>
                            <hr>

                        </div>

                <?php
                    }
                } else {
                }
                ?>
            </div>

        </div>

    </div>






</body>

</html>