function checkPage(sql, pageSize, totalPage) {
    let page = document.getElementById("page").value;

    if ((page > 0) && (page <= totalPage)) {
        ajaxToPage(page, sql, pageSize, totalPage);
    }
}

function ajaxToPage(page,sql,pageSize,totalPage) {
    $.ajax({
        type: "post",
        url: "searchResult.php",
        data: {page:page ,sql:sql, pageSize:pageSize, totalPage:totalPage},// data post to searchResult.php
        dataType: "json",
        success: function(data) {
            let prePage = (page > 1) ? (page - 1) : 1;
            let nextPage = (totalPage - page > 0) ? (page + 1) : totalPage;
            let searchResult = $('#searchResult');

            // clear div search result
            searchResult.empty();

            // // console out put
            // console.log(data);

            let output = "";
            sql = "`" + sql + "`";

            // compose html with data
            // start of total row
            let count = 0;
            for (let i = 0; i < data.length; i++) {
                output += `<div class="row">
                        <div class="card-group text-center">`;

                for (let j = 0; j < 3; j++) {
                    if (data[count]) {
                        output += `<div class="card">
                                <img class="card-img-top" src="resources/img/` + data[count]['imageFileName'] + `" alt="` + data[count]['title'] + `">
                                <div class="card-body">
                                <h5 class="card-title">` + data[count]['title'] + `</h5>
                            <p class="card-text">` + data[count]['description'] + `</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Price: <span class="badge badge-primary">` + data[count]['price'] + `</span></li>
                            <li class="list-group-item">View: <span class="badge badge-primary">` + data[count]['view'] + `</span></li>
                            </ul>
                            <div class="card-footer">
                                <a href="details.php?artworkID=` + data[count]['artworkID'] + `" class="btn btn-outline-primary">More Details</a>
                            </div>
                            </div>`;

                        count++;
                    }
                }

                output += `</div>`;
                output += `</div>`;

            }// end of for total row

            // start of pagination
            output += `<nav class="mt-3" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">`;

            if (prePage === page) {
                output += `<li class="page-item disabled"><a id="aFirstPage" class="page-link" href="#">First</a></li>`;
                output += `<li class="page-item disabled"><a id="aPreviousPage" class="page-link" href="#">Previous</a></li>`;
            } else {
                output += `<li class="page-item"><a id="aFirstPage" class="page-link" href="javascript:void(0)" onclick="` + `ajaxToPage(1,`+ sql + `,` + pageSize + `,` + totalPage + `)` + `">First</a></li>`;
                output += `<li class="page-item"><a id="aPreviousPage" class="page-link" href="javascript:void(0)" onclick="` + `ajaxToPage(` + prePage + `,` + sql + `,` + pageSize + `,` + totalPage + `)`+ `">Previous</a></li>`;
            }

            if (nextPage === page) {
                output += `<li class="page-item disabled"><a id="aNextPage" class="page-link" href="#">Next</a></li>`;
                output += `<li class="page-item disabled"><a id="aLastPage" class="page-link" href="#">Last</a></li>`;
            } else {
                output += `<li class="page-item"><a id="aNextPage" class="page-link" href="javascript:void(0)"
                    onclick="` + `ajaxToPage(` + nextPage + `,` + sql + `,` + pageSize + `,` + totalPage + `)` + `">Next</a></li>`;
                output += `<li class="page-item"><a id="aLastPage" class="page-link" href="javascript:void(0)"
                    onclick="` + `ajaxToPage(` + totalPage + `,` + sql + `,` + pageSize + `,` + totalPage + `)` + `">Last</a></li>`;
            }

            output += `<li class="page-item">
                    <form class="form-inline">
                    <input id="page" class="form-control" type="number" min="1" max="`+ totalPage + `"
                name="page" placeholder="` + page + `">
                    &nbsp;` + `/` + `&nbsp;` + totalPage + ` Page(s)
                &nbsp;<a id="aGoToPage" class="page-link" href="javascript:void(0)"
                onclick="` + `checkPage(` + sql + `,` + pageSize + `,` + totalPage + `)` + `">Go</a>
                    </form>
                    </li>
                    </ul>
                    </nav>`;


            // out put in search.php
            searchResult.html(output);


        },
        error:function(data){
            console.log(data);
        }
    });
}