$(document).ready(() => {
    StudentNavMenu();
})

function StudentNavMenu() {
    let hook = $("#nav-menu-hook");

    const pages = {
        "home": {
            "href": base_url + "app",
            "name": "Painel de Controlo"
        },
        "subjects": {
            "href": base_url + "app/student/subjects",
            "name": "Cadeiraas"
        }
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}
