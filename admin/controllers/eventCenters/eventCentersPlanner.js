$(document).ready(function () {
    showAllCenters();
  
    function showAllCenters() {
      $.ajax({
        url: "http://localhost/community/admin/controllers/eventCenters/eventCentersPlanner.php",
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
  












  //show user details request
  $("body").on("click", ".infoBtn", function (e) {
    e.preventDefault();

    info_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/eventCenters/eventCentersPlanner.php",
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