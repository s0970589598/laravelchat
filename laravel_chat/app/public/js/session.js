let timer = null;
//const TIMEOUT_WARNING = 25 * 60 * 1000; // 25 分鐘
//const TIMEOUT_LOGOUT = 30 * 60 * 1000; // 30 分鐘
const TIMEOUT_WARNING = 600 * 60 * 1000; // 600 分鐘
const TIMEOUT_LOGOUT = 650 * 60 * 1000; // 650 分鐘



function startTimer() {
  timer = setTimeout(function() {
    startLogoutTimer();
    alert('您已經超過一段時間沒有操作了，請注意您的登入狀態！');
  }, TIMEOUT_WARNING);
}

function startLogoutTimer() {
let timeleft = (TIMEOUT_LOGOUT - TIMEOUT_WARNING) / 1000;
  timer = setTimeout(function() {
    document.getElementById('logout-form').submit();
  }, TIMEOUT_LOGOUT - TIMEOUT_WARNING);
}

function resetTimer() {
  clearTimeout(timer);
  startTimer();
}
