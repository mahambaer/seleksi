
var jawabans = []
var jumlahSoal = $('#jumlah_soal').val()
var score = []
var timer
var myTimer
function startTimer(duration, display) {
    timer = duration;
    var hours, minutes, seconds;
    myTimer = setInterval(function () {
        hours = parseInt(timer / (60 * 60), 10)
        minutes = parseInt(timer % (60 * 60) / 60, 10);
        seconds = parseInt(timer % 60, 10);

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = hours + ":" + minutes + ":" + seconds;

        if (--timer < 0) {
            timer = 0
            var kirim = document.querySelector('#kirim')
            kirim.disabled = false
            clearInterval(myTimer)
        }
    }, 1000);
}

window.onload = function () {
    var durasi = document.querySelector('#durasi').getAttribute('value')
    var fiveMinutes = 60 * durasi,
        display = document.querySelector('#timer');
    startTimer(fiveMinutes, display);

    document.getElementById("app").style.display = "block";
};

$(function () {
    $('#exampleModalCenter').modal('show')
})

$(document).ready(function () {
    history.pushState(null, null, location.href); history.back(); history.forward(); window.onpopstate = function () { history.go(1); }; 
    $('.collapse').on('shown.bs.collapse', function () {
        var button = $(this)
        var id = button.data('soal')
        var element = $(id).position().top
        $(document).scrollTop(element + 5)
    })
    $('input[data-soal]').on('change', function () {
        var button = $(this)
        var jawaban = button.data('jawaban')
        var soal = button.data('soal')
        var element = $('#pilihan' + soal)
        var id = button.val()
        jawabans[soal - 1] = id
        var filteredArray = jawabans.filter(function (element) {
            return element != null && element != ''
        })
        if (filteredArray.length == jumlahSoal) {
            $('#kirim').prop('disabled', false)
        }
        switch (jawaban) {
            case 1:
                element.text('A')
                break
            case 2:
                element.text('B')
                break
            case 3:
                element.text('C')
                break
            case 4:
                element.text('D')
                break
        }
        getScore(id, soal - 1)
    })

    $('#kirim').on('click', function () {
        $('#exampleModalCenter').modal('show')
        var id = $('#id').val()
        // var filteredArray = score.filter(function (element) {
        //     return element != null && element != ''
        // })
        var total = 0
        var filteredArray = score.filter(function (element) {
            return element != null && element != ''
        })
        $.each(filteredArray, function(){
            total += this
        })
        var result = (total/jumlahSoal)*100
        clearInterval(myTimer)
        sendScore(id, result)
    })

    $("#timer").on('DOMSubtreeModified', function () {
        if ($(this).text() != '')
            $('#exampleModalCenter').modal('hide')
        if ($(this).text() == '00:00:00')
            var string = `
            <div class="panel panel-default">
            <div class="panel-body" style="padding-bottom: 0">
                <div class="alert alert-danger text-center">
                    <p>
                        <b>WAKTU ANDA HABIS!</b>
                    </p>
                    <p>
                        <b>TEKAN TOMBOL KIRIM UNTUK MENYELESAIKAN SELEKSI ONLINE!</b>
                    </p>
                </div>
            </div>
            </div>`
            $('#soals').html(string)
    });

    function getScore(id, index) {
        $.ajax({
            type: 'POST',
            url: '/getscore/' + id,
            data: {
                _token: $('#_token').val(),
            },
            success: function (data) {
                score[index] = data.score
                console.log(score)
            }
        })
    }

    function sendScore(id, score) {
        $.ajax({
            type: 'POST',
            url: '/sendscore/' + id,
            data: {
                _token: $('#_token').val(),
                score: score,
                timer: timer
            },
            success: function (data) {
                if (data.result) {
                    //var token = $('#token').val()
                    var email = $('#email').val()
                    window.location.href = '/seleksi/' + email
                    // $('#exampleModalCenter').modal('hide')
                }
            }
        })
    }
})