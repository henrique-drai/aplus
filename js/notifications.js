$(document).ready(()=>{

  $.ajax({
    type: "GET",
    headers: {"Authorization": localStorage.token},
    url: base_url + "api/notifications/all",
    success: function(data) {
      $('#all_noti-outter').pagination({
        dataSource: data,
        pageSize: 30,
        pageNumber: 1,
        callback: function(data, pagination) {
          renderNotificationPage(data)
        }
      })
    },
    error: function(data) {
      console.log("Problema em api/notifications/all")
    }
  })
})


function renderNotificationPage(notifications){

  function getDate(date){
    const diff = Date.now() - new Date(date)

    if (diff < 1000*60*60*24)
        return "Há "+Math.floor(diff/1000/60/60)+" horas"

    return "Há "+Math.floor(diff/1000/60/60/24)+" dias"
  }

  let divs = []
  
  for (const n of notifications) {
      let img

      switch(n.type){
          case "message":
              img = $('<img src="' + base_url + 'images/icons/message.png" alt="Message Notification">')
              break
          case "alert":
              img = $('<img src="' + base_url + 'images/icons/alert.png" alt="Alert Notification">')
              break
          default: break
      }
      
      divs.push(
          $('<div class="notification"></div>').append(
              $('<div class="icon"></div>').append(img),
              $('<div class="body"></div>').append(
                  $('<a href="' + base_url + n.link + '"></a>').append(
                      $("<div></div>").append(
                          $('<div class="title">' + n.title + '</div>'),
                          $('<div class="content">' + n.content + '</div>'),
                          $('<div class="date">' + getDate(n.date) + '</div>')
                      )
                  )
              ),
              $('<div class="options"></div>')
          )
      )
  }

  $("#all_noti-inner").html(divs)
  
}