$(document).ready(() => {

    $(".profile-edit-user").change(() => validate_form_values())

    $(".profile-edit-user input[type='submit']").click(() => submit_form_values())

    function validate_form_values(){
        let password = $(".profile-edit-user input[name='password']")
        let confirm = $(".profile-edit-user input[name='confirm']")
    
        if (password.val() != "" && password.val() != confirm.val()) {
            if(confirm.val() != "") {
                $(".profile-edit-user label[for='confirm'] div").text("As passwords não coincidem.")
            } else {
                $(".profile-edit-user label[for='confirm'] div").text("")
            }
            return false
        }
        $(".profile-edit-user label[for='confirm'] div").text("")
    
        return true
    }
    
    function submit_form_values(){
        if (validate_form_values()){
            const name = $(".profile-edit-user input[name='name']").val()
            const surname = $(".profile-edit-user input[name='surname']").val()
            const password = $(".profile-edit-user input[name='password']").val()
    
            let data = {}
    
            if(name != "")
                data.name = name
            if(surname != "")
                data.surname = surname
            if(password != "")
                data.password = password
    
            data.description = $(".profile-edit-user textarea").val()
            data.gabinete = $(".profile-edit-user input[name='gabinete']").val()
    
            console.log("Informação que será alterada:")
            console.log(data)
    
            $.ajax({
                type: "POST",
                url: base_url + "api/user",
                data: data,
                success: function(data) {
                    console.log(data)
                    location.reload()
                },
                error: function(data) {
                    console.log("Problema na API ao submeter a edição do utilizador.")
                    console.log(data)
                }
            })
        } else {
            console.log("Denied.")
        }
    }
})

