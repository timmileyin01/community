$(document).ready(function () {
   

  //add new user ajax request
  $("#verify-ticket-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#verifyTicketBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "verifyTicket");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/tickets/tickets.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#verify-ticket-form")[0].reset();
          // Enables a button
          $("#verifyTicketBtn").prop("disabled", false);
          swal.fire("Verified!", "Ticket is valid for the event! 😎", "success");
        } else if (msg == "200") {
          $("#verifyTicketBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Sorry! Ticket is not valid 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#verifyTicketBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        }
      },
    });
  });



  
  //edit user ajax request
  

});