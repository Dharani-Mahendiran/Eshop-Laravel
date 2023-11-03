// Show whether status is visible or hidden during creating the category
function toggleStatus() {
    var checkbox = document.getElementsByName('status')[0];
    var span = document.getElementById('statusSpan');

    if (checkbox.checked) {
        span.textContent = 'Hide';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    } else {
        span.textContent = 'Visible';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    }
}

// Show whether popular column is popular or unpopular during creating  the category
function togglePopular() {
    var checkbox = document.getElementsByName('popular')[0];
    var span = document.getElementById('popularSpan');

    if (checkbox.checked) {
        span.textContent = 'Popular';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Unpopular';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    }
}



// Product page:create view
function toggleTrending() {
    var checkbox = document.getElementsByName('trending')[0];
    var span = document.getElementById('trendingSpan');

    if (checkbox.checked) {
        span.textContent = 'Trending';
        span.classList.remove('text-info');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Common';
        span.classList.remove('text-success');
        span.classList.add('text-info');
    }
}


// Show whether status is visible or hidden during editing the category
function toggleEditStatus(checkbox) {
    var span = document.getElementById('statusSpan');

    if (checkbox.checked) {
        span.textContent = 'Hidden';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    } else {
        span.textContent = 'Visible';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    }
}

// Show whether popular column is popular or unpopular during editing the category
function toggleEditPopular(checkbox) {
    var span = document.getElementById('popularSpan');

    if (checkbox.checked) {
        span.textContent = 'Popular';
        span.classList.remove('text-danger');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Unpopular';
        span.classList.remove('text-success');
        span.classList.add('text-danger');
    }
}

// Product page:edit view
function toggleEditTrending(checkbox) {
    var span = document.getElementById('trendingSpan');

    if (checkbox.checked) {
        span.textContent = 'Trending';
        span.classList.remove('text-info');
        span.classList.add('text-success');
    } else {
        span.textContent = 'Common';
        span.classList.remove('text-success');
        span.classList.add('text-info');
    }
}
// order status change
function change_status() {
    var status = document.getElementById('order_status').value;
    var dispatch = document.querySelector('.dispatch');
    var intransit = document.querySelector('.intransit');
    var delivery = document.querySelector('.delivery');

    dispatch.style.display = 'none';
    intransit.style.display = 'none';
    delivery.style.display = 'none';

    if (status === '1') {
        dispatch.style.display = 'block';
    } else if (status === '2') {
        intransit.style.display = 'block';
    } else if (status === '3') {
        delivery.style.display = 'block';
    }
}

//  datepicker script 
$(function() {
    $(".datepicker").datepicker({
        dateFormat: "DD, d MM, yy"
    });
});


// create user form validation
function save_user() {
  // Remove all existing error messages
  $(".text-danger").text("");

  // Track whether there are validation errors
  let hasError = false;

$(".save_user").each(function () {
  const name = $("input[name='name']").val();
  if (name === "") {
      $("#name-error").text("First Name is required");
      hasError = true;
  } else if (!/^[a-zA-Z]+$/.test(name)) {
      $("#name-error").text("Only letters allowed");
      hasError = true;
  }

const lname = $("input[name='lname']").val();
if (lname === "") {
  $("#lname-error").text("Last Name is required");
    hasError = true;
}else if (!/^[a-zA-Z]+$/.test(lname)) {
  $("#lname-error").text("Only letters alowed");
  hasError = true;
}

function isValidEmail(email) {
  const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
  return emailRegex.test(email);
}

const email = $("input[name='email']").val();
if (email === "") {
  $("#email-error").text("Email is required");
    hasError = true;
}else if (!isValidEmail(email)) {
  $("#email-error").text("Enter a valid email address");
  hasError = true;
}


function isValidPhoneNumber(phoneNumber) {
    const phoneRegex = /^(\d{10})$/;

  return phoneRegex.test(phoneNumber);
}
const contact = $("input[name='phone']").val();
if (contact === "") {
  $("#contact-error").text("contact is required");
    hasError = true;
}else if (!isValidPhoneNumber(contact)) {
  $("#contact-error").text("Enter valid phone number");
    hasError = true;
}

const role = $("select[name='role_as']").val();
if (!role) {
  $("#role-error").text("Select Role");
  hasError = true;
}


const password = $("input[name='password']").val();
if (password === "") {
  $("#password-error").text("Enter Password");
    hasError = true;
} else if (!(password.length >= 8)) {
  $("#password-error").text("The password must be at least 8 characters");
    hasError = true;
}


// If there are any errors, prevent form submission
if (hasError) {
  return;
}

// If there are no errors, submit the form
$(".CreateUserForm").submit();
});
}

// Update User
function update_user() {
    // Remove all existing error messages
    $(".text-danger").text("");
  
    // Track whether there are validation errors
    let hasError = false;
  
  $(".update_user").each(function () {
    const name = $("input[name='name']").val();
    if (name === "") {
        $("#name-error").text("First Name is required");
        hasError = true;
    } else if (!/^[a-zA-Z]+$/.test(name)) {
        $("#name-error").text("Only letters allowed");
        hasError = true;
    }
  
  const lname = $("input[name='lname']").val();
  if (lname === "") {
    $("#lname-error").text("Last Name is required");
      hasError = true;
  }else if (!/^[a-zA-Z]+$/.test(lname)) {
    $("#lname-error").text("Only letters alowed");
    hasError = true;
  }
  
  function isValidEmail(email) {
    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    return emailRegex.test(email);
  }
  
  const email = $("input[name='email']").val();
  if (email === "") {
    $("#email-error").text("Email is required");
      hasError = true;
  }else if (!isValidEmail(email)) {
    $("#email-error").text("Enter a valid email address");
    hasError = true;
  }
  
  
  function isValidPhoneNumber(phoneNumber) {
      const phoneRegex = /^(\d{10})$/;
  
    return phoneRegex.test(phoneNumber);
  }
  const contact = $("input[name='phone']").val();
  if (contact === "") {
    $("#contact-error").text("contact is required");
      hasError = true;
  }else if (!isValidPhoneNumber(contact)) {
    $("#contact-error").text("Enter valid phone number");
      hasError = true;
  }
  
  const password = $("input[name='password']").val();
  if (password === "") {
    $("#password-error").text("Enter Password");
      hasError = true;
  } else if (!(password.length >= 8)) {
    $("#password-error").text("The password must be at least 8 characters");
      hasError = true;
  }
  
  
  // If there are any errors, prevent form submission
  if (hasError) {
    return;
  }
  
  // If there are no errors, submit the form
  $(".UpdateUserForm").submit();
  });
  }
  
// Toggle Password
  function togglePassword() {
    var x = document.getElementById("password_field");
    var y = document.getElementById("toggle_password_button");
    if (x.type === "password") {
        x.type = "text";
        y.innerHTML = '<i class="mdi mdi-eye" aria-hidden="true"></i>';
    } else {
        x.type = "password";
        y.innerHTML = '<i class="mdi mdi-eye-off" aria-hidden="true"></i>';
    }
}  

// go back functionality
function goBack() {
  window.history.back();
}