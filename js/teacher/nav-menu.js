$(document).ready(() => {
    TeacherNavMenu();
})

function TeacherNavMenu() {
    let hook = $("#nav-menu-hook");

    const pages = {
        "home": {
            "href": base_url + "app",
            "name": "Dashboard"
        },
        "subjects": {
            "href": base_url + "subjects",
            "name": "Subjects"
        }
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}

