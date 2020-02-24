$(document).ready(() => {
    StudentNavMenu();
})

function StudentNavMenu() {
    let hook = $("#nav-menu-hook");

    const pages = {
        "home": {
            "href": base_url + "app/student/home",
            "name": "Dashboard"
        },
        "courses": {
            "href": base_url + "app/student/courses",
            "name": "Courses"
        }
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}
