$(document).ready(function () {
    showAllCenters();
  
    function showAllCenters() {
      $.ajax({
        url: "http://localhost/community/vendor/controllers/eventCenters/eventCenters.php",
        type: "POST",
        data: {
          action: "view",
        },
        success: function (response) {
          console.log(response);
          $("#showCenter").html(response);
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






  //add new user ajax request
  $("#add-center-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#addCenterBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "addNewCenter");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/eventCenters/eventCenters.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#add-center-form")[0].reset();
          $(".preview_img").attr("src", "./img/default_profile.jpg");
          $("#addCenterModal").modal("hide");
          // Enables a button
          $("#addCenterBtn").prop("disabled", false);
          swal.fire("Added!", "Event Center Created successfully 😎", "success");
          showAllCenters();
        } else if (msg == "200") {
          $("#addCenterBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Event Center exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#addCenterBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem creating Event Center 😓",
            icon: "error",
          });
        } else if (msg == "500") {
          $("#addCenterBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please check that your image is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
            icon: "error",
          });
        } else if (msg == "600") {
          $("#addCenterBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please select an image 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#addCenterBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "800") {
          $("#addCenterBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "An error occured with image upload, Retry again! 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#addCenterBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Event Center name must be more than five characters! 😓",
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
      url: "http://localhost/community/admin/controllers/eventCenters/eventCenters.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        $('#edit-center-form [name="center_id"]').val(response.center_id);
        $('#edit-center-form [name="name"]').val(response.name);
        $('#edit-center-form [name="description"]').val(response.description);
        $('#edit-center-form [name="address"]').val(response.address);
        $('#edit-center-form [name="capacity"]').val(response.capacity);
        $('#edit-center-form [name="charge"]').val(response.charge);
      },
    });
  });

  //update ajax request
 $("#edit-center-form").on("submit", function (e) {
  e.preventDefault();
  // Disables a button
  $("#editCenterBtn").prop("disabled", true);

  var formData = new FormData(this);
  formData.append("action", "UpdateCenter");
  $.ajax({
    type: "POST",
    url: "http://localhost/community/admin/controllers/eventCenters/eventCenters.php",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    success: function (msg) {
      console.log(msg);
      if (msg == "300") {
        $("#edit-center-form")[0].reset();
        $(".preview_img").attr("src", "./img/default_profile.jpg");
        $("#editModal").modal("hide");
        // Enables a button
        $("#editCenterBtn").prop("disabled", false);
        swal.fire("Updated!", "Event Center Updated successfully 😎", "success");
        showAllCenters();
      } else if (msg == "200") {
        $("#editCenterBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Event Center exists in the database 😓",
          icon: "error",
        });
      } else if (msg == "400") {
        $("#editCenterBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "There was a problem creating Event Center 😓",
          icon: "error",
        });
      } else if (msg == "500") {
        $("#editCenterBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Please check that your image is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
          icon: "error",
        });
      } else if (msg == "600") {
        $("#editCenterBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Please select an image 😓",
          icon: "error",
        });
      } else if (msg == "700") {
        $("#editCenterBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "You must fill all fields except the image field 😓",
          icon: "error",
        });
      } else if (msg == "800") {
        $("#editCenterBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "An error occured with image upload, Retry again! 😓",
          icon: "error",
        });
      } else if (msg == "900") {
        $("#editCenterBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Event Center Name must be more than three characters! 😓",
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
            url: "http://localhost/community/admin/controllers/eventCenters/eventCenters.php",
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
                  'Event Center deleted successfully',
                  'success'
              );
                showAllCenters();
                
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
      url: "http://localhost/community/admin/controllers/eventCenters/eventCenters.php",
      type: "POST",
      data: {
        info_id: info_id,
      },
      success: function (response) {
        data = JSON.parse(response);
        swal.fire({
          title: "<strong>Event Center Info : </strong>",
          type: "info",
          html:
          
          "<img width='150px' height='150px' src='../admin/uploads/" +
            data.image + "'></img> <br />" +
            "<b>Name : </b>" +
            data.name +
            "<br><b>Description : </b>" +
            data.description + 
            "<br><b>Address : </b>" +
            data.address +
            "<br><b>Capacity : </b>" +
            data.capacity +
            "<br><b>Charge Per Event : </b>" +
            data.charge +
            "<br><b>Created On : </b>" +
            data.created_at +
            "<br><b>Added by : </b>" +
            data.username +
            "<br><b>Contact Email : </b>" +
            data.email +
            "<br><b>Contact Phone : </b>" +
            data.phone,
          showCancelButton: true,
        });
      },
    });
  });



});