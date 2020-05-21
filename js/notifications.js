noti_state = {
  pageNumber: 1,
}

$(document).ready(()=>{
  updateNotificationPage()
})

function updateNotificationPage(){
  $.ajax({
    type: "GET",
    url: base_url + "api/notifications/all",
    success: function(data) {
      $('#all_noti-outter').pagination({
        dataSource: data,
        pageSize: 15,
        pageNumber: noti_state.pageNumber,
        callback: function(data, pagination) {
          renderNotificationPage(data)
          noti_state.pageNumber = pagination.pageNumber
        }
      })
    },
    error: function(data) {
      console.log("Problema em api/notifications/all")
    }
  })
}

function renderNotificationPage(notifications){
  function getDate(date){
    const diff = Date.now() - new Date(date)

    if (diff < 1000*60*60*24)
        return "Há "+Math.floor(diff/1000/60/60)+" horas"

    return "Há "+Math.floor(diff/1000/60/60/24)+" dias"
  }

  async function notificationDelete(id, callback=null){
    $.ajax({
      type: "DELETE",
      url: base_url + "api/notification/" + id,
      success: function(data) {
        console.log(data)
        if(callback)
          callback()
      },
      error: function(data) {
        console.log("Problema em api/notification/ DELETE")
      }
    })
  }

  async function notificationSeen(id, callback=null){
    $.ajax({
      type: "POST",
      url: base_url + "api/notification/" + id,
      success: function(data) {
        console.log(data)
        if(callback)
          callback()
      },
      error: function(data) {
        console.log("Problema em api/notification/seen POST")
      }
    })
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

      let notification = $('<div class="notification"></div>').append(
        $('<div class="icon"></div>').append(img),
        $('<div class="body"></div>').append(
          $('<a href="' + base_url + n.link + '"></a>').append(
            $("<div></div>").append(
              $('<div class="title">' + n.title + '</div>'),
              $('<div class="content">' + n.content + '</div>'),
              $('<div class="date">' + getDate(n.date) + '</div>')
            )
          )
        )
      )

      let delete_option = $('<div class="trash"></div>').append(
        $('<img src="' + base_url + 'images/icons/trash.png" alt="">')).click(()=>{
          notificationDelete(n.id, updateNotificationPage)
        })

      let options = $('<div class="options"></div>')

      if (n.seen === "1"){
        notification.addClass("seen")
      } else {
        options.append(
          $('<div class="eye"></div>').append(
            $('<img src="' + base_url + 'images/icons/eye.png" alt="">')
          ).click(()=>{
            notificationSeen(n.id, updateNotificationPage)
          })
        )
      }

      options.append(delete_option)

      notification.append(options)
      divs.push(notification)
  }

  $("#all_noti-inner").html(divs)
  
}




