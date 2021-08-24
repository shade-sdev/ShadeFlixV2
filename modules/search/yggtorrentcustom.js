$(document).ready(function () {

    var url_string = window.location.href;
    var url = new URL(url_string);

    var result = (url.toString().split('url/').pop());
    console.log(atob(result))
    $.ajax({
        type: "GET",
        url: '/modules/search/yggSearchHandler',
        data: {
            yggurl: atob(result)

        },
        success: function (response) {

            var result = JSON.parse(response);

            setVideo(result.magnet);
            $("#magnetPlaceholder").attr("href", result.magnet);
        }
    });

});


function setVideo(magnet, poster) {
    window.webtor = window.webtor || [];
    window.webtor.push({
        id: 'player',
        magnet: magnet,
        on: function (e) {
            if (e.name == window.webtor.TORRENT_FETCHED) {
                console.log('Torrent fetched!', e.data);
            }
            if (e.name == window.webtor.TORRENT_ERROR) {
                console.log('Torrent error!');
            }
        },
        width: '100%',
        poster: poster,
        subtitles: [{
            srclang: 'en',
            label: 'test',
            src: 'https://raw.githubusercontent.com/andreyvit/subtitle-tools/master/sample.srt',
            default: true,
        }],
        lang: 'en',
        i18n: {
            en: {
                common: {
                    "prepare to play": "Preparing Video Stream... Please Wait...",
                },
                stat: {
                    "seeding": "Seeding",
                    "waiting": "Client initialization",
                    "waiting for peers": "Waiting for peers",
                    "from": "from",
                },
            },
        },
    });
}