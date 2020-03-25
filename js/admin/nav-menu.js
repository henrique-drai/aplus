$(document).ready(() => {
    AdminNavMenu();
})

function AdminNavMenu() {
    let hook = $("#nav-menu-hook");

    const pages = {
        "home": {
            "href": base_url + "app/",
            "name": "Painel de Controlo"
        },
        "anoLetivo": {
            "href": base_url + "app/admin/anoLetivo",
            "name": "Ano Letivo"
        },

        "courses": {
            "href": base_url + "app/admin/courses",
            "name": "Cursos"
        },  
        "subjects": {
            "href": base_url + "app/admin/subjects",
            "name": "Cadeiras"
        },
        "teachers": {
            "href": base_url + "app/admin/teachers",
            "name": "Professores"
        },
        "students": {
            "href": base_url + "app/admin/students",
            "name": "Alunos"
        },
    }

    hook.append(getNavBarUserSection())
    hook.append("<hr>")
    hook.append(getNavBarLinks(pages))

    loadNavBarUserInfo();
}
