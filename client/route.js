let dashboard = "";
let transfer = "";
let settings = "";
let historyy = "";
let notifications = "";
let search = "";

const loadDocument = async (page) => {
    const response = await fetch(page);
    const resHTML = await response.text();
    return resHTML;
};

const loadAllDocuments = async () => {
    dashboard = await loadDocument("route-pages/dashboard.php");
    transfer = await loadDocument("route-pages/transfer.php");
    settings = await loadDocument("route-pages/settings.php");
    historyy = await loadDocument("route-pages/history.php");
    notifications = await loadDocument("route-pages/notifications.php");
    search = await loadDocument("route-pages/search.php");
};

const root = document.getElementById("root");

const main = async () => {
    await loadAllDocuments();
    root.innerHTML = dashboard;
    routes = {
        '/client/' : dashboard,
        '/client/transfer' : transfer,
        '/client/settings' : settings,
        '/client/history' : historyy,
        '/client/notifications' : notifications,
        '/client/search' : search
    };

    try { 
        root.innerHTML = routes[window.location.pathname];
        if(!routes[window.location.pathname]) { 
            root.innerHTML = '<div class="p-404">' +
            '<p class="h">404</p>' +
            '<p class="m">Page Not Found!</p>' +
            '<div>'; 
        } 
    } catch(e) {
        console.log("Use Home page");
    }
};

main();
activeLink();

const onNavClick = (pathname) => {
    window.history.pushState({}, pathname, window.location.origin + pathname);
    root.innerHTML = routes[pathname];
    activeLink();
};

window.onpopstate = () => {
    root.innerHTML = routes[window.location.pathname];
    activeLink();
};

function activeLink() {
    try {

        let link1 = document.getElementById('dashboard-link');
        let link2 = document.getElementById('dashboard-sr-link');
        let link3 = document.getElementById('dashboard-h-link');
        let link4 = document.getElementById('dashboard-s-link');
        switch(window.location.pathname) {
            case '/client/':
                link1.classList.add('active');
                link2.classList.remove('active');
                link3.classList.remove('active');
                link4.classList.remove('active');
            break;
            case '/client/transfer':
                link1.classList.remove('active');
                link2.classList.add('active');
                link3.classList.remove('active');
                link4.classList.remove('active');
            break;
            case '/client/history':
                link1.classList.remove('active');
                link2.classList.remove('active');
                link3.classList.add('active');
                link4.classList.remove('active');
            break;
            case '/client/settings':
                link1.classList.remove('active');
                link2.classList.remove('active');
                link3.classList.remove('active');
                link4.classList.add('active');
            break;
        }

    } catch(e) {
        console.error(e);
    }
}