const formSort = document.getElementById("sort");
const filterPrice = document.getElementById("filterPrice");
const filterView = document.getElementById("filterView");

filterPrice.onclick = function () {
    formSort.submit();
};

filterView.onclick = function () {
    formSort.submit();
};