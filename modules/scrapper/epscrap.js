$(document).ready(function () {


    $.ajax({
        type: "GET",
        url: '/modules/scrapper/scrapHandler',
        data: {
            search: $('#getTitle').html()

        },
        success: function (response) {

            var result = JSON.parse(response);
            var data = result.rows;


            $.ajax({
                type: "GET",
                url: '/modules/scrapper/scrapHandler',
                data: {
                    magnet: data[0].url

                },
                success: function (response) {

                    var result = JSON.parse(response);
                    var data2 = result.magnet;
                    $("#magnetPlaceholder").attr("href", data2);
                    setVideo(data2, "")





                }
            });




        }
    });
});

function setVideo(magnet, poster) {
    window.webtor = window.webtor || [];
    window.webtor.push({
        id: 'player',
        width: '100%',
        magnet: magnet,
        on: function (e) {
            if (e.name == window.webtor.TORRENT_FETCHED) {
                console.log('Torrent fetched!', e.data);
            }
            if (e.name == window.webtor.TORRENT_ERROR) {
                console.log('Torrent error!');
            }
        },
        poster: poster,
        subtitles: [
            {
                srclang: 'en',
                label: 'test',
                src: 'https://raw.githubusercontent.com/andreyvit/subtitle-tools/master/sample.srt',
                default: true,
            }
        ],
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