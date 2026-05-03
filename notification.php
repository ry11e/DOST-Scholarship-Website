<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



?>

<div class="notification-row"
    style="
            display:flex;
            justify-content: center;
    ">
    <div id="notification-box"
        style="
        position: fixed;
        top: 10%;           
        left: 50%; /* Center horizontally */
        transform: translateX(-50%); 
        z-index: 1000;  
        display: flex;
        justify-content: center;
        align-items: center;
        height: 15%;
        width: 20%;
        background-color: #b8ffcd;
        color: #00d744;
        border: #afffc9 solid 2px;
        padding: 15px;
        border-radius: 10px;
        opacity: 0;
        pointer-events: none; /* <--- THIS IS THE KEY */
        transition: opacity 0.5s ease; /* Makes it fade smoothly */
    "
        class="text-center">
    </div>
</div>