

/*
document.addEventListener('DOMContentLoaded', function() {
    console.log(localStorage.getItem('sidebar-state'));
    // 1. Identify the toggle button and the body
    const menuIcon = document.querySelector('.menu-icon');
    const body = document.body;
    const close = document.querySelector('.ion-close-round');

    if(close){
        console.log("close exists");
    }

    // 2. On Load: Check if the user previously closed the sidebar
    if (localStorage.getItem('sidebar-state') === 'closed') {
        body.classList.add('sidebar-close'); // DeskApp standard class
    }

    // 3. On Click: Save the new state
    if (menuIcon || close) {
        menuIcon.addEventListener('click', function() {
            // We use a tiny timeout to wait for the template's built-in toggle to finish
            console.log("A" + localStorage.getItem('sidebar-state'));
            setTimeout(() => {
                if (body.classList.contains('sidebar-close')) {
                    console.log("closed by press");
                    localStorage.setItem('sidebar-state', 'closed');
                } else {
                    console.log("open by press");
                    localStorage.setItem('sidebar-state', 'open');
                }
            }, 1000);
        });
    }
});
*/


function showNotification2(msg, status) {

        const box = document.getElementById('notification-box');
        console.log(box);
        console.log("AAAAAAA");

        console.log(box);
        if (status = "success") {
            box.style.color = 'green';
            box.style.background = 'rgb(230, 255, 238)';
        } else if (status = "error") {
            box.style.color = 'red';
            box.style.background = '#ffd7d7';
        }


        if (msg != null || msg != "") {
            box.innerHTML = msg;
        }
        
        if (box) {
            // Fade in
            setTimeout(() => {
                box.style.opacity = '1';
            }, 100);

            // Fade out after 4 seconds
            setTimeout(() => {
                box.style.opacity = '0';
                // Optional: remove from DOM after fade
                setTimeout(() => box.remove(), 1000);
            }, 3000);
        }
    
            

    }