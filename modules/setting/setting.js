$(document).on('click', '#settingBtn', function (val) {

    $.ajax({
        type: "GET",
        url: '/modules/setting/settingHandler',
        data: {
            setting: null,
            TMDB_API_KEY: $('#TMDB_API_KEY').val(),
            YGGTORRENT_USERNAME: $('#YGGTORRENT_USERNAME').val(),
            YGGTORRENT_PASSWORD: $('#YGGTORRENT_PASSWORD').val(),
            TORRENT9_DOMAIN: $('#TORRENT9_DOMAIN').val(),
            YGGTORRENT_DOMAIN: $('#YGGTORRENT_DOMAIN').val(),

        },
        success: function (response) {

            var result = JSON.parse(response);
            if (result.response == true) {
                window.location.replace("/settings");
            }





        }
    });
});