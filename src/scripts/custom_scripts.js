(function() {
    const body = document.body;

    // 1. IMMEDIATE CHECK (Run this before the page even finishes loading if possible)
    if (localStorage.getItem('sidebar-state') === 'closed') {
        body.classList.add('sidebar-close');
    }

    // 2. THE OBSERVER: Watch the <body> for class changes
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === "class") {
                const isClosed = body.classList.contains('sidebar-close');
                localStorage.setItem('sidebar-state', isClosed ? 'closed' : 'open');
                console.log("Sidebar state saved:", isClosed ? 'closed' : 'open');
            }
        });
    });

    // 3. START WATCHING
    observer.observe(body, { attributes: true });
})();

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