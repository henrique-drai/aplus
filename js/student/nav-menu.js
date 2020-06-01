$(document).ready(() => {

    const pages = {
        "home": {
            "href": base_url + "app",
            "name": "Painel de Controlo"
        },
        "subjects": {
            "href": base_url + "app/student/subjects",
            "name": "Cadeiras"
        },
        "grupos": {
            "href": base_url + "app/student/grupos",
            "name": "Grupos"
        },
        "chat": {
            "href": base_url + "app/chat",
            "name": "Chat"
        },
        // "rating": {
        //     "href": base_url + "app/student/rating",
        //     "name": "Rating"
        // }
    }

    printNavBarLinks(pages)
})