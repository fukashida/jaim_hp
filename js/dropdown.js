// ハンバーガーメニュー
const ham = document.querySelector('#openbtn1');
const nav = document.querySelector('#g-nav');
const bg = document.querySelector('#nav-bg');

console.log(ham)

ham.addEventListener('click', function(){
  ham.classList.toggle('active');
  nav.classList.toggle('panelactive');
  bg.classList.toggle('bg_active');
});


// 入会フォームセレクトボタン
$(document).ready(function() {
  $('.select').select2();
});

// 入会フォーム表示・非表示
function myfunc() {
    var value = document.getElementsByClassName("myselectbox")[0].value; // ClassNameの場合は[0]を必ず記載
    var target = document.getElementsByClassName("target")[0]; // targetの表示順に分岐

  if (value === '賛助会員' | value === '特別賛助会員') {
    // ボタンクリックでhiddenクラスを付け外しする
    target.classList.remove('hidden');
  } else if ( value === '正会員A' | value === '正会員B' | value === '一般会員' | value === '学生会員') {
    target.classList.add('hidden');
  } 
  
  var target = document.getElementsByClassName("target")[1];
  if (value === '正会員A') {
    // ボタンクリックでhiddenクラスを付け外しする
    target.classList.remove('hidden');
  }  else if (value === '賛助会員' | value === '特別賛助会員' | value === '正会員B' | value === '一般会員' | value === '学生会員') {
    target.classList.add('hidden');
  }

  var target = document.getElementsByClassName("target")[2];
  if (value === '正会員B') {
    // ボタンクリックでhiddenクラスを付け外しする
    target.classList.remove('hidden');
  }  else if (value === '賛助会員' | value === '特別賛助会員' | value === '正会員A' | value === '一般会員' | value === '学生会員') {
    target.classList.add('hidden');
  }

  var target = document.getElementsByClassName("target")[3];
  if (value === '学生会員') {
    // ボタンクリックでhiddenクラスを付け外しする
    target.classList.remove('hidden');
  }  else if (value === '賛助会員' | value === '特別賛助会員' | value === '正会員A' | value === '一般会員' | value === '正会員B') {
    target.classList.add('hidden');
  }

  var target = document.getElementsByClassName("target")[4];
  if (value === '一般会員') {
    // ボタンクリックでhiddenクラスを付け外しする
    target.classList.remove('hidden');
  }  else if (value === '賛助会員' | value === '特別賛助会員' | value === '正会員A' | value === '学生会員' | value === '正会員B') {
    target.classList.add('hidden');
  }

}