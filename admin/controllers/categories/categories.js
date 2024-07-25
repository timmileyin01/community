$(document).ready(function () {
  showAllCategories();

  function showAllCategories() {
    $.ajax({
      url: "http://localhost/community/admin/controllers/categories/categories.php",
      type: "POST",
      data: {
        action: "view",
      },
      success: function (response) {
        console.log(response);
        $("#showCategory").html(response);
        $("table").DataTable({
          order: [0, "desc"],
        });
      },
    });
  }

  $("#add-category-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#addCategoryBtn").prop("disabled", true);

    var formData = new FormData(this);
    formData.append("action", "addNewCategory");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/categories/categories.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#add-category-form")[0].reset();
          $("#addCategoryModal").modal("hide");
          // Enables a button
          $("#addCategoryBtn").prop("disabled", false);
          swal.fire("Added!", "Category Created successfully 😎", "success");
          showAllCategories();
        } else if (msg == "200") {
          $("#addCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Category exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#addCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem creating category 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#addCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#addCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Category must be more than three characters! 😓",
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
      url: "http://localhost/community/admin/controllers/categories/categories.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      cache: false,
      success: function (response) {
        response = JSON.parse(response);
        console.log(response);
        $('#edit-category-form [name="category_id"]').val(response.category_id);
        $('#edit-category-form [name="name"]').val(response.name);
        $('#edit-category-form [name="description"]').val(response.description);
      },
    });
  });



  //update ajax request
 $("#edit-category-form").on("submit", function (e) {
    e.preventDefault();
    // Disables a button
    $("#editCategoryBtn").prop("disabled", true);
  
    var formData = new FormData(this);
    formData.append("action", "UpdateCategory");
    $.ajax({
      type: "POST",
      url: "http://localhost/community/admin/controllers/categories/categories.php",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (msg) {
        console.log(msg);
        if (msg == "300") {
          $("#edit-category-form")[0].reset();
          $("#editCategoryModal").modal("hide");
          // Enables a button
          $("#editCategoryBtn").prop("disabled", false);
          swal.fire("Updated!", "Category Updated successfully 😎", "success");
          showAllCategories();
        } else if (msg == "200") {
          $("#editCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Category exists in the database 😓",
            icon: "error",
          });
        } else if (msg == "400") {
          $("#editCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "There was a problem Updating category 😓",
            icon: "error",
          });
        } else if (msg == "700") {
          $("#editCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "You must fill all fields 😓",
            icon: "error",
          });
        } else if (msg == "900") {
          $("#editCategoryBtn").prop("disabled", false);
          swal.fire({
            title: "Oops!",
            text: "Category name must be more than three characters! 😓",
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
            url: "http://localhost/community/admin/controllers/categories/categories.php",
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
                  'Category deleted successfully',
                  'success'
              );
                showAllCategories();
                
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
