$(document).ready(() => {
    AdminNavMenu();
})

function AdminNavMenu() {
    let container = $("<div id='nav-menu-container'></div>")

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

    container.append(getNavBarUserSection())
    container.append("<hr>")
    container.append(getNavBarLinks(pages))
    $("#nav-menu-hook").append(container)

    loadNavBarUserInfo();
}
