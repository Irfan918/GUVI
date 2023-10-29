$(document).ready(function () {
  if (localStorage.getItem("email")) {
    window.location.replace("./../profile.html");
  }
});
$("#submit").on("click", function () {
  $.ajax({
    type: "POST",
    url: "php/login.php",
    data: $("#form").serialize(),
    success: function (response) {
      console.log(response);
      alert("Your Successfully logged");
    },
    error: function () {
      alert("error");
    },
  }).done(function () {
    localStorage.setItem("name", response.name);
    var name = localStorage.getItem("name");
    var email = localStorage.getItem("email");
    var dob = localStorage.getItem("dob");
    var contact = localStorage.getItem("contact");
    console.log(name, email, dob, contact);
    var url = "http://localhost:81/GUVI_TASK_20CSR020/profile.html";
    $(location).attr("href", url);
  });
});
