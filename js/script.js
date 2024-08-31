//Global variables taken from input boxes for product info
const productLink = document.getElementById("link");
const productName = document.getElementById("name");
const productPrice = document.getElementById("price");
const productImage = document.getElementById("image");
const productDescription = document.getElementById("description");
const productList = document.getElementById("list-belonging");
const wishList = document.getElementById("product-list");

//Global variables for list creation
const newList = document.getElementById("list");
const listOfLists = document.getElementById("list-list");

function changeWishlist(){
    document.getElementById('Lists').submit();
}

//Data entered in website saved locally
function saveData(){
    localStorage.setItem("data1", wishList.innerHTML);
    localStorage.setItem("data2", listOfLists.innerHTML);
}

//Retrieves data saved locally
function showTask(){
    wishList.innerHTML = localStorage.getItem("data1");
    listOfLists.innerHTML = localStorage.getItem("data2");
    ensureAllOption();
}
showTask();

