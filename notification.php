<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }



?>

<div class="notification-row"
        style="
            display:flex;
            justify-content: center;
    ">
    <div id ="notification-box"
        style="
            position: fixed;
            top: 10%;           
            z-index: 1000;  
            
            display: flex;
            justify-content:center;
            align-items:center;
            
            height: 10%;
            width: 20%;

            background-color: #b8ffcd;
            color: #00892c;
            padding: 15px;
            border-radius: 10px;

            opacity: 0;
        ">
        
    </div>
</div>


