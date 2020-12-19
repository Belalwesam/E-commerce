//all the add to cart btns
const btns = document.querySelectorAll(".addToCartBtn");

//getting the hidden input
let hiddenInput = document.querySelector("#hidden");
//the cart counter
let cartCounter = 0;
const cartNumber = document.querySelector("#cart-counter");

//changing teh balance
const currentBalance = document.querySelector("#amount");

//event listeners
btns.forEach((btn) => {
  btn.addEventListener("click", () => {
    //increasing the cart
    cartCounter++;
    cartNumber.innerText = cartCounter;

    //getting the price of each item
    let price = btn.getAttribute("data-price");

    //adding the amount to the overall
    moneySpent(price);
    //giving the value to the hidden input
    hiddenInput.value = moneySpent(price);

    //changing the amount of money
    changeAmount(hiddenInput.value);
  });
});
//function to calcualte the spent amount of money
function moneySpent(price) {
  let amount = parseFloat(price) + parseFloat(hiddenInput.value);
  return amount;
}
function changeAmount(para1) {
  let newBalance = currentBalance.getAttribute('data-balance') - para1;
  if (newBalance < 0) {
    alert("You don't have enough credit to complete this purchase.");
    cartCounter--;
    cartNumber.innerText = cartCounter;
  } else {
    currentBalance.innerText = newBalance.toFixed(2);
  }
}
//to let the form submit or not
function figure() {
  if (parseFloat(hiddenInput.value) > currentBalance.getAttribute('data-balance')) return true;
  else return false;
}
//listeneing for a submit on the checkout btn
document.getElementById("checkout").addEventListener("click", (e) => {
  //if true it will not submit
  if (figure()) {
    e.preventDefault();
    alert("no enough credits.");
  }
});
