const btBuy = document.getElementById("btBuy");
const buy = document.getElementById("buy");
const balance = document.getElementById("balance");
const totalPrice = document.getElementById("totalPrice");
const alertBuy = document.getElementById("alertBuy");
const userID = document.getElementById("userID");

let xhrBuy = createXHR();

function addURLParam(url, name, value){
    url += ( url.indexOf("?") === -1 ? "?" : "&" );
    url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
    return url;
}

btBuy.onclick = function () {
    if (balance.value < totalPrice.value) {// not enough balance
        alertBuy.innerText = "Not enough balance. Please top up first."
    } else {// ajax get
        alertBuy.innerText = "";

        xhrBuy.onreadystatechange = function(){
            if (xhrBuy.readyState === 4){
                if ((xhrBuy.status >= 200 && xhrBuy.status < 300) || xhrBuy.status === 304){
                    alertBuy.innerText = xhrBuy.response;
                }
                else {
                    alert("Request was unsuccessful: " + xhrBuy.status);
                }
            }
        };

        let url = "createOrder.php";

        url = addURLParam(url,"userID",userID.value);
        url = addURLParam(url,"totalPrice",totalPrice.value);
        url = addURLParam(url,"balance",balance.value);

        xhrBuy.open("get", url, true);
        xhrBuy.send(null);
    }
};
