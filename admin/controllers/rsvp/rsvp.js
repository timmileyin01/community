$(document).ready(function () {
  $("body").on("click", ".submitPayBtn", function (e) {
    e.preventDefault();
    pay_id = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/rsvp/rsvp.php",
      data: {
        pay_id: pay_id,
      },
      cache: false,
      success: function (response) {
        console.log(response);
        data = JSON.parse(response);
        swal
          .fire({
            title: "<strong>Ticket Info : </strong>",
            type: "info",
            html:
              "<b>Event Title : </b>" +
              data.title +
              "<br><b>Date : </b>" +
              data.date +
              "<br><b>Time : </b>" +
              data.time +
              "<br><b>Event Center : </b>" +
              data.name +
              "<br><b>Address : </b>" +
              data.address +
              "<br><b>Ticket Price : </b>" +
              data.price +
              "<br><b>Ticket ID : </b>" +
              data.ticket_id,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Okay",
          })
          .then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'http://localhost/community/events.php';
            }
          });
      },
    });
  });



  $("#form-login-pay").on("submit", function (e) {
    e.preventDefault();
    
    
    $("#loginPayBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "payLogin");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/rsvp/rsvp.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        console.log(response);
        data = JSON.parse(response);
        swal
          .fire({
            title: "<strong>Ticket Info : </strong>",
            type: "info",
            html:
              "<b>Event Title : </b>" +
              data.title +
              "<br><b>Date : </b>" +
              data.date +
              "<br><b>Time : </b>" +
              data.time +
              "<br><b>Event Center : </b>" +
              data.name +
              "<br><b>Address : </b>" +
              data.address +
              "<br><b>Ticket Price : </b>" +
              data.price +
              "<br><b>Ticket ID : </b>" +
              data.ticket_id,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Okay",
          })
          .then((result) => {
            if (result.isConfirmed) {
              $("#form-login-pay")[0].reset();
          $("#loginPayModal").modal("hide");
          // Enables a button
          $("#loginPayBtn").prop("disabled", false);
                window.location.href = 'http://localhost/community/events.php';
            }
          });
      },
    });
  });





  //edit category ajax request

  $("body").on("click", ".goingBtn", function (e) {
    e.preventDefault();
    rsvp_id = $(this).attr("id");

    $.ajax({
      url: "http://localhost/community/admin/controllers/rsvp/rsvp.php",
      type: "POST",
      data: {
        rsvp_id: rsvp_id,
      },
      cache: false,
      success: function (response) {
        console.log(response);
        if (response == "paid") {
          $("#prices").modal("show");
        }else if (response == "login") {
          $("#loginPayModal").modal("show");

        } else{
            data = JSON.parse(response);
            swal
              .fire({
                title: "<strong>Ticket Info : </strong>",
                type: "info",
                html:
                  "<b>Event Title : </b>" +
                  data.title +
                  "<br><b>Date : </b>" +
                  data.date +
                  "<br><b>Time : </b>" +
                  data.time +
                  "<br><b>Event Center : </b>" +
                  data.name +
                  "<br><b>Address : </b>" +
                  data.address +
                  "<br><b>Ticket Price : </b>" +
                  'Free' +
                  "<br><b>Ticket ID : </b>" +
                  data.ticket_id,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Okay",
              })
              .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'http://localhost/community/events.php';
                }
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
            url: "http://localhost/community/admin/controllers/categories/categories.php",
            type: "POST",
            data: {
              del_id: del_id,
            },
            cache: false,
            success: function (response) {
              if (response == "100") {
                tr.css("background-color", "#ff6666");
                swal.fire(
                  "Deleted!",
                  "Category deleted successfully",
                  "success"
                );
                showAllCategories();
              } else {
                swal.fire(
                  "Error!",
                  "Something went wrong try again later! 😢😢",
                  "error"
                );
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
      url: "http://localhost/community/admin/controllers/categories/categories.php",
      type: "POST",
      data: {
        info_id: info_id,
      },
      success: function (response) {
        data = JSON.parse(response);
        swal.fire({
          title: "<strong>Category Info : </strong>",
          type: "info",
          html:
            "<b>Name : </b>" +
            data.name +
            "<br><b>Description : </b>" +
            data.description +
            "<br><b>Created On : </b>" +
            data.created_at,
          showCancelButton: true,
        });
      },
    });
  });
});
