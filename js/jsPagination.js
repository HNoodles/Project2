let xhrPage = createXHR();

function addURLParam(url, name, value){
    url += ( url.indexOf("?") === -1 ? "?" : "&" );
    url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
    return url;
}

function toPage(page,sql,pageSize,totalPage) {
    xhrPage.onreadystatechange = function(){
        if (xhrPage.readyState === 4){
            if ((xhrPage.status >= 200 && xhrPage.status < 300) || xhrPage.status === 304){
                document.getElementById("searchResult").innerHTML = xhrPage.responseText;
            }
            else {
                alert("Request was unsuccessful: " + xhrPage.status);
            }
        }
    };

    let url = "searchResult.php";

    url = addURLParam(url,"sql",sql);
    url = addURLParam(url,"page",page);
    url = addURLParam(url,"pageSize",pageSize);
    url = addURLParam(url,"totalPage",totalPage);

    xhrPage.open("get", url, true);
    xhrPage.send(null);
}

function checkPage(sql, pageSize, totalPage) {
    let page = document.getElementById("page").value;

    if ((page > 0) && (page <= totalPage)) {
        toPage(page, sql, pageSize, totalPage);
    }
}

