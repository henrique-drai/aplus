$(document).ready(() => {
    AdminNavMenu();
})

function AdminNavMenu() {
    let hook = $("#nav-menu-hook");

    const pages = {
        "home": {
            "href": base_url + "app/",
            "name": "Dashboard"
        },
        "anoLetivo": {
            "href": base_url + "app/admin/anoLetivo",
            "name": "School Year"
        },
        "college": {
            "href": base_url + "app/admin/college",
            "name": "College"
        },
        "unidCurricular": {
            "href": base_url + "app/admin/unidCurricular",
            "name": "Curricular Units"
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
            "name": "Manage Users"
        }
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}
