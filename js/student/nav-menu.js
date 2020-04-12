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
        "rating": {
            "href": base_url + "app/student/rating",
            "name": "Rating"
        }
    }

    printNavBarLinks(pages)
})