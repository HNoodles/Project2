const work = document.getElementById("work");
const title = document.getElementById("title");
const artist = document.getElementById("artist");
const description = document.getElementById("description");
const genre = document.getElementById("genre");
const yearOfWork = document.getElementById("yearOfWork");
const width = document.getElementById("width");
const height = document.getElementById("height");
const price = document.getElementById("price");
const imageFileName = document.getElementById("imageFileName");
const image = document.getElementById("image");
const userID = document.getElementById("userID");

const alertTitle = document.getElementById("alertTitle");
const alertArtist = document.getElementById("alertArtist");
const alertDescription = document.getElementById("alertDescription");
const alertGenre = document.getElementById("alertGenre");
const alertYearOfWork = document.getElementById("alertYearOfWork");
const alertWidth = document.getElementById("alertWidth");
const alertHeight = document.getElementById("alertHeight");
const alertPrice = document.getElementById("alertPrice");
const alertImageFileName = document.getElementById("alertImageFileName");
const alertSubmit = document.getElementById("alertSubmit");

const btSubmit = document.getElementById("btSubmit");

let pic;

function checkTitle() {
    if (title.value === "") {// nothing input
        alertTitle.innerText = "Title cannot be empty!";
        return false;
    } else {
        alertTitle.innerText = "";
        return true;
    }
}

function checkArtist() {
    if (artist.value === "") {// nothing input
        alertArtist.innerText = "Artist cannot be empty!";
        return false;
    } else {
        alertArtist.innerText = "";
        return true;
    }
}

function checkDescription() {
    if (description.value === "") {// nothing input
        alertDescription.innerText = "Description cannot be empty!";
        return false;
    } else {
        alertDescription.innerText = "";
        return true;
    }
}

function checkGenre() {
    if (genre.value === "") {// nothing input
        alertGenre.innerText = "Genre cannot be empty!";
        return false;
    } else {
        alertGenre.innerText = "";
        return true;
    }
}

function checkYearOfWork() {
    if (yearOfWork.value === "") {// nothing input
        alertYearOfWork.innerText = "Year of work cannot be empty!";
        return false;
    } else if (!/^\d+$/.test(yearOfWork.value)) {// not integer
        alertYearOfWork.innerText = "Year of work should be an integer!";
        return false;
    } else {
        alertYearOfWork.innerText = "";
        return true;
    }
}

function checkWidth() {
    if (width.value === "") {
        alertWidth.innerText = "Width cannot be empty!";
        return false;
    } else if (width.value <= 0) {// input not positive number
        alertWidth.innerText = "Width should be a positive number!";
        return false;
    } else {
        alertWidth.innerText = "";
        return true;
    }
}

function checkHeight() {
    if (height.value === "") {
        alertHeight.innerText = "Height cannot be empty!";
        return false;
    } else if (height.value <= 0) {// input not positive number
        alertHeight.innerText = "Height should be a positive number!";
        return false;
    } else {
        alertHeight.innerText = "";
        return true;
    }
}

function checkPrice() {
    if (price.value === "") {
        alertPrice.innerText = "Price cannot be empty!";
        return false;
    } else if (price.value <= 0) {// input not a positive number
        alertPrice.innerText = "Price should be a positive number!";
        return false;
    } else if (!/^\d+$/.test(price.value)) {// input not a integer
        alertPrice.innerText = "Price should be an integer!";
        return false;
    } else {
        alertPrice.innerText = "";
        return true;
    }
}

function checkImageFileName() {
    if (document.getElementById("artworkID")) {// revise
        alertImageFileName.innerText = "";
        if (imageFileName.value === "") {// image not uploaded
            return true;
        } else {// new image uploaded
            pic = imageFileName.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(pic);
            reader.onload = function(){
                image.src = reader.result;
            };
            return true;
        }
    } else {// release
        if (imageFileName.value === "") {
            alertImageFileName.innerText = "Please upload an image!";
            return false;
        } else {
            alertImageFileName.innerText = "";

            pic = imageFileName.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(pic);
            reader.onload = function(){
                image.src = reader.result;
            };

            return true;
        }
    }

}

title.onblur = checkTitle;
artist.onblur = checkArtist;
description.onblur = checkDescription;
genre.onblur = checkGenre;
yearOfWork.onblur = checkYearOfWork;
width.onblur = checkWidth;
height.onblur = checkHeight;
price.onblur = checkPrice;
imageFileName.onchange = checkImageFileName;

btSubmit.onclick = function () {
    if (title.onblur() & artist.onblur() & description.onblur() & genre.onblur() & yearOfWork.onblur() &
        width.onblur() & height.onblur() & price.onblur() & imageFileName.onchange()) {// all clear
        alertSubmit.innerText = "";

        let workData = new FormData(work);

        let xhr = createXHR();
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4){
                if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304){
                    alertSubmit.innerHTML = xhr.responseText;
                } else {
                    alert("Request was unsuccessful: " + xhr.status);
                }
            }
        };
        xhr.open("post","releaseArtWork.php",true);
        xhr.send(workData);
    } else {
        alertSubmit.innerText = "Failed! Please refine the form and try again!";
    }
};