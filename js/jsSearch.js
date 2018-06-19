const search = document.getElementById("search");
const btSearch = document.getElementById("btSearch");
const searchText = document.getElementById("searchText");
const ckbTitle = document.getElementById("ckbTitle");
const ckbIntroduction = document.getElementById("ckbIntroduction");
const ckbArtist = document.getElementById("ckbArtist");
const searchAlert = document.getElementById("searchAlert");

btSearch.onclick = function () {
    if (searchText.value === "") {// searched nothing
        searchAlert.innerText = "Search something.";
        searchAlert.className = "visible alert";
    }else if (ckbTitle.checked || ckbIntroduction.checked || ckbArtist.checked) {
        searchAlert.className = "invisible";
        search.submit();
    } else {// none of the checkboxes checked
        searchAlert.innerText = "Please choose one.";
        searchAlert.className = "visible alert";
    }
};
