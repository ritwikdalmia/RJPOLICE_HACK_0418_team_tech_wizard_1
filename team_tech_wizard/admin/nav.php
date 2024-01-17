
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<!-- fontawesome icons
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
    <script src="https://kit.fontawesome.com/2715ab056d.js" crossorigin="anonymous"></script>

</head>
<?php
$email_id1=$_SESSION['email_id'];
 $select_display="select * from admin where email_id='$email_id1'" ;
 $sql1 = mysqli_query($conn,$select_display);
                                            while($row=mysqli_fetch_assoc($sql1)){
                                             $admin_id=$row['admin_id'];
                                             $full_name=$row['full_name'];
                                             $admin_role_type=$row['admin_role_type'];
                                             $police_station=$row['police_station'];
                                             $email_id=$row['email_id'];
                                            }

?>
<?php
    if ($admin_role_type=='admin'){
        echo "
        <nav id='sidebar'>
            <div class='sidebar-header mt-4'>
                <h3>Tech wizard</h3>
            </div>

            <ul class='list-unstyled components'>
            <li>
                        <a href='welcome.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Main Menu</a>
                        </li>
             <li>
                        <a href='https://smilewellnessfoundation.org/team_tech_wizard/admin/graphs_dynamic/index.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Analytics</a>
                        </li>
                        
                
                <li>
                    <a href='#pageSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Users</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu'>
                       
                       
                        <li>
                        <a href='manage_users.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Users</a>
                        </li>
                        
                        <li>
                        <a href='manage_profile_updation.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;manage profile updation </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href='#pageSubmenu3' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Manage Complaint Request</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu3'>
                       
                       
                        <li>
                        <a href='manage_complaint_request.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Complaint</a>
                        </li>
                    </ul>
                </li>





                <li>
                    <a href='#pageSubmenu6' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Admiministration </a>
                    <ul class='collapse list-unstyled' id='pageSubmenu6'>
                    
                    <li>
                        <a href='add_admin_details.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Add Administration</a>
                        </li>
                       
                        <li>
                        <a href='manage_administration.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Administration</a>
                        </li>
                         <li>
                        <a href='manage_admin_profile_updation.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Administration profile request</a>
                        </li>
                       
                        
                    </ul>
                </li>

                <li>
                    <a href='#pageSubmenu1' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Admin Role type</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu1'>
                        <li>
                        <a href='add_admin_role.php'><i class='fa fa-fw fa-users'></i>&nbsp;Add Admin role </a>
                        </li>
                        <li>
                        <a href='manage_admin_role.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage admin role</a>
                        </li>
                       
                        
                    </ul>
                </li>


                <li>
                    <a href='#pageSubmenu7' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Police station list</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu7'>
                        <li>
                        <a href='add_police_station_list.php'><i class='fa fa-fw fa-users'></i>&nbsp;Add police station </a>
                        </li>
                        <li>
                        <a href='manage_police_station_list.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage police station list</a>
                        </li>
                       
                        
                    </ul>
                </li>
                
                  <li>
                        <a href='https://smilewellnessfoundation.org/team_tech_wizard/admin/feedback_rating.php' target=_blank><i class='fa fa-fw fa-people-roof'></i>&nbsp;Feedback review</a>
                        </li>

                
                <li>
                    <a href='#pageSubmenu8' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Setting</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu8'>
                        <li>
                        <a href='change_password.php'><i class='fa fa-fw fa-users'></i>&nbsp;Change Password</a>
                        </li>
                        <li>
                        <a href='change_address.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;change_address</a>
                        </li>
                        <li>
                        <a href='profile.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Profile</a>
                        </li>
                       
                       
                        
                    </ul>
                </li>
                
            </ul>

            <ul class='list-unstyled CTAs'>
                
                <li>
                    <a href='logout.php'><i class='fa-solid fa-right-from-bracket'></i>&nbsp;Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id='content'>

            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid '>
                  

                    <button type='button' id='sidebarCollapse' class='btn btn-info mt-0'>
                        <i class='fas fa-align-left'></i>
                    </button>
                    <a class='navbar-brand' href='#'>Administration</a>
                    <a class='navbar-brand' href='#'>$email_id</a>
                                            
                          
                         
                        </div>
                      
                   
            
            </nav>";

    }
    elseif($admin_role_type=='station-admin'){
        echo "
        <nav id='sidebar'>
            <div class='sidebar-header mt-4'>
                <h3>Tech wizard</h3>
            </div>

            <ul class='list-unstyled components'>
             <li>
                        <a href='welcome.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Main Menu</a>
                        </li>

            <li>
            <a href='#pageSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Users</a>
            <ul class='collapse list-unstyled' id='pageSubmenu'>
               
               
                <li>
                <a href='manage_users.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Users</a>
                </li>
                 <li>
                        <a href='manage_profile_updation.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;manage profile updation </a>
                        </li>
            </ul>
        </li>
             
                
                <li>
                    <a href='#pageSubmenu3' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Manage Complaint Request</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu3'>
                       
                       
                        <li>
                        <a href='manage_complaint_request.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Complaint</a>
                        </li>
                    </ul>
                </li>





                <li>
                    <a href='#pageSubmenu6' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Admiministration </a>
                    <ul class='collapse list-unstyled' id='pageSubmenu6'>
                    
                    <li>
                        <a href='add_admin_details.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Add Administration</a>
                        </li>
                        
                        <li>
                        <a href='manage_administration.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Administration</a>
                        </li>
                        
                        <li>
                        <a href='manage_admin_profile_updation.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Administration profile request</a>
                        </li>
                       
                        
                    </ul>
                </li>

                <li>
                    <a href='#pageSubmenu7' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Police station list</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu7'>
                        
                        <li>
                        <a href='manage_police_station_list.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage police station list</a>
                        </li>
                       
                        
                    </ul>
                </li>
                
                <li>
                    <a href='#pageSubmenu8' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Setting</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu8'>
                    <li>
                        <a href='profile.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Profile</a>
                        </li>
                        
                        <li>
                        <a href='change_password.php'><i class='fa fa-fw fa-users'></i>&nbsp;Change Password</a>
                        </li>
                        <li>
                        <a href='change_address.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;change_address</a>
                        </li>
                        <li>
                        <a href='change_address_request.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp; profile updation status </a>
                        </li>
                       
                        
                    </ul>
                </li>

              
               
                
            </ul>

            <ul class='list-unstyled CTAs'>
                
                <li>
                    <a href='logout.php'><i class='fa-solid fa-right-from-bracket'></i>&nbsp;Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id='content'>

            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid '>
                  

                    <button type='button' id='sidebarCollapse' class='btn btn-info mt-0'>
                        <i class='fas fa-align-left'></i>
                    </button>
                    <a class='navbar-brand' href='#'>Administration</a>
                    <a class='navbar-brand' href='#'>$email_id</a>
                                            
                          
                         
                        </div>
                      
                   
            
            </nav>";


    }
    elseif($admin_role_type=='moderator'){
        echo "
        <nav id='sidebar'>
            <div class='sidebar-header mt-4'>
                <h3>Tech wizard</h3>
            </div>

            <ul class='list-unstyled components'>
            
             <li>
                        <a href='welcome.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Main Menu</a>
                        </li>
             
                
                <li>
                    <a href='#pageSubmenu3' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Manage Complaint Request</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu3'>
                       
                       
                        <li>
                        <a href='manage_complaint_request.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Complaint</a>
                        </li>
                    </ul>
                </li>





              

              
                <li>
                    <a href='#pageSubmenu8' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Setting</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu8'>
                    <li>
                        <a href='profile.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Profile</a>
                        </li>
                        
                        <li>
                        <a href='change_password.php'><i class='fa fa-fw fa-users'></i>&nbsp;Change Password</a>
                        </li>
                        <li>
                        <a href='change_address.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;change_address</a>
                        </li>
                        <li>
                   <li>
                        <a href='change_address_request.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp; profile updation status </a>
                        </li>
                       
                        
                    </ul>
                </li>
                       
                       
                        
                    </ul>
                </li>
                
            </ul>

            <ul class='list-unstyled CTAs'>
                
                <li>
                    <a href='logout.php'><i class='fa-solid fa-right-from-bracket'></i>&nbsp;Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id='content'>

            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid '>
                  

                    <button type='button' id='sidebarCollapse' class='btn btn-info mt-0'>
                        <i class='fas fa-align-left'></i>
                    </button>
                    <a class='navbar-brand' href='#'>Administration</a>
                    <a class='navbar-brand' href='#'>$email_id</a>
                                            
                          
                         
                        </div>
                      
                   
            
            </nav>";


    }
    else{
        echo "
        <nav id='sidebar'>
            <div class='sidebar-header mt-4'>
                <h3>Tech wizard</h3>
            </div>

            <ul class='list-unstyled components'>
             
                 <li>
                        <a href='welcome.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Main Menu</a>
                        </li>
                        
                <li>
                    <a href='#pageSubmenu3' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Manage Feedback Reviews</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu3'>
                       
                       
                         <li>
                        <a href='https://smilewellnessfoundation.org/team_tech_wizard/admin/feedback_rating.php' target=_blank><i class='fa fa-fw fa-people-roof'></i>&nbsp;Feedback review ratings</a>
                        </li>
                        
                         <li>
                        <a href='https://smilewellnessfoundation.org/team_tech_wizard/admin/manage_feedback.php' target=_blank><i class='fa fa-fw fa-people-roof'></i>&nbsp;Manage Feedback</a>
                        </li>
                    </ul>
                </li>





              

              
               <li>
                    <a href='#pageSubmenu8' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><i class='fa fa-fw fa-user'></i>&nbsp;Setting</a>
                    <ul class='collapse list-unstyled' id='pageSubmenu8'>
                    
                    <li>
                        <a href='profile.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;Profile</a>
                        </li>
                        
                        <li>
                        <a href='change_password.php'><i class='fa fa-fw fa-users'></i>&nbsp;Change Password</a>
                        </li>
                        <li>
                        <a href='change_address.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp;change_address</a>
                        </li>
                        <li>
                        <a href='change_address_request.php'><i class='fa fa-fw fa-people-roof'></i>&nbsp; profile updation status </a>
                        </li>
                       
                        
                    </ul>
                </li>
                
            </ul>

            <ul class='list-unstyled CTAs'>
                
                <li>
                    <a href='logout.php'><i class='fa-solid fa-right-from-bracket'></i>&nbsp;Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id='content'>

            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid '>
                  

                    <button type='button' id='sidebarCollapse' class='btn btn-info mt-0'>
                        <i class='fas fa-align-left'></i>
                    </button>
                    <a class='navbar-brand' href='#'>Administration</a>
                    <a class='navbar-brand' href='#'>$email_id</a>
                                            
                          
                         
                        </div>
                      
                   
            
            </nav>";
    }
?>

                                            
       

 

        
        <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
 

