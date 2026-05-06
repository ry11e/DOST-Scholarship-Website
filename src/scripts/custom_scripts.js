/*(function() {
    const body = document.body;
    const leftSidebar = document.querySelector('left-side-bar');

    // 1. IMMEDIATE CHECK (Run this before the page even finishes loading if possible)
    if (localStorage.getItem('sidebar-state') === 'closed') {
        body.classList.add('sidebar-close');
        if(leftSidebar){
            leftSidebar.classList.remove('open');
            //console.log("sidebar exists");
        }
        else{
            //console.log("sidebar doesn't exist");
        }
        
    }
    
    // 2. THE OBSERVER: Watch the <body> for class changes
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === "class") {
                const isClosed = body.classList.contains('sidebar-close');
                const sideBarIsOpen = leftSidebar.contains('open');
                const sideBarIsClosed = !sideBarIsOpen;

                localStorage.setItem('sidebar-state', sideBarIsClosed ? 'closed' : 'open');
                //console.log("Sidebar state saved:", sideBarIsClosed ? 'closed' : 'open');
            }
        });
    });

    // 3. START WATCHING
    observer.observe(body, { attributes: true });
})();
*/


document.addEventListener('DOMContentLoaded', function() {
    const leftSidebar = document.getElementById('left-side-bar');
    const menuIcon = document.querySelector('.menu-icon');
    const body = document.body;

    if (!leftSidebar) return; // Exit early if sidebar is missing

    // 1. INITIAL LOAD: Apply the saved state immediately
    const savedState = localStorage.getItem('sidebar-state');
    
    if (savedState === 'closed') {
        //leftSidebar.classList.remove('open');
        body.classList.add('sidebar-shrink');
        console.log("Applying saved state: Closed");
    } else if (savedState === 'open') {
        //leftSidebar.classList.add('open');
        body.classList.remove('sidebar-shrink');
        console.log("Applying saved state: Open");
    }

    // 2. TOGGLE LOGIC
    if (menuIcon) {
        menuIcon.addEventListener('click', function() {
            // Wait just long enough for the template's internal script to toggle the class
            // 1000ms (1 second) is way too long; 50ms is usually plenty.
            setTimeout(() => {
                /*
                const isOpen = leftSidebar.classList.contains('open');
                
                if (isOpen) {
                    localStorage.setItem('sidebar-state', 'open');
                    //console.log("State saved: open");
                } else {
                    localStorage.setItem('sidebar-state', 'closed');
                    //console.log("State saved: closed");
                }
                */
                const bodyIsClosed = body.classList.contains('sidebar-shrink');

                if (bodyIsClosed) {
                    localStorage.setItem('sidebar-state', 'closed');
                    console.log("State saved: closed");
                } else {
                    localStorage.setItem('sidebar-state', 'open');
                    console.log("State saved: open");
                }
            }, 50); 
        });
    }
});

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