$(document).ready(function () {
    showAllEarnings();
  
    function showAllEarnings() {
      $.ajax({
        url: "http://localhost/community/admin/controllers/earning/earning.php",
        type: "POST",
        data: {
          action: "view",
        },
        success: function (response) {
          console.log(response);
          $("#showEarnings").html(response);
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

  //edit user ajax request

  $("body").on("click", ".editBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/earning/earning.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        console.log(response);
        $('#edit-account-form [name="account_id"]').val(response.event_id);
        $('#edit-account-form [name="balance"]').val(response.balance);        
      },
    });
  });


    //show user details request
    $("body").on("click", ".infoBtn", function (e) {
        e.preventDefault();
    
        info_id = $(this).attr("id");
    
        $.ajax({
          url: "http://localhost/community/admin/controllers/earning/earning.php",
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
              
                "<b>Name : </b>" +
                data.name +
                "<br><b>No. of Events : </b>" +
                data.no_of_events + 
                "<br><b>Tickets Sold : </b>" +
                data.tickets_sold +
                "<br><b>Balance : </b>" +
                data.balance,
                showCancelButton: true,
              });
          },
        });
      });



  //update ajax request
  $("#edit-account-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#editAccountBtn").prop("disabled", true);
  
    var formData = new FormData(this);
    formData.append("action", "updateAccount");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/earning/earning.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#edit-account-form")[0].reset();
          $("#editModal").modal("hide");
          // Enables a button
          $("#editAccountBtn").prop("disabled", false);
          swal.fire("Updated!", "Account Updated successfully 😎", "success");
          showAllCategories();
        } else if (msg == "200") {
          $("#editAccountBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Account exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#editAccountBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem Updating Account 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#editAccountBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#editAccountBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Account name must be more than three characters! 😓",
            icon: "error",
          });
        }
      },
    });
  });


});