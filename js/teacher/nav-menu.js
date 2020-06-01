$(document).ready(() => {

    const pages = {
        "home": {
            "href": base_url + "app",
            "name": "Painel de Controlo"
        },
        "subjects": {
            "href": base_url + "subjects",
            "name": "Cadeiras"
        },
        "chat": {
            "href": base_url + "app/chat",
            "name": "Chat"
        },
    }

    printNavBarLinks(pages)
    
})