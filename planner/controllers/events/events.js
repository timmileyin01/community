$(document).ready(function () {
    showAllEvents();
  
    function showAllEvents() {
      $.ajax({
        url: "http://localhost/community/planner/controllers/events/events.php",
        type: "POST",
        data: {
          action: "view",
        },
        success: function (response) {
          console.log(response);
          $("#showEvent").html(response);
          $("table").DataTable({
            order: [0, "desc"],
          });
        },
      });
    }
  
    // function to display image before upload
    $("input.image").change(function () {
      var file = this.files[0];
      var url = URL.createObjectURL(file);
      $(this).closest(".prevImg").find(".preview_img").attr("src", url);
    });


    //file type validation
  $("#image").change(function () {
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (
      !(imagefile == match[0] || imagefile == match[1] || imagefile == match[2])
    ) {
      alert("Please select a valid image file (JPEG/JPG/PNG).");
      $("#image").val("");
      return false;
    }
  });



  $("body").on("click", ".reminderBtn", function (e) {
    e.preventDefault();
    message_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/planner/controllers/events/events.php",
      type: "POST",
      data: {
        message_id: message_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        $('#form-reminder-data [name="event_id"]').val(response.event_id);
      },
    });
  });

  $("#form-reminder-data").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#reminderBtn").prop("disabled", true);
  
    var formData = new FormData(this);
    formData.append("action", "reminderMessage");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/planner/controllers/events/events.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#form-reminder-data")[0].reset();
          $("#reminderModal").modal("hide");
          // Enables a button
          $("#reminderBtn").prop("disabled", false);
          swal.fire("Done!", "Message sent successfully 😎", "success");
        } else if (msg == "400") {
          $("#reminderBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem Sending Message 😓",
            icon: "error",
          });
        }else if (msg == "700") {
          $("#reminderBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#reminderBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Website title must be more than five characters! 😓",
            icon: "error",
          });
        }
      },
    });
  });






  //add new user ajax request
  $("#add-event-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#addEventBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "addNewEvent");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/events/events.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#add-event-form")[0].reset();
          $(".preview_img").attr("src", "./img/default_profile.jpg");
          $("#addEventModal").modal("hide");
          // Enables a button
          $("#addEventBtn").prop("disabled", false);
          swal.fire("Added!", "Event Created successfully 😎", "success");
          showAllEvents();
        } else if (msg == "200") {
          $("#addEventBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Event exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#addEventBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem creating Event 😓",
            icon: "error",
          });
        } else if (msg == "500") {
          $("#addEventBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please check that your flyer is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
            icon: "error",
          });
        } else if (msg == "600") {
          $("#addEventBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please select a flyer 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#addEventBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "800") {
          $("#addEventBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "An error occured with flyer upload! 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#addEventBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Event title must be more than five characters! 😓",
            icon: "error",
          });
        }
      },
    });
  });



  
  //edit user ajax request

  $("body").on("click", ".editBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/events/events.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        console.log(response);
        $('#edit-event-form [name="event_id"]').val(response.event_id);
        $('#edit-event-form [name="title"]').val(response.title);
        $('#edit-event-form [name="description"]').val(response.description);
        $('#edit-event-form [name="category_id"]').val(response.category_id);
        $('#edit-event-form [name="date"]').val(response.date);
        $('#edit-event-form [name="time"]').val(response.time);
        $('#edit-event-form [name="center_id"]').val(response.center_id);
        $('#edit-event-form [name="regularPrice"]').val(response.regular);
        $('#edit-event-form [name="vipPrice"]').val(response.vip);
        $('#edit-event-form [name="vvipPrice"]').val(response.vvip);
        
      },
    });
  });

  //update ajax request
 $("#edit-event-form").on("submit", function (e) {
  e.preventDefault();
  // Disables a button
  $("#editEventBtn").prop("disabled", true);

  var formData = new FormData(this);
  formData.append("action", "updateEvent");
  $.ajax({
    type: "POST",
    url: "http://localhost/community/admin/controllers/events/events.php",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    success: function (msg) {
      console.log(msg);
      if (msg == "300") {
        $("#edit-event-form")[0].reset();
        $(".preview_img").attr("src", "./img/default_profile.jpg");
        $("#editEventModal").modal("hide");
        // Enables a button
        $("#editEventBtn").prop("disabled", false);
        swal.fire("Updated!", "Event Updated successfully 😎", "success");
        showAllEvents();
      } else if (msg == "200") {
        $("#editEventBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Event exists in the database 😓",
          icon: "error",
        });
      } else if (msg == "400") {
        $("#editEventBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "There was a problem creating Event 😓",
          icon: "error",
        });
      } else if (msg == "500") {
        $("#editEventBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Please check that your flyer is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
          icon: "error",
        });
      } else if (msg == "600") {
        $("#editEventBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Please select an image 😓",
          icon: "error",
        });
      } else if (msg == "700") {
        $("#editEventBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "You must fill all fields except the image field 😓",
          icon: "error",
        });
      } else if (msg == "800") {
        $("#editEventBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "An error occured with flyer upload 😓",
          icon: "error",
        });
      } else if (msg == "900") {
        $("#editEventBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Event title must be more than three characters! 😓",
          icon: "error",
        });
      }
    },
  });
});
  

  //detele ajax request

  $("body").on("click", ".delBtn", function (e) {
    e.preventDefault();
    var tr = $(this).closest("tr");
    del_id = $(this).attr("id");

    swal
      .fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "http://localhost/community/admin/controllers/events/events.php",
            type: "POST",
            data: {
              del_id: del_id,
            },
            cache: false,
            success: function (response) {
              if (response == '100') {
                tr.css("background-color", "#ff6666");
                swal.fire(
                  'Deleted!',
                  'Event deleted successfully',
                  'success'
              );
                showAllEvents();
                
              }else{
                swal.fire("Error!", "Something went wrong try again later! 😢😢", "error");

              }
            },
          });
        }
      });
  });

  //show user details request
  $("body").on("click", ".infoBtn", function (e) {
    e.preventDefault();

    info_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/events/events.php",
      type: "POST",
      data: {
        info_id: info_id,
      },
      success: function (response) {
        data = JSON.parse(response);
        swal.fire({
          title: "<strong>Event Info : </strong>",
          type: "info",
          html:
          
          "<img width='150px' height='150px' src='../admin/uploads/" +
            data.image + "'></img> <br />" +
            "<b>Title : </b>" +
            data.title +
            "<br><b>Description : </b>" +
            data.description + 
            "<br><b>Category : </b>" +
            data.category_name +
            "<br><b>Date : </b>" +
            data.date +
            "<br><b>Time : </b>" +
            data.time +
            "<br><b>Event Center : </b>" +
            data.center_name +
            "<br><b>Capacity : </b>" +
            data.capacity +
            "<br><b>Address : </b>" +
            data.address +
            "<br><b>Regular Price : </b>" +
            data.regular +
            "<br><b>VIP Price : </b>" +
            data.vip +
            "<br><b>VVIP Price : </b>" +
            data.vvip,
          showCancelButton: true,
        });
      },
    });
  });



});