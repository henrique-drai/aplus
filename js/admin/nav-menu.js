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

        "courses": {
            "href": base_url + "app/admin/courses",
            "name": "Courses"
        },  
        "unidCurricular": {
            "href": base_url + "app/admin/unidCurricular",
            "name": "Curricular Units"
        },

        "subjects": {
            "href": base_url + "app/admin/subjects",
            "name": "Subjects"
        },
        "teachers": {
            "href": base_url + "app/admin/teachers",
            "name": "Teachers"
        },
        "students": {
            "href": base_url + "app/admin/students",
            "name": "Students"
        },
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}
