$(document).ready(() => {

    const pages = {
        "home": {
            "href": base_url + "app",
            "name": "Painel de Controlo"
        },
        "subjects": {
            "href": base_url + "app/student/subjects",
            "name": "Cadeiras"
        }
    }

    printNavBarLinks(pages)
})