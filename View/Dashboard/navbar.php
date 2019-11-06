<!DOCTYPE html>
    <html>
        <head>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <title>Soul Society</title>
            <style>
                #main  {
                    position:fixed;
                    padding:0;
                    margin:0;

                    height:110%;
                    width :110%;
                    transition: background-color .5s;
                    background-image: url("../../Wallpaper/background_wallpaper.jpg");
                }
                #mySidenav {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
                }
                    
                #mySidenav a,#userLogout{
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
                }

                #mySidenav a:hover,#userLogout:hover{
                color: #f1f1f1;
                }

                #mySidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
                }

                #main {
                transition: margin-left .5s;
                padding: 16px;
                }

                @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
                }
            </style>
        </head>
        <body>
        <div id="mySidenav">
        <a href="" class="closebtn" id="closeNav">&times;</a>
        <a href="../Dashboard/dashboard.php">Home</a>
        <a href="../Profil/profil.php">Profil</a>
        <a href="../User/user.php">Users</a>
        <a href="../Group/group.php">Groups</a>
        <a href="../Event/event.php">Events</a>
        <p id="userLogout" >Logout</p>
        </div>

            <script>
                $(document).ready(function() {

                    $.post('../../Controller/LoginController/isUserConnected.php',{},function(data){
                        var info = JSON.parse(data);
                        if(info[0] == false){
                            window.location.href="../home.php";
                        }
                    });

                    $("#userLogout").click(function(){
                        $.post('../../Controller/LoginController/userLogout.php',{},function(data){
                            window.location.href="../home.php";
                        });
                    });

                    $("#closeNav").click(function() {
                    $("#mySidenav").css("width","0");
                    $("#main").css("marginLeft","0");
                    document.body.style.backgroundColor = "white";
                    });
                    
                    $("#openNav").click(function(){
                    $("#mySidenav").css("width","250px");
                    $("#main").css("marginLeft","250px");
                    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
                    });

                });
            </script>
        </body>
    </html>