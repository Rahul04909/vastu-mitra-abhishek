document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const mobileToggle = document.querySelector('.mobile-toggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarClose = document.querySelector('.sidebar-close');
    const overlay = document.querySelector('.overlay');
    const sidebarLinks = document.querySelectorAll('.sidebar-link');

    // Sticky Header Logic
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Sidebar Toggle Logic
    const openSidebar = () => {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    };

    const closeSidebar = () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    };

    mobileToggle.addEventListener('click', openSidebar);
    sidebarClose.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);

    // Close sidebar when clicking a link
    sidebarLinks.forEach(link => {
        link.addEventListener('click', closeSidebar);
    });

    // Handle Active Menu Item
    const currentPath = window.location.pathname.split('/').pop() || 'index.php';
    const menuLinks = document.querySelectorAll('.nav-link, .sidebar-link');
    
    menuLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPath) {
            link.classList.add('active');
        }
    });
});

// Toggle Submenu for Mobile Sidebar
function toggleSubmenu(event, submenuId) {
    event.preventDefault();
    event.stopPropagation();
    const submenu = document.getElementById(submenuId);
    const icon = event.currentTarget.querySelector('i');
    
    if (submenu.style.display === 'none' || submenu.style.display === '') {
        submenu.style.display = 'block';
        if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
        submenu.style.display = 'none';
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
}
