const mobileScreen = window.matchMedia("(max-width: 990px)");

document.addEventListener("DOMContentLoaded", function() {

    $('.select2').select2({
        tags: true
    });

    const dashboardNavDropdownToggles = document.querySelectorAll(".dashboard-nav-dropdown-toggle");
    dashboardNavDropdownToggles.forEach(function(toggle) {
        toggle.addEventListener("click", function() {
            const dropdown = toggle.closest(".dashboard-nav-dropdown");
            dropdown.classList.toggle("show");

            const subDropdowns = dropdown.querySelectorAll(".dashboard-nav-dropdown");
            subDropdowns.forEach(function(subDropdown) {
                subDropdown.classList.remove("show");
            });

            const siblings = toggle.parentElement.parentElement.children;
            for (let sibling of siblings) {
                if (sibling !== toggle.parentElement) {
                    sibling.classList.remove("show");
                }
            }
        });
    });

    const menuToggleApp = document.querySelector("#menu-toggle-app")
    const menuToggleNav = document.querySelector("#menu-toggle-nav") ;
    
    document.addEventListener("click", e => {
        if(e.target.id == menuToggleApp.id || e.target.id == menuToggleNav.id ){
            if (mobileScreen.matches) {
                const dashboardNav = document.querySelector(".dashboard-nav");
                dashboardNav.classList.toggle("mobile-show");
            } else {
                const dashboard = document.querySelector(".dashboard");
                dashboard.classList.toggle("dashboard-compact");
            } 
        }

    });
    
});


