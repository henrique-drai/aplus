$(document).ready(() => {
    AdminNavMenu();
})

function AdminNavMenu() {
    let hook = $("#nav-menu-hook");

    const pages = {
        "home": {
            "href": base_url + "app/admin/home",
            "name": "Dashboard"
        },
        "courses": {
            "href": base_url + "app/admin/courses",
            "name": "Courses"
        },
        "teachers": {
            "href": base_url + "app/admin/teachers",
            "name": "Teachers"
        },
        "atudents": {
            "href": base_url + "app/admin/students",
            "name": "Students"
        }
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}
