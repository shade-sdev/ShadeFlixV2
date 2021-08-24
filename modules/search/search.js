$(document).on('click', '#search', function (val) {

    $.ajax({
        type: "GET",
        url: '/modules/search/searchHandler',
        data: {
            searchQuery: $('#searchQuery').val()

        },
        success: function (response) {
            clearSearch();
            var result = JSON.parse(response);
            var data = result.rows;

            for (d of data) {

                const a = document.createElement('a');
                a.classList = "price__btn searchTarget";
                a.innerHTML = '<strong>' + d.title + '</strong';
                a.color = "#fff";
                a.href = "#";
                a.setAttribute('data', d.url);
                document.getElementById('searchResultsContainer').appendChild(a);

            }




        }
    });
});

$(document).on('click', '.searchTarget', function (val) {

    console.log($(this).attr('data'))
    console.log(btoa($(this).attr('data')));
    console.log(atob(btoa($(this).attr('data'))));
    window.open('/custom/torrent9/url/' + btoa($(this).attr('data')), '_blank');
});

function clearSearch() {
    var e = document.querySelector("#searchResultsContainer");
    var child = e.lastElementChild;
    while (child) {
        e.removeChild(child);
        child = e.lastElementChild;
    }
}