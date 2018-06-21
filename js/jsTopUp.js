const topUpSubmit = document.getElementById("topUpSubmit");
const alertTopUp = document.getElementById("alertTopUp");
const topUp = document.getElementById("topUp");
const topUpAmount = document.getElementById("topUpAmount");

topUpSubmit.onclick = function () {
    if ((topUpAmount.value <= 0) || (!/^\d+$/.test(topUpAmount.value))) {// less than 0 or not integer
        alertTopUp.innerText = "Please enter a valid amount.";
    } else {// success
        alertTopUp.innerText = "";
        topUp.submit();
    }
};