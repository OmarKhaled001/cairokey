<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Follow Us – Cairo Key</title>
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
  max-width:420px;
  width:90%;
  box-shadow:var(--card-shadow);
}

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
  font-size:20px;
  font-weight:700;
  margin-bottom:8px;
}

p.subtitle{
  color:var(--text-light);
  font-size:13px;
  line-height:1.7;
  margin-bottom:28px;
}

/* ===== SOCIAL LINKS ===== */
.social-list{
  display:flex;
  flex-direction:column;
  gap:12px;
}

.social-link{
  display:flex;
  align-items:center;
  gap:14px;
  padding:13px 18px;
  border-radius:10px;
  border:1.5px solid var(--border-color);
  text-decoration:none;
  color:var(--primary);
  font-size:14px;
  font-weight:600;
  background:var(--bg-light);
  transition:border-color .2s, background .2s, transform .15s, box-shadow .2s;
  direction:ltr;
  text-align:left;
}
.social-link:hover{
  border-color:var(--primary);
  background:var(--bg-secondary);
  box-shadow:var(--card-shadow);
  transform:translateY(-2px);
}

.social-link .icon{
  width:36px;
  height:36px;
  border-radius:8px;
  display:flex;
  align-items:center;
  justify-content:center;
  flex-shrink:0;
}

.social-link .label{
  flex:1;
}
.social-link .label span{
  display:block;
  font-size:11px;
  font-weight:400;
  color:var(--text-light);
  margin-top:1px;
}

.social-link .arrow{
  color:var(--text-light);
  font-size:16px;
  transition:transform .2s;
}
.social-link:hover .arrow{
  transform:translateX(3px);
  color:var(--primary);
}

/* Icon backgrounds */
.icon-fb   { background:#1877f2; }
.icon-ig   { background:radial-gradient(circle at 30% 110%,#f9ed32 0%,#ee2a7b 50%,#002aff 100%); }
.icon-tt   { background:#000; }
.icon-web  { background:var(--primary); }

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
  font-size:13px;
  color:var(--text-light);
}

/* English font override */
body.en,
body.en h1,
body.en p,
body.en footer,
body.en .social-link,
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

  <!-- Logo -->
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

  <h1 id="title">تابعنا</h1>
  <p class="subtitle" id="desc">تواصل معنا عبر منصاتنا الرسمية</p>

  <div class="social-list">

    <!-- Facebook -->
    <a class="social-link" href="https://www.facebook.com/share/18SCdYG7TJ/" target="_blank" rel="noopener">
      <div class="icon icon-fb">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
          <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
        </svg>
      </div>
      <div class="label">
        Facebook
        <span>Cairo Key</span>
      </div>
      <span class="arrow">→</span>
    </a>

    <!-- Instagram -->
    <a class="social-link" href="https://www.instagram.com/cairokey2026?igsh=NGxmcjdyaGJqbW80" target="_blank" rel="noopener">
      <div class="icon icon-ig">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
          <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
          <circle cx="12" cy="12" r="4"/>
          <circle cx="17.5" cy="6.5" r="1" fill="white" stroke="none"/>
        </svg>
      </div>
      <div class="label">
        Instagram
        <span>@cairokey2026</span>
      </div>
      <span class="arrow">→</span>
    </a>

    <!-- TikTok -->
    <a class="social-link" href="https://www.tiktok.com/@cairokey2026?_r=1&_t=ZS-94iaFkAus9X" target="_blank" rel="noopener">
      <div class="icon icon-tt">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
          <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.32 6.32 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.75a4.85 4.85 0 0 1-1.01-.06z"/>
        </svg>
      </div>
      <div class="label">
        TikTok
        <span>@cairokey2026</span>
      </div>
      <span class="arrow">→</span>
    </a>

    <!-- Website -->
    <a class="social-link" href="https://cairokey.net" target="_blank" rel="noopener">
      <div class="icon icon-web">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="10"/>
          <line x1="2" y1="12" x2="22" y2="12"/>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
      </div>
      <div class="label">
        Website
        <span>cairokey.net</span>
      </div>
      <span class="arrow">→</span>
    </a>

  </div>
</div>

<footer id="footer">© 2026 Cairo Key</footer>

<!-- ===== LANG SWITCH ===== -->
<script>
var lang = "ar";

var t = {
  ar: {
    btn:"EN", dir:"rtl", lang:"ar", bodyClass:"",
    title:"تابعنا",
    desc:"تواصل معنا عبر منصاتنا الرسمية",
    footer:"© 2026 Cairo Key",
    arrow:"→"
  },
  en: {
    btn:"AR", dir:"ltr", lang:"en", bodyClass:"en",
    title:"Follow Us",
    desc:"Stay connected with us on our official platforms",
    footer:"© 2026 Cairo Key",
    arrow:"→"
  }
};

function toggleLang(){
  lang = lang === "ar" ? "en" : "ar";
  var d = t[lang];
  var html = document.documentElement;
  html.setAttribute("lang", d.lang);
  html.setAttribute("dir", d.dir);
  document.body.className = d.bodyClass;
  document.getElementById("langBtn").textContent  = d.btn;
  document.getElementById("title").textContent    = d.title;
  document.getElementById("desc").textContent     = d.desc;
  document.getElementById("footer").textContent   = d.footer;
}
</script>
</body>
</html>
