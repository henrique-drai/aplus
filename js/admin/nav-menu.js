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
        "students": {
            "href": base_url + "app/admin/students",
            "name": "Students"
        },
        "registerUser": {
            "href": base_url + "app/admin/registerUser",
            "name": "Register User"
        }
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}
