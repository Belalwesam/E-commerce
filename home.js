const loginBtn = document.getElementById("loginBtn");
const closeBtn = document.getElementById("closeBtn");
const closeAccountBtn = document.getElementById("closeAccountBtn");
const loginPage = document.getElementById("login");
const createAccountPage = document.getElementById("createAccount");
const createBtn = document.getElementById("createBtn");
const nameCreate = document.getElementById("nameCreate");
const Address = document.getElementById("Address");
const createlogin = document.getElementById("createlogin");
const passwordCreate = document.getElementById("passwordCreate");
const repasswordCreate = document.getElementById("repasswordCreate");
const cardNumber = document.getElementById("cardNumber");
const createSubmit = document.getElementById("createSubmit");
const loginSubmit = document.getElementById("loginSubmit");

//fucntions
function validateName(name) {
  let letters = /^[A-Za-z \ '']+$/;
  if (name.value.match(letters)) {
    name.classList.remove("error");
    document.getElementById("namesmall").style.display = "none";
    return false;
  } else {
    name.classList.add("error");
    document.getElementById("namesmall").style.display = "block";
    return true;
  }
}
function validatelogin(login) {
  if (login.value == "" || login.value.length > 5) {
    login.classList.add("error");
    document.getElementById("loginsmall").style.display = "block";
    return true;
  } else {
    login.classList.remove("error");
    document.getElementById("loginsmall").style.display = "none";
    return false;
  }
}
function validatePassword(password) {
  if (password.value.length < 8) {
    password.classList.add("error");
    document.getElementById("passwordsmall").style.display = "block";
    return true;
  } else {
    password.classList.remove("error");
    document.getElementById("passwordsmall").style.display = "none";
    return false;
  }
}
function validatePasswordConfiramtion(repassword) {
  if (
    repassword.value != passwordCreate.value ||
    repassword.value.length == 0
  ) {
    repassword.classList.add("error");
    document.getElementById("resmall").style.display = "block";
    return true;
  } else {
    repassword.classList.remove("error");
    document.getElementById("resmall").style.display = "none";
    return false;
  }
}
function validateCardNumber(number) {
  if (number.value.length < 10) {
    number.classList.add("error");
    document.getElementById("cardshow").style.display = "block";
    return true;
  } else {
    number.classList.remove("error");
    document.getElementById("cardshow").style.display = "none";
    return false;
  }
}
function Validate(para1, para2, para3, para4, para5) {
  if (para1 || para2 || para3 || para4 || para5) {
    return true;
  } else {
    return false;
  }
}
//event listeners
createSubmit.addEventListener("click", (e) => {
  const result = Validate(
    validateName(nameCreate),
    validatelogin(createlogin),
    validatePassword(passwordCreate),
    validatePasswordConfiramtion(repasswordCreate),
    validateCardNumber(cardNumber)
  );
  if (result) {
    e.preventDefault();
  } else {
    return;
  }
});
loginSubmit.addEventListener("click", (e) => {
  const LoginName = document.getElementById("loginName");
  const loginPass = document.getElementById("loginPas");
  const result = Validate(
    validatelogin(LoginName),
    validatePassword(loginPass)
  );
  if (result) {
    e.preventDefault();
  } else {
    return;
  }
});
//to open the log in page
loginBtn.addEventListener("click", () => {
  loginPage.classList.add("show");
});
//to close the log in page
closeBtn.addEventListener("click", () => {
  loginPage.classList.remove("show");
});
//to open sign up page
createBtn.addEventListener("click", () => {
  createAccountPage.classList.add("show");
});
closeAccountBtn.addEventListener("click", () => {
  createAccountPage.classList.remove("show");
});
