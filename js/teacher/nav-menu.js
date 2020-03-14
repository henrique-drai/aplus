$(document).ready(() => {
    TeacherNavMenu();
})

function TeacherNavMenu() {
    let hook = $("#nav-menu-hook");

    const pages = {
        "home": {
            "href": base_url + "app/teacher/home",
            "name": "Dashboard"
        },
        "courses": {
            "href": base_url + "app/teacher/courses_prof",
            "name": "Courses"
        },
        "projects": {
            "href": base_url + "app/teacher/projects",
            "name": "Projects"
        }
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}

