const productLink = document.getElementById("link");
const productName = document.getElementById("name");
const productPrice = document.getElementById("price");
const productImage = document.getElementById("image");
const productDescription = document.getElementById("description");
const productList = document.getElementById("list-belonging");
const wishList = document.getElementById("product-list");

const newList = document.getElementById("list");
const listOfLists = document.getElementById("list-list");

function addProduct(){
    if(productLink.value === '' || productName.value === '' || productPrice.value === '' || productImage.value === '' || productList.value === ''){
        alert("This field is required");
    }
    else{
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageSrc = e.target.result;

            let li = document.createElement("li");
            li.innerHTML = "";
            li.setAttribute("data-list", productList.value.toUpperCase());

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
            
            let listName = productList.value.toUpperCase();
            let options = listOfLists.options;
            let isDuplicate = false;
    
            for(let i = 0; i < options.length; i++){
                if(options[i].value == listName){
                    isDuplicate = true;
                    break;
                }
            }
    
            if(isDuplicate){
                alert("This list already exists");
            }
            else{
                let option = document.createElement("option");
                option.textContent = listName;
                option.value = listName;
                listOfLists.appendChild(option);
                saveData();
            }
        
            saveData();

            productLink.value = "";
            productName.value = "";
            productPrice.value = "";
            productImage.value = "";
            productDescription.value = "";
            productList.value = "";

        };
        reader.readAsDataURL(productImage.files[0]);   
    }
}

function removeAll(){
    wishList.innerHTML = "";
    saveData();
}

function addList(){
    if(newList.value === ''){
        alert("You must write something");
    }
    else{
        let listName = newList.value.toUpperCase();
        let options = listOfLists.options;
        let isDuplicate = false;

        for(let i = 0; i < options.length; i++){
            if(options[i].value == listName){
                isDuplicate = true;
                break;
            }
        }

        if(isDuplicate){
            alert("This list already exists");
        }
        else{
            let option = document.createElement("option");
            option.textContent = listName;
            option.value = listName;
            listOfLists.appendChild(option);
            saveData();
            newList.value = "";
        }
    }
}

function removeLists(){
    while (listOfLists.options.length > 0){
        listOfLists.remove(0);
    }
    saveData();
}

function saveData(){
    localStorage.setItem("data1", wishList.innerHTML);
    localStorage.setItem("data2", listOfLists.innerHTML);
}

function ensureAllOption(){
    const option = listOfLists.options;
    for (let i = 0; i < option.length; i++){
        if(option[i].text == "ALL"){
            return;
        }
    }

    let allOption = document.createElement("option");
    allOption.textContent = "ALL";
    listOfLists.appendChild(allOption);
}

function showTask(){
    wishList.innerHTML = localStorage.getItem("data1");
    listOfLists.innerHTML = localStorage.getItem("data2");
    ensureAllOption();
}
showTask();