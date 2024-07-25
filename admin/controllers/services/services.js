$(document).ready(function () {
    showAllServices();
  
    function showAllServices() {
      $.ajax({
        url: "http://localhost/community/admin/controllers/services/services.php",
        type: "POST",
        data: {
          action: "view",
        },
        cache: false,
        success: function (response) {
          console.log(response);
          $("#showService").html(response);
          $("table").DataTable({
            order: [0, "desc"],
          });
        },
      });
    }


    $("#add-service-form").on("submit", function (e) {
        e.preventDefault();
        // Disables a button
        $("#addServiceBtn").prop("disabled", true);
    
        var formData = new FormData(this);
        formData.append("action", "addNewService");
        $.ajax({
          type: "POST",
          url: "http://localhost/community/admin/controllers/services/services.php",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function (msg) {
            console.log(msg);
            if (msg == "300") {
              $("#add-service-form")[0].reset();
              $("#addServiceModal").modal("hide");
              // Enables a button
              $("#addServiceBtn").prop("disabled", false);
              swal.fire("Added!", "Service Created successfully 😎", "success");
              showAllServices();
            } else if (msg == "200") {
              $("#addServiceBtn").prop("disabled", false);
              swal.fire({
                title: "Oops!",
                text: "Service exists in the database 😓",
                icon: "error",
              });
            } else if (msg == "400") {
              $("#addServiceBtn").prop("disabled", false);
              swal.fire({
                title: "Oops!",
                text: "There was a problem creating Service 😓",
                icon: "error",
              });
            } else if (msg == "700") {
              $("#addServiceBtn").prop("disabled", false);
              swal.fire({
                title: "Oops!",
                text: "You must fill all fields 😓",
                icon: "error",
              });
            } else if (msg == "900") {
              $("#addServiceBtn").prop("disabled", false);
              swal.fire({
                title: "Oops!",
                text: "Service must be more than three characters! 😓",
                icon: "error",
              });
            }
          },
        });
      });



      //edit category ajax request

$("body").on("click", ".editBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/services/services.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        console.log(response);
        $('#edit-service-form [name="service_id"]').val(response.service_id);
        $('#edit-service-form [name="name"]').val(response.name);
        $('#edit-service-form [name="description"]').val(response.description);
        $('#edit-service-form [name="charge"]').val(response.charge);
      },
    });
  });



    //update ajax request
 $("#edit-service-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#editServiceBtn").prop("disabled", true);
  
    var formData = new FormData(this);
    formData.append("action", "UpdateService");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/services/services.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#edit-service-form")[0].reset();
          $("#editModal").modal("hide");
          // Enables a button
          $("#editServiceBtn").prop("disabled", false);
          swal.fire("Updated!", "Service Updated successfully 😎", "success");
          showAllServices();
        } else if (msg == "200") {
          $("#editServiceBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Service exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#editServiceBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem Updating Service 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#editServiceBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#editServiceBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Service name must be more than three characters! 😓",
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
            url: "http://localhost/community/admin/controllers/services/services.php",
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
                  'Service deleted successfully',
                  'success'
              );
                showAllServices();
                
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
      url: "http://localhost/community/admin/controllers/services/services.php",
      type: "POST",
      data: {
        info_id: info_id,
      },
      success: function (response) {
        data = JSON.parse(response);
        swal.fire({
          title: "<strong>Service Info : </strong>",
          type: "info",
          html:
            "<b>Name : </b>" +
            data.name +
            "<br><b>Description : </b>" +
            data.description +
            "<br><b>Charge : </b>" +
            data.charge +
            "<br><b>Created On : </b>" +
            data.created_at,
          showCancelButton: true,
        });
      },
    });
  });

});