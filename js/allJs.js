// for all
function openMessage(messageId, maskId) {
    changeVerify();// 替换验证码

    var openMessage = document.getElementById(messageId);
    var mask = document.getElementById(maskId);

    openMessage.style.display = "block";
    mask.style.display = "block";
}

function closeMessage(messageId, maskId) {
    var openedMessage = document.getElementById(messageId);
    var openedMask = document.getElementById(maskId);

    openedMessage.style.display = "none";
    openedMask.style.display = "none";
}

function changeVerify() {
    document.getElementById("code").innerText = (Math.round(Math.random() * 8999) + 1000).toString();
}

function checkSignIn() {
    var userName = document.getElementById("signInUserName").value;
    var password = document.getElementById("signInPassword").value;
    var verify = document.getElementById("verify").value;

    if (checkSignInUserName(userName) && checkSignInPassword(password) && checkVerify(verify)){
        signIn();
    }else {
        changeVerify();
    }
}

function checkSignInUserName(userName) {
    if (userName === "") {// 用户名为空
        window.alert("The user name cannot be empty!");
        return false;
    }else if (userName !== "HNoodles1") {// 用户不存在
        window.alert("The user doesn't exist!");
        return false;
    }else {
        return true;
    }
}

function checkSignInPassword(password) {
    if (password === "") {// 密码为空
        window.alert("The password cannot be empty!");
        return false;
    }else if (password !== "123456") {// 密码错误
        window.alert("The password is wrong!");
        return false;
    }else {
        return true;
    }
}

function checkVerify(verify) {
    var setVerify = document.getElementById("code").innerText;

    if (verify !== setVerify) {
        window.alert("Wrong verify code!");
        return false;
    }else {
        return true;
    }
}

function signIn() {
    var aSignIn = document.getElementById("aSignIn");
    var aAccount = document.getElementById("aAccount");
    var aSignUp = document.getElementById("aSignUp");
    var aLogOut = document.getElementById("aLogOut");
    var spLog = document.getElementById("spLog");

    displayNone(aSignIn, aSignUp, spLog);
    displayInline(aAccount, aLogOut);

    window.alert("Signed in successfully!");
    closeMessage('signInForm', 'mask');
}

function checkSignUp() {
    var userName = document.getElementById("signUpUserName").value;
    var password = document.getElementById("signUpPassword").value;
    var passwordConfirm = document.getElementById("signUpPasswordConfirm").value;
    var phone = document.getElementById("phone").value;
    
    if (checkSignUpUserName(userName) & checkSignUpPassword(password) &
        checkSignUpPasswordConfirm(passwordConfirm) & checkSignUpPhone(phone)) {
        window.alert("Signed up successfully!");
        closeMessage('signUpForm', 'mask');
    }else {
        var alertUserName = document.getElementById("alertUserName").innerText;
        var alertPassword = document.getElementById("alertPassword").innerText;
        var alertPasswordConfirm = document.getElementById("alertPasswordConfirm").innerText;
        var alertPhone = document.getElementById("alertPhone").innerText;

        window.alert("Sign up failed!\n" + alertUserName + "\n" + alertPassword + "\n" +
            alertPasswordConfirm + "\n" + alertPhone);
    }
}

function checkSignUpUserName(username) {
    if (username === "") {// 用户名为空
        document.getElementById("alertUserName").innerText =
            "The user name cannot be empty! Like 'HNoodles1' is ok.";
        return false;
    }else if (username.length < 6) {// 长度小于6位
        document.getElementById("alertUserName").innerText =
            "The user name cannot be shorter than 6 characters! Like 'HNoodles1' is ok.";
        return false;
    }else if (/^[a-zA-Z]+$/.test(username) || /^\d+$/.test(username)) {// 全部是数字或字母
        document.getElementById("alertUserName").innerText =
            "The user name cannot be only numbers or characters! Like 'HNoodles1' is ok.";
        return false;
    }else {
        document.getElementById("alertUserName").innerText = "";
        return true;
    }
}

function checkSignUpPassword(password) {
    var username = document.getElementById("signUpUserName").value;

    if (password === "") {// 密码为空
        document.getElementById("alertPassword").innerText =
            "The password cannot be empty! Like '123456' is ok.";
        return false;
    }else if (password.length < 6) {// 长度小于6位
        document.getElementById("alertPassword").innerText =
            "The password cannot be shorter than 6 characters! Like '123456' is ok.";
        return false;
    }else if (password === username) {// 密码与用户名相同
        document.getElementById("alertPassword").innerText =
            "The password cannot be the same as user name! Like '123456' is ok.";
        return false;
    }else {
        document.getElementById("alertPassword").innerText = "";
        return true;
    }
}

function checkSignUpPasswordConfirm(passwordConfirm) {
    var password = document.getElementById("signUpPassword").value;

    if (passwordConfirm === "") {// 确认密码为空
        document.getElementById("alertPasswordConfirm").innerText = "The confirm password cannot be empty!";
        return false;
    }else if (passwordConfirm !== password) {// 密码与确认密码不同
        document.getElementById("alertPasswordConfirm").innerText = "Two different password!";
        return false;
    }else {
        document.getElementById("alertPasswordConfirm").innerText = "";
        return true;
    }
}

function checkSignUpPhone(phone) {
    if (!/^\d+$/.test(phone)) {// 不是纯数字
        document.getElementById("alertPhone").innerText =
            "The phone should be all numbers! Like '12345678910' is ok.";
        return false;
    }else if (phone.length !== 11) {// 长度不为11位
        document.getElementById("alertPhone").innerText =
            "The phone should be 11 numbers! Like '12345678910' is ok.";
        return false;
    }else {
        document.getElementById("alertPhone").innerText = "";
        return true;
    }
}

function logOut() {
    var aSignIn = document.getElementById("aSignIn");
    var aAccount = document.getElementById("aAccount");
    var aSignUp = document.getElementById("aSignUp");
    var aLogOut = document.getElementById("aLogOut");
    var spLog = document.getElementById("spLog");

    displayNone(aAccount, aLogOut);
    displayInline(aSignIn, aSignUp, spLog);
}

function displayNone() {
    for (var i = 0; i < arguments.length; i++) {
        if (arguments[i] !== null) {
            arguments[i].style.display = "none";
        }
    }
}

function displayInline() {
    for (var i = 0; i < arguments.length; i++) {
        if (arguments[i] !== null) {
            arguments[i].style.display = "inline";
        }
    }
}


// for index
function fadeIn() {
    for (var i = 0; i < arguments.length; i++) {
        if (arguments[i] !== null) {
            arguments[i].className = "hottest bg fadeIn";
        }
    }
}

function fadeOut() {
    for (var i = 0; i < arguments.length; i++) {
        if (arguments[i] !== null) {
            arguments[i].className = "hottest bg";
        }
    }
}

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