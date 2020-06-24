$(document).ready(() => {
    
    const pages = {
        "home": {
            "href": base_url + "app/",
            "name": "Painel de Controlo"
        },
        "anoLetivo": {
            "href": base_url + "app/admin/anoLetivo",
            "name": "Ano Letivo"
        },
        "Faculdades": {
            "href": base_url + "app/admin/college",
            "name": "Faculdades"
        },
        "courses": {
            "href": base_url + "app/admin/courses",
            "name": "Cursos"
        },  
        "subjects": {
            "href": base_url + "app/admin/subjects",
            "name": "Cadeiras"
        },
        "utilizadores": {
            "href": base_url + "app/admin/users",
            "name": "Utilizadores"
        },
        "chat": {
            "href": base_url + "app/chat",
            "name": "Chat"
        },
    }

    printNavBarLinks(pages)
})