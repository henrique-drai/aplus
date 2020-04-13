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
        "chat": {
            "href": base_url + "app/chat/"+localStorage.user_id,
            "name": "Chat"
        },
    }

    printNavBarLinks(pages)
})