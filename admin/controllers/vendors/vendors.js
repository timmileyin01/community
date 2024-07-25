$(document).ready(function () {
    showAllVendors();
  
    function showAllVendors() {
      $.ajax({
        url: "http://localhost/community/admin/controllers/vendors/vendors.php",
        type: "POST",
        data: {
          action: "view",
        },
        success: function (response) {
          console.log(response);
          $("#showVendor").html(response);
          $("table").DataTable({
            order: [0, "desc"],
          });
        },
      });
    }



    //show user details request
  $("body").on("click", ".infoBtn", function (e) {
    e.preventDefault();

    info_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/vendors/vendors.php",
      type: "POST",
      data: {
        info_id: info_id,
      },
      success: function (response) {
        data = JSON.parse(response);
        swal.fire({
          title: "<strong>User Info : </strong>",
          type: "info",
          html:
          
          "<img width='150px' height='150px' src='../admin/uploads/" +
            data.image + "'></img> <br />" +
            "<b>First Name : </b>" +
            data.firstname +
            "<br><b>Last Name : </b>" +
            data.lastname + 
            "<br><b>Username : </b>" +
            data.username +
            "<br><b>Email : </b>" +
            data.email +
            "<br><b>Phone Number : </b>" +
            data.phone +
            "<br><b>User Role : </b>" +
            data.user_role +
            "<br><b>Name of Service : </b>" +
            data.name +
            "<br><b>Description of Service : </b>" +
            data.description +
            "<br><b>Charge per Event: </b>" +
            data.charge +
            "<br><b>Joined On : </b>" +
            data.created_at,
          showCancelButton: true,
        });
      },
    });
  });




});