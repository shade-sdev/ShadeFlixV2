$(document).on('click', '#search', function (val) {

    $.ajax({
        type: "GET",
        url: '/modules/search/yggSearchHandler',
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
                a.innerHTML = d.title;
                a.color = "#fff";
                a.href = "#";
                a.setAttribute('data', d.domain + "/engine/download_torrent?id=" + d.url.split('/').pop().split('-')[0]);
                document.getElementById('searchResultsContainer').appendChild(a);

            }




        }
    });
});

$(document).on('click', '.searchTarget', function (val) {



    console.log($(this).attr('data'))
    console.log(btoa($(this).attr('data')));
    console.log(atob(btoa($(this).attr('data'))));
    window.open('/custom/yggtorrent/url/' + btoa($(this).attr('data')), '_blank');
});

function clearSearch() {
    var e = document.querySelector("#searchResultsContainer");
    var child = e.lastElementChild;
    while (child) {
        e.removeChild(child);
        child = e.lastElementChild;
    }
}