const productLink = document.getElementById("link");
const productName = document.getElementById("name");
const productPrice = document.getElementById("price");
const productImage = document.getElementById("image");
const productDescription = document.getElementById("description");
const wishList = document.getElementById("product-list");

function addProduct(){
    if(productLink.value === '' || productName.value === '' || productPrice.value === '' || productImage.value === ''){
        alert("This field is required");
    }
    else{
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageSrc = e.target.result;

            let li = document.createElement("li");
            li.innerHTML = "";

            let a = document.createElement("a");
            a.href = productLink.value;
            li.appendChild(a);

            let p1 = document.createElement("p");
            p1.innerHTML = productName.value;
            li.appendChild(p1);

            let p2 = document.createElement("p");
            p2.innerHTML = productPrice.value;
            li.appendChild(p2);

            let img = document.createElement("img");
            img.src = imageSrc;
            a.appendChild(img);

            let p3 = document.createElement("p");
            p3.innerHTML = productDescription;
            li.appendChild(p3);

            let button = document.createElement("button");
            button.innerHTML = "Remove product";
            button.onclick =  function removeProduct(){
                li.remove();
                saveData();
            };
            li.appendChild(button);

            wishList.appendChild(li);

            saveData();

            productLink.value = "";
            productName.value = "";
            productPrice.value = "";
            productImage.value = "";
            productDescription.value = "";

        };
        reader.readAsDataURL(productImage.files[0]);   
    }
}

function removeAll(){
    wishList.innerHTML = "";
    saveData();
}

function saveData(){
    localStorage.setItem("data", wishList.innerHTML);
}

function showTask(){
    wishList.innerHTML = localStorage.getItem("data");
}
showTask();