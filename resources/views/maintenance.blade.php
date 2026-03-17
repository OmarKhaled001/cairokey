<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maintenance</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --primary:#173b53;
  --primary-hover:#192830;
  --text-light:#8a8a8a;
  --bg-light:#ffffff;
  --bg-secondary:#f6f4ef;
  --border-color:#d4d4d4;
  --card-shadow:0 4px 6px -1px rgb(25 40 48/.1),0 2px 4px -2px rgb(25 40 48/.1);
}
*{box-sizing:border-box;margin:0;padding:0;}

body{
  background:var(--bg-secondary);
  min-height:100vh;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  font-family:'Cairo',system-ui;
}

.container{
  background:var(--bg-light);
  padding:48px 44px 40px;
  border-radius:14px;
  text-align:center;
  max-width:500px;
  width:90%;
  box-shadow:var(--card-shadow);
}

/* Logo wrapper: always LTR so internal SVG text never flips */
.logo-wrap{
  direction:ltr;
  unicode-bidi:isolate;
  display:block;
  margin:0 auto 26px;
  width:160px;
  height:auto;
}
.logo-wrap svg{
  width:100%;
  height:auto;
}

h1{
  color:var(--primary);
  font-size:22px;
  font-weight:700;
  margin-bottom:8px;
}

p{
  color:var(--text-light);
  font-size:14px;
  line-height:1.7;
  margin-bottom:30px;
}

/* ===== PROGRESS SCENE ===== */
.progress-scene{
  position:relative;
  height:64px;
  margin-bottom:6px;
}

.road{
  position:absolute;
  bottom:10px;
  left:4px;
  right:52px;
  height:2px;
  background:var(--border-color);
  border-radius:2px;
}
.road-fill{
  height:100%;
  width:0%;
  background:var(--primary);
  border-radius:2px;
  animation:road-anim 3s ease-in-out infinite alternate;
}
@keyframes road-anim{
  0%  {width:15%}
  100%{width:85%}
}
.road::after{
  content:'';
  position:absolute;
  top:3px;left:0;right:0;
  height:1px;
  background:repeating-linear-gradient(90deg,var(--border-color) 0,var(--border-color) 5px,transparent 5px,transparent 11px);
}

.key-icon{
  position:absolute;
  bottom:13px;
  transform:translateX(-50%);
  animation:key-move 3s ease-in-out infinite alternate;
  z-index:3;
}
@keyframes key-move{
  0%  {left:15%}
  100%{left:calc(100% - 56px)}
}

.pyramids-icon{
  position:absolute;
  bottom:10px;
  right:0;
}

.progress-label{
  font-size:12px;
  color:var(--text-light);
  text-align:center;
}

/* ===== LANG SWITCH ===== */
.lang-switch{
  position:fixed;
  top:20px;
  right:20px;
}
[dir="ltr"] .lang-switch{right:auto;left:20px;}

.lang-switch button{
  border:none;
  background:var(--primary);
  color:#fff;
  padding:6px 14px;
  border-radius:6px;
  cursor:pointer;
  font-size:14px;
  font-family:inherit;
}
.lang-switch button:hover{background:var(--primary-hover);}

/* ===== FOOTER ===== */
footer{
  margin-top:24px;
  font-size:14px;
  color:var(--text-light);
  display:flex;
  align-items:center;
  gap:8px;
}
footer span{
  color:var(--text-light);
}
footer a{
  color:var(--text-light);
  text-decoration:none;
  font-weight:400;
  direction:ltr;
  display:inline-block;
}

/* English font override */
body.en,
body.en h1,
body.en p,
body.en footer,
body.en .progress-label,
body.en .lang-switch button{
  font-family:'Nunito',system-ui;
}
</style>
</head>
<body>

<div class="lang-switch">
  <button id="langBtn" onclick="toggleLang()">EN</button>
</div>

<div class="container">

  <!-- Logo locked in LTR so "cairo key" text never reverses -->
  <div class="logo-wrap">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="630 460 680 220">
      <style>.a{fill:#173b53}.b{fill:#1a3263;font-family:Georgia,serif;font-size:44px;font-weight:700}</style>
      <path class="a" d="M804.04,598.57c-4.02,0-7.47,1.45-10.35,4.33-2.88,2.88-4.33,6.33-4.33,10.35s1.45,7.44,4.33,10.28c2.88,2.83,6.33,4.25,10.35,4.25s7.44-1.41,10.28-4.25c2.83-2.83,4.25-6.26,4.25-10.28s-1.41-7.47-4.25-10.35c-2.83-2.88-6.26-4.33-10.28-4.33Z"/>
      <path class="a" d="M664.98,586.21v-41.4h-12.35v53.76h124.37v29.21h-61.39l-7.69-14.74-7.55,9.17,2.89,5.57h-2.15l-11.88-22.69-7.79,9.65,6.82,13.04h-2.14l-14.67-26.26c-5.69,8.75-11.38,17.5-17.07,26.26h-30.95v-112.17h70.6v41.41h136.89v-53.77h-12.37v41.56h-112.16v-70.61h70.61v29.05h-41.41v12.36h53.76v-41.41h70.77v112.01h-195.14Z"/>
      <path class="a" d="M845.44,598.57c-4.02,0-7.44,1.45-10.28,4.33-2.83,2.88-4.25,6.33-4.25,10.35s1.41,7.44,4.25,10.28c2.83,2.83,6.26,4.25,10.28,4.25s7.47-1.41,10.35-4.25,4.33-6.26,4.33-10.28-1.45-7.47-4.33-10.35c-2.88-2.88-6.33-4.33-10.35-4.33Z"/>
      <path class="a" d="M887.93,515.61v70.6h41.56v12.36h-41.56v29.05h70.75v-112.01h-70.75ZM935.08,573.26h-23.87l5.92-28.26v-.06c-5.78-3.29-7.75-10.78-4.33-16.56,4.68-7.89,16.23-7.82,20.77.17,3.23,5.67,1.4,12.83-4.08,16.18v1.83l5.59,26.7Z"/>
      <path class="a" d="M1012.45,515.61v82.96h-41.41v29.05h70.61v-112.01h-29.2Z"/>
      <path class="a" d="M1078.8,644.38c-2.83-2.83-6.26-4.25-10.28-4.25s-7.44,1.41-10.26,4.25c-2.83,2.83-4.26,6.26-4.26,10.28s1.42,7.43,4.26,10.26c2.82,2.83,6.25,4.26,10.26,4.26s7.44-1.42,10.28-4.26c2.83-2.83,4.25-6.25,4.25-10.26s-1.41-7.44-4.25-10.28ZM1078.8,602.9c-2.83-2.88-6.26-4.33-10.28-4.33s-7.44,1.45-10.26,4.33c-2.83,2.88-4.26,6.33-4.26,10.35s1.42,7.44,4.26,10.28c2.82,2.83,6.25,4.25,10.26,4.25s7.44-1.41,10.28-4.25c2.83-2.83,4.25-6.26,4.25-10.28s-1.41-7.47-4.25-10.35ZM1054.01,515.61v41.41h-40.01v29.19h69.05v-70.6h-29.04Z"/>
      <path class="a" d="M1219.62,474.2v41.41h-53.76v-12.36h41.41v-29.05h-70.61v70.61h112.17v-41.56h12.36v53.77h-164.39v29.19h193.59v-112.01h-70.77Z"/>
      <text class="b" transform="translate(1099.61 658)">cairo key</text>
    </svg>
  </div>

  <h1 id="title">الموقع تحت الصيانة</h1>
  <p id="desc">نعمل حالياً على تحسين الموقع وسنعود قريباً.</p>

  <!-- Key → Pyramids progress -->
  <div class="progress-scene">
    <div class="road"><div class="road-fill"></div></div>

    <svg class="key-icon" width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <circle cx="7" cy="7" r="6" fill="#173b53"/>
      <circle cx="7" cy="7" r="3" fill="#f6f4ef"/>
      <rect x="12" y="6" width="8" height="2.5" rx="1.2" fill="#173b53"/>
      <rect x="17" y="8.5" width="2" height="3" rx="1" fill="#173b53"/>
      <rect x="14" y="8.5" width="2" height="2" rx="1" fill="#173b53"/>
    </svg>

    <svg class="pyramids-icon" width="54" height="44" viewBox="0 0 54 44" xmlns="http://www.w3.org/2000/svg">
      <rect x="0" y="39" width="54" height="2" rx="1" fill="#173b53"/>
      <polygon points="38,26 46,39 30,39" fill="#192830"/>
      <polygon points="14,20 26,39 2,39" fill="#192830"/>
      <polygon points="27,4 46,39 8,39" fill="#173b53"/>
      <line x1="27" y1="4" x2="27" y2="39" stroke="#f6f4ef" stroke-width="0.6" opacity="0.3"/>
    </svg>
  </div>

  <p class="progress-label" id="progLabel">المفتاح في طريقه إلى الأهرامات...</p>

</div>

<footer>
  <span id="contactText">للتواصل:</span>
  <a href="tel:01123991452" id="phone">01123991452</a>
</footer>

<script>
let lang = "ar";
function toggleLang() {
  const html = document.documentElement;
  const body = document.body;
  if (lang === "ar") {
    html.lang = "en"; html.dir = "ltr";
    body.classList.add("en");
    document.getElementById("title").innerText    = "Website Under Maintenance";
    document.getElementById("desc").innerText     = "We're improving the experience and will be back soon.";
    document.getElementById("contactText").innerText = "Contact:";
    document.getElementById("progLabel").innerText   = "The key is heading to the Pyramids...";
    document.getElementById("langBtn").innerText  = "AR";
    lang = "en";
  } else {
    html.lang = "ar"; html.dir = "rtl";
    body.classList.remove("en");
    document.getElementById("title").innerText    = "الموقع تحت الصيانة";
    document.getElementById("desc").innerText     = "نعمل حالياً على تحسين الموقع وسنعود قريباً.";
    document.getElementById("contactText").innerText = "للتواصل:";
    document.getElementById("progLabel").innerText   = "المفتاح في طريقه إلى الأهرامات...";
    document.getElementById("langBtn").innerText  = "EN";
    lang = "ar";
  }
}
</script>
</body>
</html>
