$(document).ready(function () {

//edit user ajax request

$("body").on("click", ".updateSetBtn", function (e) {
    e.preventDefault();
    edit_id = 1;

    $.ajax({
      url: "http://localhost/community/admin/controllers/settings/settings.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        $('#form-setting-data [name="title"]').val(response.title);
        $('#form-setting-data [name="about"]').val(response.about);
      },
    });
  });

$("body").on("click", ".reminderBtn", function (e) {
    e.preventDefault();
    message_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/settings/settings.php",
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



    //update ajax request
 $("#form-setting-data").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#settingBtn").prop("disabled", true);
  
    var formData = new FormData(this);
    formData.append("action", "updateSetting");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/settings/settings.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#form-setting-data")[0].reset();
          $(".preview_img").attr("src", "./img/default_profile.jpg");
          $("#settingsModal").modal("hide");
          // Enables a button
          $("#settingBtn").prop("disabled", false);
          swal.fire("Updated!", "Settings Updated successfully 😎", "success");
        } else if (msg == "400") {
          $("#settingBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem Updating Setting 😓",
            icon: "error",
          });
        } else if (msg == "500") {
          $("#settingBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please check that your Logo is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
            icon: "error",
          });
        } else if (msg == "600") {
          $("#settingBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please select an image 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#settingBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields except the image field 😓",
            icon: "error",
          });
        } else if (msg == "800") {
          $("#settingBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "An error occured with image upload, Retry again! 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#settingBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Website title must be more than five characters! 😓",
            icon: "error",
          });
        }
      },
    });
  });
    //update ajax request
 $("#form-message-data").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#messageBtn").prop("disabled", true);
  
    var formData = new FormData(this);
    formData.append("action", "addMessage");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/settings/settings.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#form-message-data")[0].reset();
          $("#messageModal").modal("hide");
          // Enables a button
          $("#messageBtn").prop("disabled", false);
          swal.fire("Done!", "Message sent successfully 😎", "success");
        } else if (msg == "400") {
          $("#messageBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem Sending Message 😓",
            icon: "error",
          });
        }else if (msg == "700") {
          $("#messageBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#messageBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Website title must be more than five characters! 😓",
            icon: "error",
          });
        }
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
      url: "http://localhost/community/admin/controllers/settings/settings.php",
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


});