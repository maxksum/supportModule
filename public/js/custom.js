function ready() {
  $.get("/lobby/ready")
    .done(function(data) {
      if (data.error) {
        alert(data.message);
      } else {
        lobbyGame();
      }
    });
}

function leave() {
  if (!confirm("Вы действительно хотите покинуть лобби?")) {
    return;
  }
  $.post("/lobby/kick", {
      kick: user.id
    })
    .done(function(data) {
      alert(data.message);
      if (!data.error) {
        closeGame();
      }
    });
}

function closeChat() {
  $(".show_chat p").html("0");
}

function updater(h, m, s) {
  var baseTime = new Date(2015, 8, 27);
  var period = 60 * 60 * 1000;

  function update() {
    var cur = new Date();
    var diff = period - (cur - baseTime) % period;
    var millis = diff % 1000;
    diff = Math.floor(diff / 1000);
    var sec = diff % 60;
    if (sec < 10) sec = "0" + sec;
    diff = Math.floor(diff / 60);
    var min = diff % 60;
    if (min < 10) min = "0" + min;
    diff = Math.floor(diff / 60);
    var hours = diff % 24;
    if (hours < 10) hours = "0" + hours;
    var days = Math.floor(diff / 24);
    $(".count.hour").html(hours);
    $(".count.min").html(min);
    $(".count.sec").html(sec);
    setTimeout(update, millis);
  }
  setTimeout(update, 0);
}
