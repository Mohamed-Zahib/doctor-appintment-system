<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Report</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

   

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }



    //import database
    include("../connection.php");


    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@ems.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu "><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-report menu-active menu-icon-schedule-active">
                        <a href="report.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Report</p></a></div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                        <a href="report.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Report Generator</p>             
                    </td>
                    <td width="20%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                            date_default_timezone_set('Asia/Kolkata');

                            $today = date('Y-m-d');
                            echo $today;

                            //$list110 = $database->query("select  * from  schedule;");

                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">
                           </td> 
                        <td width="5%" style="text-align: center;">
                        Date:
                        </td>
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="startDate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        <td width="5%" style="text-align: center;">
                        to
                        </td>
                        <td width="30%">
                        <input type="date" name="endDate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">
                    </td>
                    <td width="12%">
                        <input type="submit"  name="find" value=" Find" class="login-btn btn-primary-soft btn"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                
                <?php
                    if($_POST){

                        $sqlpt1="";
                        if(!empty($_POST["startDate"])){
                            $startDate=$_POST["startDate"];
                            //$sqlpt1=" schedule.scheduledate='$startDate' ";
                        }


                        $sqlpt2="";
                        if(!empty($_POST["endDate"])){
                            $endDate=$_POST["endDate"];
                            //$sqlpt2=" doctor.docid=$endDate ";
                        }
                        //echo $sqlpt2;
                        //echo $sqlpt1;
                        $sqlmain= "select patient.pid,pemail,pname,paddress,pnic,pdob,ptel,appodate 
                        from patient,appointment 
                        where appointment.pid=patient.pid and appodate between '".$startDate."'"." and '".$endDate."';";
                        // $sqllist=array($sqlpt1,$sqlpt2);
                        // $sqlkeywords=array(" where "," and ");
                        // $key2=0;
                        // foreach($sqllist as $key){

                        //     if(!empty($key)){
                        //         $sqlmain.=$sqlkeywords[$key2].$key;
                        //         $key2++;
                        //     };
                        // };
                        //echo $sqlmain;

                        
                        
                        //
                    }//else{
                    //     $sqlmain= "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  order by schedule.scheduledate desc";

                    // }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                            <th class="table-headin">
                                ID
                            </th> 
                            <th class="table-headin">
                                E-Mail
                            </th>
                            <th class="table-headin">
                                Name 
                            </th>
                            <th class="table-headin">   
                                Address   
                            </th>
                            <th class="table-headin">
                                NIC   
                            </th>
                            <th class="table-headin">
                                DOB
                            </th>
                            <th class="table-headin">
                                Phone No
                            </th>
                                <th class="table-headin">
                                    
                                    Appointment Date
                                    
                                </th>
                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                if($_POST){
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                    for ( $x=0; $x<$result->num_rows;$x++){
                                        $row=$result->fetch_assoc();
                                        $pid= $row["pid"];
                                        $pemail= $row["pemail"];
                                        $pname= $row["pname"];
                                        $paddress= $row["paddress"];
                                        $pnic= $row["pnic"];
                                        $pdob= $row["pdob"];
                                        $ptel= $row["ptel"];
                                        $appodate =$row["appodate"];
                                        echo '<tr style="height:50px;">
                                            <td> &nbsp;'.
                                            $pid
                                            .'</td>
                                            <td>
                                            '.$pemail.'
                                            </td>
                                            <td>
                                                '.$pname.'
                                            </td>
                                            <td style="text-align:center;">
                                                '.$paddress.'
                                            </td>
                                            <td>
                                                '.$pnic.'
                                            </td>
                                            <td>
                                                '.$pdob.'
                                            </td>
                                            <td>
                                                '.$ptel.'
                                            </td>
                                            <td>
                                                '.$appodate.'
                                            </td>

                    
                                        </tr>';
                                        
                                    }
                                }
                                }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
</body>

        