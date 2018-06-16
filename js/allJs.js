


// 初始化图片下标
var currentIndex = 1;

function turnImgs() {
    if (currentIndex === 1) {
        fadeOut(document.getElementById("gallery" + currentIndex),
            document.getElementById("sc" + currentIndex));
        currentIndex = 3;
        fadeIn(document.getElementById("gallery" + currentIndex),
            document.getElementById("sc" + currentIndex));
    } else {
        fadeOut(document.getElementById("gallery" + currentIndex),
            document.getElementById("sc" + currentIndex));
        currentIndex--;
        fadeIn(document.getElementById("gallery" + currentIndex),
            document.getElementById("sc" + currentIndex));
    }
}
// 设置轮播间隔
setInterval(turnImgs,5000);


// for search
function search(id) {
    var keyword = document.getElementById(id).innerText;

    document.getElementById("btSearch").click();
    document.getElementById("inputSearch").value = keyword;
}


// for cart
function deleteWork(id) {
    document.getElementById(id).remove();
    window.alert("Deleted successfully!");
    
    if (checkNoChosenWork()) {
        document.getElementById("noChosenWork").style.display = "block";
        document.getElementById("spPrice").innerText = "0.00";
    }
}

function checkNoChosenWork() {
    var chosenWorks = document.getElementById("chosenWorks").children;
    var isNoChosenWork = true;

    for (var i = 0; i < chosenWorks.length; i++) {
        if (chosenWorks.item(i).innerHTML !== "")
            isNoChosenWork = false;
    }

    return isNoChosenWork;
}


// for profile
function checkTopUp() {
    var amount = document.getElementById("inputTopUp").value;

    if (!/^\d+.\d+$/.test(amount)) {// 不是纯数字
        window.alert("Please enter a number!");
    }else {
        topUp(amount);
    }
}

function topUp(amount) {
    document.getElementById("tdBalanceContent").innerText =
        String(
            Number(
                Number(amount) + Number(document.getElementById("tdBalanceContent").innerText)
            ).toFixed(4)
        );

    closeMessage("topUpForm","mask");
}