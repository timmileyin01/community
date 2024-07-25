$(document).ready(function () {
  showAllUsers();

  function showAllUsers() {
    $.ajax({
      url: "http://localhost/community/admin/controllers/users/users.php",
      type: "POST",
      data: {
        action: "view",
      },
      success: function (response) {
        console.log(response);
        $("#showUser").html(response);
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

  //insert ajax request
  $("#form-member-data").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#memberBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "insert");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/users/users.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#form-member-data")[0].reset();
          $(".preview_img").attr("src", "./img/default_profile.jpg");
          $("#memberModal").modal("hide");
          // Enables a button
          $("#memberBtn").prop("disabled", false);
          swal.fire(
            "Added!",
            "Account Created successfully, You can now login",
            "success"
          );
        } else if (msg == "100") {
          $("#memberBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Make sure your Passwords are matching and they are more than five characters 😓",
            icon: "error",
          });
        } else if (msg == "200") {
          $("#memberBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "User exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#memberBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem creating account 😓",
            icon: "error",
          });
        } else if (msg == "500") {
          $("#memberBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please check that your image is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
            icon: "error",
          });
        } else if (msg == "600") {
          $("#memberBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please select an image 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#memberBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "800") {
          $("#memberBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "An error occured with image upload, Retry again! 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Username must be more than five characters! 😓",
            icon: "error",
          });
        }
      },
    });
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

  //User login ajax request
  $("#login-member").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#loginBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "loginUser");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/users/users.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "r1") {
          $("#login-member")[0].reset();
          $("#loginModal").modal("hide");
          // Enables a button
          $("#loginBtn").prop("disabled", false);
          Swal.fire({
            title: "Yeh!!!?",
            text: "Logged in successfully 😎",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Go to Dashboard",
          }).then(function () {
            window.location = "http://localhost/community/user";
          });
        } else if (msg == "r2") {
          $("#login-member")[0].reset();
          $("#loginModal").modal("hide");
          // Enables a button
          $("#loginBtn").prop("disabled", false);
          Swal.fire({
            title: "Yeh!!!?",
            text: "Logged in successfully 😎",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Go to Dashboard",
          }).then(function () {
            window.location = "http://localhost/community/vendor";
          });
        } else if (msg == "r3") {
          $("#login-member")[0].reset();
          $("#loginModal").modal("hide");
          // Enables a button
          $("#loginBtn").prop("disabled", false);
          Swal.fire({
            title: "Yeh!!!?",
            text: "Logged in successfully 😎",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Go to Dashboard",
          }).then(function () {
            window.location = "http://localhost/community/planner";
          });
        } else if (msg == "r4") {
          $("#login-member")[0].reset();
          $("#loginModal").modal("hide");
          // Enables a button
          $("#loginBtn").prop("disabled", false);
          Swal.fire({
            title: "Yeh!!!?",
            text: "Logged in successfully 😎",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Go to Dashboard",
          }).then(function () {
            window.location = "http://localhost/community/admin";
          });
        } else if (msg == "r5") {
          $("#login-member")[0].reset();
          $("#loginModal").modal("hide");
          // Enables a button
          $("#loginBtn").prop("disabled", false);
          Swal.fire({
            title: "Yeh!!!?",
            text: "Logged in successfully 😎",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Go to Dashboard",
          }).then(function () {
            window.location = "http://localhost/community/admin";
          });
        } else if (msg == "100") {
          $("#loginBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Invalid Credentials 😓",
            icon: "error",
          });
        } else if (msg == "200") {
          $("#loginBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        }
      },
    });
  });

  //add new user ajax request
  $("#add-user-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#addUserBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "addNewUser");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/users/users.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#add-user-form")[0].reset();
          $(".preview_img").attr("src", "./img/default_profile.jpg");
          $("#addUserModal").modal("hide");
          // Enables a button
          $("#addUserBtn").prop("disabled", false);
          swal.fire("Added!", "Account Created successfully 😎", "success");
          showAllUsers();
        } else if (msg == "100") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Make sure your Passwords are matching and they are more than five characters 😓",
            icon: "error",
          });
        } else if (msg == "200") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "User exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem creating account 😓",
            icon: "error",
          });
        } else if (msg == "500") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please check that your image is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
            icon: "error",
          });
        } else if (msg == "600") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Please select an image 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "800") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "An error occured with image upload, Retry again! 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#addUserBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Username must be more than five characters! 😓",
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
      url: "http://localhost/community/admin/controllers/users/users.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        $('#edit-user-form [name="user_id"]').val(response.user_id);
        $('#edit-user-form [name="email"]').val(response.email);
        $('#edit-user-form [name="firstname"]').val(response.firstname);
        $('#edit-user-form [name="lastname"]').val(response.lastname);
        $('#edit-user-form [name="username"]').val(response.username);
        $('#edit-user-form [name="user_role"]').val(response.user_role);
        $('#edit-user-form [name="phone"]').val(response.phone);
      },
    });
  });

  //update ajax request
 $("#edit-user-form").on("submit", function (e) {
  e.preventDefault();
  // Disables a button
  $("#EditUserBtn").prop("disabled", true);

  var formData = new FormData(this);
  formData.append("action", "UpdateUser");
  $.ajax({
    type: "POST",
    url: "http://localhost/community/admin/controllers/users/users.php",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    success: function (msg) {
      console.log(msg);
      if (msg == "300") {
        $("#edit-user-form")[0].reset();
        $(".preview_img").attr("src", "./img/default_profile.jpg");
        $("#editModal").modal("hide");
        // Enables a button
        $("#EditUserBtn").prop("disabled", false);
        swal.fire("Updated!", "Account Updated successfully 😎", "success");
        showAllUsers();
      } else if (msg == "100") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Make sure your Passwords are matching and they are more than five characters 😓",
          icon: "error",
        });
      } else if (msg == "200") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "User exists in the database 😓",
          icon: "error",
        });
      } else if (msg == "400") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "There was a problem creating account 😓",
          icon: "error",
        });
      } else if (msg == "500") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Please check that your image is of type (jpg,png,webp,jpeg) and the size is 1mb and below 😓",
          icon: "error",
        });
      } else if (msg == "600") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Please select an image 😓",
          icon: "error",
        });
      } else if (msg == "700") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "You must fill all fields except the image field and password field 😓",
          icon: "error",
        });
      } else if (msg == "800") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "An error occured with image upload, Retry again! 😓",
          icon: "error",
        });
      } else if (msg == "900") {
        $("#EditUserBtn").prop("disabled", false);
        swal.fire({
          title: "Oops!",
          text: "Username must be more than five characters! 😓",
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
            url: "http://localhost/community/admin/controllers/users/users.php",
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
                  'User deleted successfully',
                  'success'
              );
                showAllUsers();
                
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
      url: "http://localhost/community/admin/controllers/users/users.php",
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
          
          "<img class='rounded-circle' width='80px' height='80px' src='./uploads/" +
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
            "<br><b>Joined On : </b>" +
            data.created_at,
          showCancelButton: true,
        });
      },
    });
  });
});







//Section for vendor loogics


