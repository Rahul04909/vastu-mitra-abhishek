<?php
require_once __DIR__ . '/../database/db_config.php';
?>
<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>श्री रुद्राभिषेक 2026 — श्रावण मास | घर बैठे लाइव संकल्प करें</title>
<meta name="description" content="अपने नाम, गोत्र और परिवार के कल्याण हेतु श्री रुद्राभिषेक — पूरी वीडियो रिकॉर्डिंग और प्रसाद किट के साथ।">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Devanagari:wght@500;700;800;900&family=Noto+Sans+Devanagari:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root{
  --bg-0:#150a05;
  --bg-1:#1f0f08;
  --bg-2:#28130a;
  --gold:#d4af37;
  --gold-light:#f2dc9b;
  --gold-dim:#8a6c22;
  --saffron:#ff7a29;
  --saffron-deep:#e0551a;
  --maroon:#5a1810;
  --text-hi:#f7ecd8;
  --text-mid:#d8c4a4;
  --text-dim:#a98d68;
  --line:rgba(212,175,55,0.22);
  --radius:16px;
  --radius-sm:10px;
}
*{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{
  background:var(--bg-0);
  color:var(--text-hi);
  font-family:'Noto Sans Devanagari','Noto Sans',sans-serif;
  -webkit-font-smoothing:antialiased;
  overflow-x:hidden;
}
h1,h2,h3{font-family:'Noto Serif Devanagari','Noto Serif',serif;font-weight:800;margin:0;}
p{margin:0;}
img,svg,video{display:block;max-width:100%;}
.wrap{max-width:1100px;margin:0 auto;padding:0 24px;}
a{color:inherit;text-decoration:none;}
::selection{background:var(--saffron);color:#1a0a02;}
.btn{
  display:inline-flex;align-items:center;gap:8px;
  padding:16px 34px;border-radius:12px;
  font-size:17px;font-weight:700;
  cursor:pointer;border:none;
  transition:transform .18s ease, box-shadow .18s ease;
  font-family:inherit;
  justify-content:center;
}
.btn:active{transform:scale(0.97);}
.btn-primary{
  background:linear-gradient(135deg,var(--saffron),var(--saffron-deep));
  color:#fff5e8;
  box-shadow:0 10px 30px -8px rgba(255,122,41,0.55);
}
.btn-primary:hover{box-shadow:0 14px 34px -6px rgba(255,122,41,0.7);transform:translateY(-2px);}
.btn-gold{
  background:linear-gradient(135deg,#FFE580,#FFD700 45%,#E8B800);
  color:#2b1704;
  box-shadow:0 10px 26px -8px rgba(255,215,0,0.55);
}
.btn-gold:hover{transform:translateY(-3px);box-shadow:0 14px 30px -6px rgba(255,215,0,0.7);}
.section{padding:80px 0;}
.section-head{text-align:center;margin-bottom:48px;}
.section-head .tag{
  display:inline-block;color:var(--gold);font-size:13px;
  letter-spacing:0.16em;margin-bottom:10px;
  border:1px solid var(--line);padding:5px 16px;border-radius:999px;
  background:rgba(212,175,55,0.06);
}
.section-head h2{font-size:clamp(24px,4vw,34px);color:var(--text-hi);}
.section-head p{color:var(--text-mid);font-size:15px;margin-top:10px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;}
.section-cta{text-align:center;margin-top:40px;}
.section-cta .btn{padding:18px 40px;font-size:18px;}

/* ===== S1: HERO ===== */
.hero{
  position:relative;padding:0;overflow:hidden;
  min-height:100vh;display:flex;align-items:center;
  background:var(--bg-0);
}
.hero-video{
  position:absolute;inset:0;width:100%;height:100%;
  object-fit:cover;z-index:0;
}
.hero-overlay{
  position:absolute;inset:0;z-index:1;
  background:linear-gradient(180deg,rgba(21,10,5,0.7) 0%,rgba(21,10,5,0.5) 50%,rgba(21,10,5,0.85) 100%);
}
.hero-glow{
  position:absolute;top:-120px;left:50%;transform:translateX(-50%);
  width:640px;height:640px;z-index:1;
  background:radial-gradient(circle,rgba(212,175,55,0.28) 0%,rgba(212,175,55,0.06) 45%,transparent 70%);
  filter:blur(6px);animation:auraPulse 6s ease-in-out infinite;
}
@keyframes auraPulse{0%,100%{opacity:0.75;transform:translateX(-50%) scale(1);}50%{opacity:1;transform:translateX(-50%) scale(1.08);}}
.hero .wrap{position:relative;z-index:2;width:100%;text-align:center;padding:120px 24px 80px;}
.hero-badge{
  display:inline-block;letter-spacing:0.18em;font-size:13px;
  color:var(--gold);border:1px solid var(--line);
  padding:6px 16px;border-radius:999px;margin-bottom:22px;
  background:rgba(212,175,55,0.06);
}
.hero h1{
  font-size:clamp(32px,5.6vw,56px);line-height:1.28;
  color:var(--text-hi);text-shadow:0 2px 24px rgba(255,122,41,0.25);
}
.hero h1 span{color:var(--saffron);}
.hero .sub{
  max-width:640px;margin:22px auto 0;
  font-size:clamp(15px,2.4vw,19px);color:var(--text-mid);line-height:1.75;
}
.hero-stats{
  display:flex;justify-content:center;gap:40px;margin-top:30px;flex-wrap:wrap;
}
.hero-stat{text-align:center;}
.hero-stat-num{font-size:28px;font-weight:800;color:var(--gold-light);font-family:'Noto Serif Devanagari',serif;}
.hero-stat-label{font-size:12.5px;color:var(--text-dim);margin-top:4px;}
.hero .cta-row{margin-top:36px;display:flex;gap:16px;justify-content:center;flex-wrap:wrap;}
.hero .btn{padding:18px 44px;font-size:19px;}
.hero-note{margin-top:18px;font-size:13px;color:var(--text-dim);letter-spacing:0.02em;}
.hero-note span{margin:0 10px;}
@media(max-width:768px){
  .hero{min-height:auto;}
  .hero .wrap{padding:100px 16px 60px;}
  .hero-stats{gap:20px;}
}

/* ===== S2: WHY DIFFERENT ===== */
.why-different{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
.usp-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
.usp-card{
  background:var(--bg-2);border:1px solid var(--line);border-radius:var(--radius);
  padding:32px 20px 28px;text-align:center;transition:transform .2s ease;
}
.usp-card:hover{transform:translateY(-6px);border-color:var(--gold-dim);}
.usp-icon{width:64px;height:64px;margin:0 auto 16px;border-radius:50%;
  background:rgba(212,175,55,0.10);border:1px solid var(--line);
  display:flex;align-items:center;justify-content:center;font-size:28px;
}
.usp-card h3{font-size:17px;color:var(--gold-light);margin-bottom:8px;}
.usp-card p{font-size:13.5px;color:var(--text-mid);line-height:1.65;}
@media(max-width:900px){.usp-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:500px){.usp-grid{grid-template-columns:1fr;}}

/* ===== S3: WHO IS THIS FOR ===== */
.who-for{background:var(--bg-0);border-bottom:1px solid var(--line);}
.cat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
.cat-card{
  background:var(--bg-2);border:1px solid var(--line);border-radius:var(--radius-sm);
  padding:24px 16px;text-align:center;transition:all .2s ease;cursor:default;
}
.cat-card:hover{background:rgba(212,175,55,0.06);border-color:var(--gold-dim);transform:translateY(-3px);}
.cat-icon{font-size:32px;margin-bottom:10px;}
.cat-card h4{font-size:15px;color:var(--text-hi);font-weight:700;}
@media(max-width:900px){.cat-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:500px){.cat-grid{grid-template-columns:repeat(2,1fr);gap:10px;}}

/* ===== S4: LIVE SANKALP EXPERIENCE ===== */
.sankalp-experience{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
.sankalp-layout{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;}
.sankalp-media{}
.sankalp-video-wrapper{
  border-radius:var(--radius);overflow:hidden;border:1px solid var(--line);
  position:relative;
}
.sankalp-video-wrapper video{width:100%;height:auto;display:block;}
.sankalp-video-caption{font-size:12px;color:var(--text-dim);text-align:center;margin-top:8px;font-style:italic;}
.sankalp-thumbs{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:12px;}
.sankalp-thumb{border-radius:8px;overflow:hidden;border:1px solid var(--line);aspect-ratio:1;}
.sankalp-thumb img{width:100%;height:100%;object-fit:cover;}
.sankalp-content{}
.sankalp-content .tag{color:var(--gold);font-size:13px;letter-spacing:0.16em;display:block;margin-bottom:10px;}
.sankalp-content h2{font-size:clamp(22px,3.4vw,30px);color:var(--text-hi);margin-bottom:16px;}
.sankalp-content h2 em{color:var(--saffron);font-style:normal;}
.sankalp-content .sankalp-desc{font-size:15px;color:var(--text-mid);line-height:1.85;margin-bottom:20px;}
.sankalp-highlight{
  background:rgba(212,175,55,0.06);border:1px solid var(--line);border-radius:var(--radius-sm);
  padding:18px 22px;margin-bottom:20px;
}
.sankalp-highlight p{font-size:14.5px;color:var(--gold-light);line-height:1.7;font-weight:600;}
.sankalp-highlight p em{color:var(--saffron);font-style:normal;}
.sankalp-process{list-style:none;display:flex;flex-direction:column;gap:12px;}
.sankalp-process li{display:flex;gap:12px;align-items:flex-start;font-size:14.5px;color:var(--text-mid);line-height:1.6;}
.sankalp-process li .sp-icon{flex-shrink:0;width:28px;height:28px;border-radius:50%;background:rgba(212,175,55,0.12);
  display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--gold);}
@media(max-width:900px){.sankalp-layout{grid-template-columns:1fr;gap:32px;}}

/* ===== S5: PROCESS TIMELINE ===== */
.process-timeline{background:var(--bg-0);border-bottom:1px solid var(--line);}
.timeline-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;position:relative;}
.timeline-step{
  background:var(--bg-2);border:1px solid var(--line);border-radius:var(--radius);
  padding:28px 18px 24px;text-align:center;position:relative;
}
.timeline-step .step-count{
  position:absolute;top:-14px;left:50%;transform:translateX(-50%);
  background:linear-gradient(135deg,var(--gold),#a9832b);color:#241205;
  font-size:11px;font-weight:800;padding:3px 12px;border-radius:999px;
  font-family:'Noto Serif Devanagari',serif;
}
.timeline-step .step-icon{font-size:32px;margin:6px 0 12px;}
.timeline-step h4{font-size:15px;color:var(--gold-light);margin-bottom:6px;font-weight:700;}
.timeline-step p{font-size:13px;color:var(--text-mid);line-height:1.6;}
@media(min-width:901px){
  .timeline-grid{position:relative;}
  .timeline-grid::before{
    content:"";position:absolute;top:70px;left:8%;right:8%;
    height:1px;
    background:repeating-linear-gradient(90deg,var(--gold-dim) 0 8px,transparent 8px 16px);
    opacity:0.4;
  }
}
@media(max-width:900px){.timeline-grid{grid-template-columns:repeat(2,1fr);gap:16px;}}
@media(max-width:500px){.timeline-grid{grid-template-columns:1fr;}}

/* ===== S6: MEET THE ACHARYA ===== */
.acharya{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
.acharya-layout{display:grid;grid-template-columns:0.8fr 1.2fr;gap:44px;align-items:center;}
.acharya-photo-box{text-align:center;}
.acharya-photo{
  width:220px;height:220px;border-radius:50%;margin:0 auto 16px;
  padding:4px;background:conic-gradient(from 0deg,var(--gold),var(--saffron),var(--gold-light),var(--gold));
  box-shadow:0 0 32px rgba(242,220,155,0.3);
}
.acharya-photo img{width:100%;height:100%;border-radius:50%;object-fit:cover;border:3px solid var(--bg-0);}
.acharya-photo-box .acharya-name{font-size:16px;font-weight:700;color:var(--gold-light);}
.acharya-photo-box .acharya-title{font-size:12.5px;color:var(--text-dim);}
.acharya-info{}
.acharya-info h2{font-size:clamp(22px,3vw,28px);color:var(--text-hi);margin-bottom:12px;}
.acharya-info .acharya-desc{font-size:15px;color:var(--text-mid);line-height:1.85;margin-bottom:18px;}
.acharya-creds{display:flex;flex-direction:column;gap:10px;}
.acharya-creds li{display:flex;gap:10px;align-items:center;font-size:14px;color:var(--text-mid);list-style:none;}
.acharya-creds li .ac-icon{color:var(--gold);font-size:16px;}
@media(max-width:768px){.acharya-layout{grid-template-columns:1fr;gap:24px;text-align:center;}
  .acharya-creds li{justify-content:center;}
}

/* ===== S7: WHY TRUST ===== */
.trust-section{background:var(--bg-0);border-bottom:1px solid var(--line);}
.trust-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
.trust-item{
  background:var(--bg-2);border:1px solid var(--line);border-radius:var(--radius-sm);
  padding:22px 16px;text-align:center;transition:transform .2s ease;
}
.trust-item:hover{transform:translateY(-3px);}
.trust-item .t-icon{color:var(--gold);font-size:20px;margin-bottom:8px;}
.trust-item h4{font-size:14px;color:var(--text-hi);font-weight:700;}
@media(max-width:900px){.trust-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:500px){.trust-grid{grid-template-columns:1fr;}}

/* ===== S8: BEHIND THE RITUAL (REEL VIDEOS) ===== */
.gallery-section{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
.reel-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
.reel-card{
  border-radius:var(--radius);overflow:hidden;border:1px solid var(--line);
  position:relative;background:var(--bg-2);cursor:pointer;
  aspect-ratio:9/16;max-height:480px;
}
.reel-card video{
  width:100%;height:100%;object-fit:cover;display:block;
}
.reel-card .reel-poster{
  position:absolute;inset:0;z-index:1;
  background:var(--bg-2);transition:opacity .4s ease;
}
.reel-card .reel-poster img{width:100%;height:100%;object-fit:cover;display:block;}
.reel-card .reel-poster.playing{opacity:0;pointer-events:none;}
.reel-card .reel-play-btn{
  position:absolute;inset:0;z-index:2;
  display:flex;align-items:center;justify-content:center;
  transition:opacity .3s ease;
}
.reel-card .reel-play-btn .play-icon{
  width:56px;height:56px;border-radius:50%;
  background:rgba(255,255,255,0.2);backdrop-filter:blur(4px);
  display:flex;align-items:center;justify-content:center;
  border:2px solid rgba(255,255,255,0.5);
  font-size:22px;color:#fff;transition:all .25s ease;
}
.reel-card:hover .reel-play-btn .play-icon{
  background:rgba(255,255,255,0.35);transform:scale(1.1);
}
.reel-card .reel-play-btn.hidden{opacity:0;pointer-events:none;}
.reel-card .reel-label{
  position:absolute;bottom:0;left:0;right:0;z-index:3;
  background:linear-gradient(transparent,rgba(0,0,0,0.85));
  padding:40px 14px 12px;text-align:center;
}
.reel-card .reel-label span{font-size:13px;color:var(--gold-light);font-weight:700;display:block;}
.reel-card .reel-label small{font-size:10.5px;color:var(--text-dim);display:block;margin-top:2px;}
.reel-card .reel-mute-btn{
  position:absolute;top:10px;right:10px;z-index:3;
  width:32px;height:32px;border-radius:50%;
  background:rgba(0,0,0,0.5);border:none;
  display:none;align-items:center;justify-content:center;
  cursor:pointer;color:#fff;font-size:14px;
}
.reel-card .reel-mute-btn.show{display:flex;}
@media(max-width:900px){.reel-grid{grid-template-columns:repeat(2,1fr);gap:12px;}}
@media(max-width:500px){.reel-grid{grid-template-columns:repeat(2,1fr);gap:10px;}
  .reel-card{aspect-ratio:9/16;max-height:400px;}
}

/* ===== S9: WHAT YOU RECEIVE ===== */
.what-receive{background:var(--bg-0);border-bottom:1px solid var(--line);}
.receive-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px;}
.receive-item{
  background:var(--bg-2);border:1px solid var(--line);border-radius:var(--radius);
  padding:28px 14px;text-align:center;transition:transform .2s ease;
}
.receive-item:hover{transform:translateY(-4px);border-color:var(--gold-dim);}
.receive-icon{font-size:34px;margin-bottom:10px;}
.receive-item h4{font-size:14.5px;color:var(--gold-light);margin-bottom:6px;}
.receive-item p{font-size:12px;color:var(--text-dim);line-height:1.5;}
@media(max-width:900px){.receive-grid{grid-template-columns:repeat(3,1fr);}}
@media(max-width:500px){.receive-grid{grid-template-columns:repeat(2,1fr);gap:10px;}}

/* ===== S10: FAQ ===== */
.faq-section{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
.faq-list{max-width:760px;margin:0 auto;display:flex;flex-direction:column;gap:10px;}
.faq-item{border:1px solid var(--line);border-radius:12px;background:var(--bg-2);overflow:hidden;}
.faq-q{
  width:100%;display:flex;justify-content:space-between;align-items:center;gap:14px;
  padding:18px 22px;background:none;border:none;color:var(--text-hi);
  font-family:inherit;font-size:15px;font-weight:600;cursor:pointer;text-align:left;
}
.faq-q .plus{flex-shrink:0;width:22px;height:22px;border-radius:50%;border:1px solid var(--gold-dim);
  color:var(--gold-light);display:flex;align-items:center;justify-content:center;
  font-size:16px;transition:transform .25s ease;
}
.faq-item.open .plus{transform:rotate(45deg);}
.faq-a{max-height:0;overflow:hidden;transition:max-height .28s ease;}
.faq-a-inner{padding:0 22px 20px;color:var(--text-mid);font-size:14.5px;line-height:1.75;}

/* ===== S11: BOOKING FORM ===== */
.booking-section{background:var(--bg-0);border-bottom:1px solid var(--line);}
.pricing-plans{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:50px;}
.plan-card{
  background:var(--bg-2);border:1px solid var(--line);border-radius:var(--radius);
  padding:30px 24px 28px;display:flex;flex-direction:column;position:relative;
  transition:transform .2s ease;
}
.plan-card:hover{transform:translateY(-6px);}
.plan-card.featured{
  border-color:var(--gold);
  background:linear-gradient(180deg,rgba(212,175,55,0.10),var(--bg-2) 40%);
  box-shadow:0 20px 50px -20px rgba(212,175,55,0.35);
}
.plan-badge{
  position:absolute;top:-13px;left:50%;transform:translateX(-50%);
  background:linear-gradient(135deg,var(--gold),#a9832b);color:#241205;
  font-size:12px;font-weight:800;padding:5px 16px;border-radius:999px;white-space:nowrap;
}
.plan-name{font-family:'Noto Serif Devanagari',serif;font-weight:800;font-size:22px;color:var(--gold-light);margin-bottom:4px;}
.plan-for{color:var(--text-dim);font-size:13px;margin-bottom:16px;}
.plan-price{display:flex;align-items:baseline;gap:10px;margin-bottom:4px;}
.plan-price .now{font-size:30px;font-weight:800;color:var(--text-hi);}
.plan-list{list-style:none;padding:0;margin:0 0 24px;display:flex;flex-direction:column;gap:10px;flex-grow:1;}
.plan-list li{font-size:14px;color:var(--text-mid);line-height:1.5;display:flex;gap:8px;}
.plan-list li::before{content:"◆";color:var(--gold);font-size:9px;margin-top:4px;flex-shrink:0;}
.plan-btn{
  width:100%;text-align:center;padding:17px 18px;border-radius:12px;
  font-weight:800;font-size:16px;cursor:pointer;border:none;
  background:linear-gradient(135deg,#FFE580,#FFD700 45%,#E8B800);
  color:#2b1704;font-family:inherit;
  box-shadow:0 10px 26px -8px rgba(255,215,0,0.55);
  transition:transform .2s ease,box-shadow .25s ease;
}
.plan-btn:hover{transform:translateY(-3px);box-shadow:0 14px 30px -6px rgba(255,215,0,0.7);}
.plan-btn-gold{background:linear-gradient(135deg,#FFE580,#FFD700 45%,#E8B800);color:#2b1704;}
@media(max-width:900px){.pricing-plans{grid-template-columns:1fr;gap:18px;}}

.booking-form-wrap{max-width:800px;margin:0 auto;}
.booking-form{display:flex;flex-direction:column;gap:18px;}
.booking-form .form-row{display:flex;gap:16px;}
.booking-form .form-row.split .form-group{flex:1;}
.booking-form .form-group{flex:1;display:flex;flex-direction:column;}
.booking-form .form-group.full{width:100%;}
.booking-form label{font-size:14px;font-weight:600;color:var(--gold-light);margin-bottom:6px;}
.booking-form input,.booking-form select,.booking-form textarea{
  background:var(--bg-2);border:1px solid var(--line);border-radius:var(--radius-sm);
  padding:12px 16px;font-size:15px;color:var(--text-hi);
  font-family:inherit;outline:none;transition:border-color .2s ease;
}
.booking-form input:focus,.booking-form select:focus,.booking-form textarea:focus{border-color:var(--gold);}
.booking-form input::placeholder,.booking-form textarea::placeholder{color:var(--text-dim);opacity:0.6;}
.booking-form textarea{resize:vertical;min-height:80px;}
.booking-form .dob-selectors{display:flex;gap:10px;}
.booking-form .dob-selectors select{flex:1;}
.package-selector{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
.pkg-radio{
  position:relative;display:flex;flex-direction:column;align-items:center;gap:4px;
  padding:18px 12px 14px;border:2px solid var(--line);border-radius:var(--radius);
  background:var(--bg-2);cursor:pointer;transition:border-color .2s ease,background .2s ease;
}
.pkg-radio input{position:absolute;opacity:0;pointer-events:none;}
.pkg-radio .pkg-badge{position:absolute;top:-10px;left:50%;transform:translateX(-50%);
  background:linear-gradient(135deg,var(--gold),#a9832b);color:#241205;
  font-size:10px;font-weight:800;padding:4px 10px;border-radius:999px;white-space:nowrap;}
.pkg-radio .pkg-label{font-size:16px;font-weight:800;color:var(--text-hi);font-family:'Noto Serif Devanagari',serif;}
.pkg-radio .pkg-price{font-size:22px;font-weight:800;color:var(--gold-light);}
.pkg-radio .pkg-mon{font-size:11px;color:var(--text-dim);}
.pkg-radio:hover{border-color:var(--gold-dim);}
.pkg-radio:has(input:checked){border-color:var(--gold);background:rgba(212,175,55,0.10);box-shadow:0 0 20px rgba(212,175,55,0.2);}
.pkg-radio:has(input:checked) .pkg-label{color:var(--gold-light);}
@media(max-width:700px){
  .package-selector{grid-template-columns:1fr;}
  .booking-form .form-row{flex-direction:column;}
}

/* === Calendar === */
.calendar-wrap{max-width:700px;margin:40px auto 0;}
.urgency-box{
  text-align:center;background:linear-gradient(135deg,rgba(255,215,0,0.14),rgba(255,122,41,0.10));
  border:1px solid rgba(255,215,0,0.45);border-radius:14px;
  padding:14px 20px;color:var(--gold-light);font-weight:700;font-size:14px;line-height:1.7;
  margin-bottom:24px;box-shadow:0 0 24px rgba(255,215,0,0.18);
}
.calendar-weekdays{display:grid;grid-template-columns:repeat(7,1fr);gap:4px;max-width:640px;margin:0 auto 6px;
  text-align:center;font-size:11px;color:var(--gold-dim);}
.calendar-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:4px;max-width:640px;margin:0 auto 16px;}
.cal-day{aspect-ratio:1;border-radius:8px;background:var(--bg-2);border:1px solid var(--line);
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1px;padding:2px;}
.cal-day.empty{visibility:hidden;}
.cal-daynum{font-family:'Noto Serif Devanagari',serif;font-weight:700;font-size:13px;color:var(--text-hi);}
.cal-day-label{font-size:7px;line-height:1.2;text-align:center;color:var(--text-dim);}
.cal-day.avail .cal-day-label{color:#6fdc8c;font-size:9px;}
.cal-day.limited{
  background:linear-gradient(160deg,rgba(255,207,77,0.28),rgba(255,207,77,0.10));
  border-color:#ffcf4d;animation:yellowGlow 2.2s ease-in-out infinite;
}
@keyframes yellowGlow{0%,100%{box-shadow:0 0 10px rgba(255,207,77,0.45);}50%{box-shadow:0 0 18px rgba(255,207,77,0.7);}}
.cal-day.limited .cal-daynum{color:#ffe38a;}
.cal-day.limited .cal-day-label{color:#3a2a06;background:#ffcf4d;border-radius:4px;padding:1px 3px;font-weight:800;font-size:6px;}
.cal-day.urgent{
  background:linear-gradient(160deg,rgba(255,120,40,0.35),rgba(198,43,31,0.18));
  border-color:#FFD700;animation:redGlow 2.2s ease-in-out infinite;
}
@keyframes redGlow{0%,100%{box-shadow:0 0 10px rgba(255,80,50,0.4),0 0 4px rgba(255,215,0,0.25);}50%{box-shadow:0 0 20px rgba(255,80,50,0.7),0 0 10px rgba(255,215,0,0.5);}}
.cal-day.urgent .cal-daynum{color:#ffe9b0;}
.cal-day.urgent .cal-day-label{color:#2b1704;background:linear-gradient(135deg,#FFE580,#FFD700);border-radius:4px;padding:1px 3px;font-weight:800;font-size:6px;}
.cal-legend{display:flex;justify-content:center;gap:18px;flex-wrap:wrap;margin-bottom:28px;font-size:12px;color:var(--text-mid);}
.cal-legend .dot{display:inline-block;width:8px;height:8px;border-radius:50%;margin-right:4px;}
.dot-red{background:#ff5b3d;}
.dot-yellow{background:#ffcf4d;}
.dot-green{background:#6fdc8c;}

/* ===== S12: FINAL CTA ===== */
.final-cta{
  position:relative;padding:100px 0;text-align:center;
  background:radial-gradient(ellipse 70% 80% at 50% 110%,rgba(255,122,41,0.22),transparent 60%),
    linear-gradient(180deg,var(--bg-0),var(--bg-1));
  overflow:hidden;
}
.final-cta::before{
  content:"";position:absolute;bottom:-160px;left:50%;transform:translateX(-50%);
  width:560px;height:560px;
  background:radial-gradient(circle,rgba(212,175,55,0.22),transparent 65%);
  animation:auraPulse 7s ease-in-out infinite;
}
.final-cta .wrap{position:relative;z-index:2;}
.final-cta .urgency{
  display:inline-block;background:rgba(255,122,41,0.14);
  border:1px solid rgba(255,122,41,0.4);color:var(--saffron);
  font-size:13px;font-weight:700;padding:7px 18px;border-radius:999px;margin-bottom:20px;
}
.final-cta h2{font-size:clamp(28px,4.6vw,42px);color:var(--text-hi);margin-bottom:14px;}
.final-cta .sub{color:var(--text-mid);font-size:16px;margin-bottom:34px;max-width:560px;margin-left:auto;margin-right:auto;}
.final-cta .btn{padding:20px 48px;font-size:20px;}

/* ===== S13: FOOTER ===== */
.page-footer{
  background:var(--bg-1);border-top:1px solid var(--line);padding:50px 0 30px;
}
.footer-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:30px;margin-bottom:30px;}
.footer-col h4{font-size:15px;color:var(--gold-light);margin-bottom:14px;}
.footer-col p,.footer-col a{font-size:13px;color:var(--text-dim);line-height:1.8;display:block;}
.footer-col a:hover{color:var(--gold);}
.footer-col .f-contact{display:flex;flex-direction:column;gap:4px;}
.footer-col .f-contact span{font-size:13px;color:var(--text-dim);}
.footer-bottom{text-align:center;padding-top:24px;border-top:1px solid var(--line);
  font-size:12.5px;color:var(--text-dim);}
.footer-bottom .f-social{display:flex;justify-content:center;gap:16px;margin-bottom:12px;}
.footer-bottom .f-social a{width:36px;height:36px;border-radius:50%;border:1px solid var(--line);
  display:flex;align-items:center;justify-content:center;color:var(--text-dim);font-size:16px;transition:all .2s;}
.footer-bottom .f-social a:hover{border-color:var(--gold);color:var(--gold);}
@media(max-width:768px){.footer-grid{grid-template-columns:repeat(2,1fr);gap:20px;}}
@media(max-width:500px){.footer-grid{grid-template-columns:1fr;}}

/* ===== STICKY BAR ===== */
.sticky-bar{
  position:fixed;bottom:0;left:0;right:0;z-index:50;
  display:none;gap:10px;
  padding:10px 14px calc(10px + env(safe-area-inset-bottom));
  background:rgba(21,10,5,0.96);backdrop-filter:blur(14px);
  border-top:1px solid var(--line);box-shadow:0 -8px 30px rgba(0,0,0,0.5);
}
.sticky-bar .btn{flex:1;padding:14px 12px;font-size:15px;justify-content:center;border-radius:10px;}
.sticky-bar .btn-primary{background:linear-gradient(135deg,var(--saffron),var(--saffron-deep));color:#fff5e8;box-shadow:0 6px 16px -4px rgba(255,122,41,0.5);}
.sticky-bar .btn-wa{background:#25D366;color:#fff;box-shadow:0 6px 16px -4px rgba(37,211,102,0.4);}
.sticky-bar .btn-wa:hover{background:#20bd5a;}
.sticky-bar .btn svg{flex-shrink:0;}

/* ===== THANK YOU MODAL ===== */
.spinner{display:inline-block;width:20px;height:20px;border:3px solid rgba(255,255,255,0.3);border-top-color:#fff;border-radius:50%;animation:spin .6s linear infinite;}
@keyframes spin{to{transform:rotate(360deg);}}
.modal-overlay{
  position:fixed;inset:0;z-index:999;background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);
  display:none;align-items:center;justify-content:center;padding:24px;
}
.modal-overlay.show{display:flex;}
.modal-box{
  background:var(--bg-2);border:1px solid var(--gold);border-radius:20px;
  padding:40px 32px 32px;max-width:480px;width:100%;text-align:center;
  animation:modalIn .35s ease;
}
@keyframes modalIn{from{opacity:0;transform:scale(0.9) translateY(20px);}to{opacity:1;transform:scale(1) translateY(0);}}
.modal-box .icon{font-size:56px;margin-bottom:8px;}
.modal-box h2{font-size:24px;color:var(--gold-light);margin-bottom:8px;}
.modal-box p{color:var(--text-mid);font-size:15px;line-height:1.7;margin-bottom:6px;}
.modal-box .ref-id{background:rgba(212,175,55,0.10);border:1px solid var(--line);border-radius:8px;
  padding:10px 14px;display:inline-block;margin:12px 0 18px;font-size:13px;color:var(--gold);}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){
  .section{padding:60px 0;}
  .plans{grid-template-columns:1fr;gap:18px;}
  .plan.featured{order:0;}
}
@media(max-width:700px){
  .section-head{margin-bottom:32px;}
  .section-head h2{font-size:clamp(20px,5vw,28px);}
  .booking-form input,.booking-form select,.booking-form textarea{font-size:16px;padding:14px;}
}
@media(max-width:600px){
  .sticky-bar{display:flex;}
  .section{padding:48px 0;}
  .hero .wrap{padding:80px 16px 50px;}
  .hero h1{font-size:clamp(26px,8vw,36px);}
  .hero .sub{font-size:15px;}
  .hero-stats{gap:16px;}
  .hero-stat-num{font-size:22px;}
  .final-cta{padding:60px 0;}
  .faq-q{font-size:14px;padding:16px;}
  .plan-card{padding:24px 18px 22px;}
  .plan-name{font-size:20px;}
  .plan-price .now{font-size:26px;}
  .modal-box{padding:28px 20px 24px;margin:0 12px;}
  .modal-box h2{font-size:20px;}
  .modal-box .icon{font-size:44px;}
  .wrap{padding:0 16px;}
}
</style>
</head>
<body>

<!-- ===== S1: HERO ===== -->
<section class="hero" id="top">
  <video class="hero-video" autoplay muted loop playsinline poster="../assets/images/rudrabhishek_banner.jpg">
    <source src="../assets/images/pandit_video.gif.mp4" type="video/mp4">
  </video>
  <div class="hero-overlay"></div>
  <div class="hero-glow"></div>
  <div class="wrap">
    <span class="hero-badge">🔱 श्रावण मास 2026 · विशेष आयोजन</span>
    <h1>घर बैठे करवाएँ <span>श्री रुद्राभिषेक</span><br>अपने <span>लाइव संकल्प</span> के साथ</h1>
    <p class="sub">अपने नाम, गोत्र और परिवार के कल्याण हेतु — पूरी वीडियो रिकॉर्डिंग के साथ, और प्रसाद किट सीधे आपके घर पर।</p>
    <div class="hero-stats">
      <div class="hero-stat"><div class="hero-stat-num">5000+</div><div class="hero-stat-label">संतुष्ट परिवार</div></div>
      <div class="hero-stat"><div class="hero-stat-num">4.9★</div><div class="hero-stat-label">गूगल रेटिंग</div></div>
      <div class="hero-stat"><div class="hero-stat-num">15+</div><div class="hero-stat-label">वर्षों का अनुभव</div></div>
    </div>
    <div class="cta-row">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 आज ही संकल्प करें</button>
    </div>
    <p class="hero-note"><span>🔒 सुरक्षित भुगतान</span> · <span>📹 24 घंटे में वीडियो</span> · <span>🚚 3–5 दिनों में प्रसाद</span></p>
  </div>
</section>

<!-- ===== S2: WHY THIS IS DIFFERENT ===== -->
<section class="section why-different" id="why-different">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">यह अलग क्यों है?</span>
      <h2>सामान्य ऑनलाइन पूजा नहीं — यह आपका व्यक्तिगत अनुभव है</h2>
      <p>हर रुद्राभिषेक आपके नाम, आपके संकल्प और आपकी श्रद्धा से जुड़ता है।</p>
    </div>
    <div class="usp-grid">
      <div class="usp-card">
        <div class="usp-icon">📹</div>
        <h3>लाइव संकल्प</h3>
        <p>पूजा से पहले वीडियो कॉल पर आप स्वयं अपना संकल्प लेंगे — आपका नाम, गोत्र और उद्देश्य सहित।</p>
      </div>
      <div class="usp-card">
        <div class="usp-icon">🔱</div>
        <h3>व्यक्तिगत रुद्राभिषेक</h3>
        <p>आपके नाम और गोत्र का उच्चारण करते हुए वैदिक मंत्रों के साथ पूर्ण रुद्राभिषेक किया जाता है।</p>
      </div>
      <div class="usp-card">
        <div class="usp-icon">📿</div>
        <h3>वैदिक विधि</h3>
        <p>प्रमाणित आचार्य द्वारा शास्त्रोक्त विधि से संपूर्ण रुद्राभिषेक — हर मंत्र, हर अक्षर शुद्ध उच्चारण के साथ।</p>
      </div>
      <div class="usp-card">
        <div class="usp-icon">🎁</div>
        <h3>वीडियो एवं प्रसाद</h3>
        <p>पूरी HD वीडियो रिकॉर्डिंग + पवित्र प्रसाद किट (रुद्राक्ष, भस्म, गंगाजल) सीधे आपके द्वार पर।</p>
      </div>
    </div>
    <div class="section-cta">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 मैं यह सेवा लेना चाहता हूँ</button>
    </div>
  </div>
</section>

<!-- ===== S3: WHO IS THIS FOR ===== -->
<section class="section who-for" id="who-for">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">यह सेवा किसके लिए है?</span>
      <h2>क्या आप इनमें से किसी एक के लिए आशीर्वाद चाहते हैं?</h2>
      <p>रुद्राभिषेक हर उस व्यक्ति के लिए है जो जीवन में सकारात्मक बदलाव, शांति और समृद्धि की कामना रखता है।</p>
    </div>
    <div class="cat-grid">
      <div class="cat-card"><div class="cat-icon">💪</div><h4>स्वास्थ्य</h4></div>
      <div class="cat-card"><div class="cat-icon">📈</div><h4>व्यापार</h4></div>
      <div class="cat-card"><div class="cat-icon">🚀</div><h4>करियर</h4></div>
      <div class="cat-card"><div class="cat-icon">💑</div><h4>विवाह</h4></div>
      <div class="cat-card"><div class="cat-icon">👨‍👩‍👧‍👦</div><h4>परिवार</h4></div>
      <div class="cat-card"><div class="cat-icon">🧘</div><h4>मानसिक शांति</h4></div>
      <div class="cat-card"><div class="cat-icon">✨</div><h4>आध्यात्मिक उन्नति</h4></div>
      <div class="cat-card"><div class="cat-icon">🌞</div><h4>सकारात्मक ऊर्जा</h4></div>
    </div>
    <div class="section-cta">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 हाँ, मैं अपने लिए देखना चाहता हूँ</button>
    </div>
  </div>
</section>

<!-- ===== S4: LIVE SANKALP EXPERIENCE (MAIN USP) ===== -->
<section class="section sankalp-experience" id="sankalp-experience">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">लाइव संकल्प अनुभव</span>
      <h2>यहीं से शुरू होता है आपका <span style="color:var(--saffron)">व्यक्तिगत अनुभव</span></h2>
      <p>वास्तविक वीडियो, वास्तविक प्रक्रिया — आप देखेंगे कि कैसे आपका संकल्प लिया जाता है और रुद्राभिषेक संपन्न होता है।</p>
    </div>
    <div class="sankalp-layout">
      <div class="sankalp-media">
        <div class="sankalp-video-wrapper">
          <video controls playsinline poster="../assets/images/IMG-20260714-WA0003.jpg">
            <source src="../assets/images/pandit_video.gif.mp4" type="video/mp4">
          </video>
        </div>
        <p class="sankalp-video-caption">🎥 देखें कैसे होता है आपका व्यक्तिगत रुद्राभिषेक — लाइव संकल्प से प्रसाद तक</p>
        <div class="sankalp-thumbs">
          <div class="sankalp-thumb"><img src="../assets/images/samagri.jpg" alt="पूजा सामग्री"></div>
          <div class="sankalp-thumb"><img src="../assets/images/IMG-20260725-WA0003.jpg" alt="रुद्राभिषेक"></div>
          <div class="sankalp-thumb"><img src="../assets/images/IMG-20260725-WA0005.jpg" alt="प्रसाद पैकिंग"></div>
        </div>
      </div>
      <div class="sankalp-content">
        <span class="tag">🔱 आपकी भागीदारी</span>
        <h2>आप स्वयं <em>लाइव</em> जुड़कर लेंगे अपना संकल्प</h2>
        <p class="sankalp-desc">यह कोई रिकॉर्डेड पूजा नहीं है। आप वीडियो कॉल पर जुड़ेंगे और आचार्य आपका नाम, गोत्र, पिता/पति का नाम लेकर संकल्प करवाएँगे — ठीक वैसे जैसे आप स्वयं मंदिर में बैठकर कराते।</p>
        <div class="sankalp-highlight">
          <p>🌟 <em>आपका नाम, आपका गोत्र, आपका संकल्प</em> — बस यही चाहिए। हम बाकी सब संभालते हैं।</p>
        </div>
        <ul class="sankalp-process">
          <li><span class="sp-icon">📞</span> पूजा से 30 मिनट पहले वीडियो लिंक मिलेगा</li>
          <li><span class="sp-icon">🙏</span> आप लाइव जुड़कर अपना संकल्प लेंगे</li>
          <li><span class="sp-icon">🔱</span> आचार्य आपके नाम से पूर्ण रुद्राभिषेक करेंगे</li>
          <li><span class="sp-icon">📹</span> पूरी प्रक्रिया की HD वीडियो आपको भेजी जाएगी</li>
        </ul>
        <div class="section-cta" style="margin-top:24px;text-align:left;">
          <button class="btn btn-primary" onclick="scrollToBooking()">🙏 मेरा लाइव संकल्प बुक करें</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== S5: HOW THE COMPLETE PROCESS WORKS ===== -->
<section class="section process-timeline" id="process">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">पूरी प्रक्रिया</span>
      <h2>🔱 यह कैसे काम करता है?</h2>
      <p>बुकिंग से लेकर प्रसाद आपके घर पहुँचने तक — हर कदम पारदर्शी और सुनियोजित।</p>
    </div>
    <div class="timeline-grid">
      <div class="timeline-step">
        <div class="step-count">चरण 1</div>
        <div class="step-icon">📝</div>
        <h4>बुकिंग</h4>
        <p>अपनी जानकारी भरें और पैकेज चुनें।</p>
      </div>
      <div class="timeline-step">
        <div class="step-count">चरण 2</div>
        <div class="step-icon">📅</div>
        <h4>तिथि एवं समय चयन</h4>
        <p>अपनी सुविधानुसार तिथि और समय चुनें।</p>
      </div>
      <div class="timeline-step">
        <div class="step-count">चरण 3</div>
        <div class="step-icon">💳</div>
        <h4>Payment Confirmation</h4>
        <p>सुरक्षित भुगतान के बाद बुकिंग कन्फर्म होगी।</p>
      </div>
      <div class="timeline-step">
        <div class="step-count">चरण 4</div>
        <div class="step-icon">📹</div>
        <h4>Live Video Call</h4>
        <p>पूजा से 30 मिनट पहले वीडियो लिंक भेजा जाएगा।</p>
      </div>
      <div class="timeline-step">
        <div class="step-count">चरण 5</div>
        <div class="step-icon">🙏</div>
        <h4>व्यक्तिगत संकल्प</h4>
        <p>आप लाइव जुड़कर अपना संकल्प लेंगे।</p>
      </div>
      <div class="timeline-step">
        <div class="step-count">चरण 6</div>
        <div class="step-icon">🔱</div>
        <h4>रुद्राभिषेक</h4>
        <p>आचार्य द्वारा वैदिक मंत्रों से पूर्ण अभिषेक।</p>
      </div>
      <div class="timeline-step">
        <div class="step-count">चरण 7</div>
        <div class="step-icon">📹</div>
        <h4>Video Recording</h4>
        <p>24 घंटे में HD वीडियो WhatsApp और Email पर।</p>
      </div>
      <div class="timeline-step">
        <div class="step-count">चरण 8</div>
        <div class="step-icon">🚚</div>
        <h4>Prasad Dispatch</h4>
        <p>3–5 दिनों में प्रसाद किट कूरियर से आपके घर।</p>
      </div>
    </div>
    <div class="section-cta">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 अभी बुक करें</button>
    </div>
  </div>
</section>

<!-- ===== S6: MEET THE ACHARYA ===== -->
<section class="section acharya" id="acharya">
  <div class="wrap">
    <div class="acharya-layout">
      <div class="acharya-photo-box">
        <div class="acharya-photo">
          <img src="../assets/images/hero.jpg" alt="आचार्य">
        </div>
        <div class="acharya-name">पंडित आचार्य</div>
        <div class="acharya-title">वैदिक रुद्राभिषेक विशेषज्ञ</div>
      </div>
      <div class="acharya-info">
        <span class="tag" style="display:inline-block;margin-bottom:10px;">🙏 आचार्य परिचय</span>
        <h2>प्रमाणित वैदिक आचार्य द्वारा संपूर्ण रुद्राभिषेक</h2>
        <p class="acharya-desc">हमारे अनुभवी आचार्य ने 15+ वर्षों में 5000 से अधिक रुद्राभिषेक संपन्न किए हैं। शास्त्रोक्त विधि, शुद्ध उच्चारण और पूर्ण समर्पण के साथ हर पूजा को संपन्न किया जाता है। आप चाहे देश में रहें या विदेश, हर संकल्प उतनी ही श्रद्धा और विधि से होता है जितना मंदिर में बैठकर कराने पर होता।</p>
        <ul class="acharya-creds">
          <li><span class="ac-icon">✅</span> 15+ वर्षों का वैदिक अनुभव</li>
          <li><span class="ac-icon">✅</span> 5000+ रुद्राभिषेक संपन्न</li>
          <li><span class="ac-icon">✅</span> शुद्ध वैदिक उच्चारण में प्रमाणित</li>
          <li><span class="ac-icon">✅</span> अंतर्राष्ट्रीय श्रद्धालुओं हेतु सेवा</li>
        </ul>
        <div class="section-cta" style="text-align:left;margin-top:20px;">
          <button class="btn btn-primary" onclick="scrollToBooking()">🙏 आचार्य से संकल्प करवाएँ</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== S7: WHY PEOPLE TRUST THIS PROCESS ===== -->
<section class="section trust-section" id="trust">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">हम पर भरोसा क्यों?</span>
      <h2>लोग इस प्रक्रिया पर क्यों भरोसा करते हैं?</h2>
      <p>हर वादा निभाया जाता है — कोई अस्पष्टता नहीं, कोई कमी नहीं।</p>
    </div>
    <div class="trust-grid">
      <div class="trust-item"><div class="t-icon">✔️</div><h4>व्यक्तिगत संकल्प</h4></div>
      <div class="trust-item"><div class="t-icon">✔️</div><h4>वैदिक विधि</h4></div>
      <div class="trust-item"><div class="t-icon">✔️</div><h4>Original Process</h4></div>
      <div class="trust-item"><div class="t-icon">✔️</div><h4>Video Recording</h4></div>
      <div class="trust-item"><div class="t-icon">✔️</div><h4>Prasad</h4></div>
      <div class="trust-item"><div class="t-icon">✔️</div><h4>Secure Booking</h4></div>
      <div class="trust-item"><div class="t-icon">✔️</div><h4>Transparent Process</h4></div>
      <div class="trust-item"><div class="t-icon">✔️</div><h4>5000+ संतुष्ट श्रद्धालु</h4></div>
    </div>
    <div class="section-cta">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 भरोसे के साथ बुक करें</button>
    </div>
  </div>
</section>

<!-- ===== S8: BEHIND THE RITUAL (REEL VIDEOS) ===== -->
<section class="section gallery-section" id="gallery">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">मूल झलकियाँ</span>
      <h2>🎬 रुद्राभिषेक के वास्तविक दृश्य</h2>
      <p>हमारी वास्तविक प्रक्रिया की ये वीडियो झलकियाँ — संकल्प, अभिषेक, आरती और प्रसाद — आपको पूरा अनुभव देंगी।</p>
    </div>
    <div class="reel-grid">
      <div class="reel-card" data-video="0">
        <div class="reel-poster"><img src="../assets/images/IMG-20260725-WA0003.jpg" alt="संकल्प"></div>
        <video loop playsinline preload="none" poster="../assets/images/IMG-20260725-WA0003.jpg">
          <source src="../assets/images/pandit_video.gif.mp4" type="video/mp4">
        </video>
        <div class="reel-play-btn"><div class="play-icon">▶</div></div>
        <div class="reel-label"><span>🙏 संकल्प</span><small>आपका नाम, गोत्र और उद्देश्य</small></div>
        <button class="reel-mute-btn">🔇</button>
      </div>
      <div class="reel-card" data-video="0">
        <div class="reel-poster"><img src="../assets/images/IMG-20260714-WA0003.jpg" alt="रुद्राभिषेक"></div>
        <video loop playsinline preload="none" poster="../assets/images/IMG-20260714-WA0003.jpg">
          <source src="../assets/images/pandit_video.gif.mp4" type="video/mp4">
        </video>
        <div class="reel-play-btn"><div class="play-icon">▶</div></div>
        <div class="reel-label"><span>🔱 रुद्राभिषेक</span><small>वैदिक मंत्रों से पूर्ण अभिषेक</small></div>
        <button class="reel-mute-btn">🔇</button>
      </div>
      <div class="reel-card" data-video="0">
        <div class="reel-poster"><img src="../assets/images/mansarovar.jpg" alt="आरती"></div>
        <video loop playsinline preload="none" poster="../assets/images/mansarovar.jpg">
          <source src="../assets/images/pandit_video.gif.mp4" type="video/mp4">
        </video>
        <div class="reel-play-btn"><div class="play-icon">▶</div></div>
        <div class="reel-label"><span>🪔 आरती</span><small>महादेव की महाआरती</small></div>
        <button class="reel-mute-btn">🔇</button>
      </div>
      <div class="reel-card" data-video="0">
        <div class="reel-poster"><img src="../assets/images/IMG-20260725-WA0005.jpg" alt="प्रसाद"></div>
        <video loop playsinline preload="none" poster="../assets/images/IMG-20260725-WA0005.jpg">
          <source src="../assets/images/pandit_video.gif.mp4" type="video/mp4">
        </video>
        <div class="reel-play-btn"><div class="play-icon">▶</div></div>
        <div class="reel-label"><span>🎁 प्रसाद</span><small>रुद्राक्ष, भस्म, गंगाजल सहित किट</small></div>
        <button class="reel-mute-btn">🔇</button>
      </div>
    </div>
    <div class="section-cta">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 मैं भी इसका हिस्सा बनना चाहता हूँ</button>
    </div>
  </div>
</section>

<!-- ===== S9: WHAT YOU WILL RECEIVE ===== -->
<section class="section what-receive" id="what-receive">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">आपको क्या मिलेगा?</span>
      <h2>🎁 इस सेवा में यह सब शामिल है</h2>
    </div>
    <div class="receive-grid">
      <div class="receive-item">
        <div class="receive-icon">📹</div>
        <h4>Live Sankalp</h4>
        <p>वीडियो कॉल पर लाइव संकल्प</p>
      </div>
      <div class="receive-item">
        <div class="receive-icon">🔱</div>
        <h4>Personalized Rudra Abhishek</h4>
        <p>आपके नाम से पूर्ण अभिषेक</p>
      </div>
      <div class="receive-item">
        <div class="receive-icon">🎥</div>
        <h4>Video Recording</h4>
        <p>HD वीडियो 24 घंटे में</p>
      </div>
      <div class="receive-item">
        <div class="receive-icon">📿</div>
        <h4>Prasad</h4>
        <p>रुद्राक्ष, भस्म, गंगाजल सहित किट</p>
      </div>
      <div class="receive-item">
        <div class="receive-icon">✅</div>
        <h4>Ritual Confirmation</h4>
        <p>पूजा पूर्ण होने की पुष्टि</p>
      </div>
    </div>
    <div class="section-cta">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 यह सेवा लें</button>
    </div>
  </div>
</section>

<!-- ===== S10: FAQ ===== -->
<section class="section faq-section" id="faq">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">शंका समाधान</span>
      <h2>❓ अक्सर पूछे जाने वाले सवाल</h2>
      <p>आपके मन के सभी सवालों के जवाब यहाँ हैं।</p>
    </div>
    <div class="faq-list" id="faqList">
      <div class="faq-item">
        <button class="faq-q"><span>🙏 क्या पूजा सच में मेरे नाम से होगी?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">हाँ, बिल्कुल। आपका पूरा नाम, गोत्र, पिता/पति का नाम और आपका संकल्प — सब कुछ वैदिक मंत्रों के साथ लिया जाएगा। आप लाइव वीडियो कॉल पर स्वयं संकल्प लेंगे।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>📹 वीडियो रिकॉर्डिंग कब मिलेगी?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">पूजा के 24 घंटे के अंदर HD वीडियो आपको WhatsApp और Email दोनों पर भेज दी जाएगी।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>🚚 प्रसाद किट कब तक आएगी?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">3–5 कार्य दिवसों में आपके पते पर कूरियर से पहुँच जाएगी। इसमें पूजित रुद्राक्ष, भस्म, प्रसाद और गंगाजल शामिल हैं।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>🌍 क्या मैं विदेश से बुक कर सकता हूँ?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">हाँ। आप दुनिया के किसी भी कोने से बुक कर सकते हैं। ऑनलाइन पेमेंट और लाइव वीडियो कॉल से आप पूरी प्रक्रिया में जुड़ सकते हैं। प्रसाद किट अंतर्राष्ट्रीय कूरियर से भेजी जाती है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>💳 भुगतान कैसे होगा? क्या यह सुरक्षित है?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">भुगतान Razorpay के माध्यम से होता है — भारत का सबसे भरोसेमंद भुगतान गेटवे। आप UPI, क्रेडिट कार्ड, डेबिट कार्ड, नेट बैंकिंग से भुगतान कर सकते हैं। आपकी जानकारी पूरी तरह सुरक्षित है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>📞 लाइव वीडियो कॉल कैसे काम करेगी?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">पूजा से 30 मिनट पहले आपको WhatsApp पर एक वीडियो कॉल लिंक भेजा जाएगा। आप बस लिंक पर क्लिक करें और लाइव जुड़ें। कोई ऐप डाउनलोड करने की ज़रूरत नहीं है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>🕉️ क्या मैं एक से अधिक लोगों के लिए बुक कर सकता हूँ?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">हाँ। बेसिक पैकेज में 11 लोगों के नाम एक साथ लिए जाते हैं, प्रीमियम में 5 लोगों के, और VIP पैकेज सिर्फ आपके लिए होता है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>🎯 मुझे कौन सा पैकेज चुनना चाहिए?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">यदि आप पूरे परिवार के लिए करवाना चाहते हैं तो बेसिक (₹1,100) या प्रीमियम (₹2,100) उपयुक्त है। यदि आप सिर्फ अपने लिए व्यक्तिगत रुद्राभिषेक चाहते हैं तो VIP (₹5,100) सबसे अच्छा है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>📅 क्या मैं कोई भी तिथि चुन सकता हूँ?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">हाँ, आप नीचे कैलेंडर से अपनी सुविधानुसार तिथि चुन सकते हैं। श्रावण मास के सोमवार विशेष महत्व रखते हैं और उन पर विशेष श्रृंगार एवं पूजा होती है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>🔱 सोमवार पर अलग मूल्य क्यों है?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">सोमवार के दिन विशेष श्रृंगार, विशेष पूजा अर्चना, और विशेष प्रसाद तैयार किया जाता है। इसमें अतिरिक्त सामग्री और समय लगता है, इसलिए मूल्य भिन्न है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>❌ अगर मैं कैंसल करूँ तो रिफंड मिलेगा?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">पूजा की तिथि से 48 घंटे पहले तक फ्री कैंसलेशन और पूरा रिफंड मिलता है। उसके बाद कैंसलेशन पर 50% रिफंड दिया जाता है। कृपया Refund Policy देखें।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>📧 मुझे कन्फर्मेशन कैसे मिलेगी?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">भुगतान के तुरंत बाद आपको Email और WhatsApp पर बुकिंग कन्फर्मेशन भेज दिया जाएगा। इसमें बुकिंग ID, तिथि, समय और आगे की प्रक्रिया की जानकारी होगी।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q"><span>🙋 क्या मैं बिना वीडियो कॉल के केवल संकल्प करा सकता हूँ?</span><span class="plus">+</span></button>
        <div class="faq-a"><div class="faq-a-inner">हाँ, यदि आप लाइव नहीं जुड़ सकते तो आप अपना नाम, गोत्र और संकल्प फॉर्म में नोट कर सकते हैं। आचार्य आपकी ओर से संकल्प लेंगे और पूरी वीडियो रिकॉर्डिंग भेज दी जाएगी।</div></div>
      </div>
    </div>
    <div class="section-cta">
      <button class="btn btn-primary" onclick="scrollToBooking()">🙏 मेरे सभी सवालों के जवाब मिल गए — अब बुक करें</button>
    </div>
  </div>
</section>

<!-- ===== S11: BOOKING FORM ===== -->
<section class="section booking-section" id="booking">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">बुकिंग फॉर्म</span>
      <h2>📝 अपनी बुकिंग की पुष्टि करें</h2>
      <p>नीचे अपनी जानकारी भरें और सुरक्षित भुगतान करें।</p>
    </div>

    <!-- Pricing Plans -->
    <div class="pricing-plans" id="pricing">
      <div class="plan-card">
        <div class="plan-name">बेसिक</div>
        <div class="plan-for">11 लोगों के लिए (सामूहिक)</div>
        <div class="plan-price"><span class="now">₹1,100</span></div>
        <ul class="plan-list">
          <li>11 लोगों का सामूहिक रुद्राभिषेक</li>
          <li>पूरी HD वीडियो रिकॉर्डिंग</li>
          <li>प्रसाद किट — रुद्राक्ष, भस्म, प्रसाद, गंगाजल</li>
        </ul>
        <button type="button" class="plan-btn" onclick="selectPackage('basic')">🙏 शिव कृपा - Book करें</button>
      </div>
      <div class="plan-card featured">
        <span class="plan-badge">✦ सबसे लोकप्रिय</span>
        <div class="plan-name">प्रीमियम</div>
        <div class="plan-for">5 लोगों के लिए (सामूहिक)</div>
        <div class="plan-price"><span class="now">₹2,100</span></div>
        <ul class="plan-list">
          <li>5 लोगों का सामूहिक रुद्राभिषेक</li>
          <li>पूरी HD वीडियो रिकॉर्डिंग</li>
          <li>प्रसाद किट — रुद्राक्ष, भस्म, प्रसाद, गंगाजल</li>
          <li>3 इंच महामृत्युंजय यंत्र</li>
        </ul>
        <button type="button" class="plan-btn" onclick="selectPackage('premium')">🙏 शिव कृपा - Book करें</button>
      </div>
      <div class="plan-card">
        <div class="plan-name">VIP</div>
        <div class="plan-for">1 व्यक्ति के लिए (सिर्फ आपके लिए)</div>
        <div class="plan-price"><span class="now">₹5,100</span></div>
        <ul class="plan-list">
          <li>आपका अकेला व्यक्तिगत रुद्राभिषेक</li>
          <li>पूरी HD वीडियो रिकॉर्डिंग</li>
          <li>प्रसाद किट — रुद्राक्ष, भस्म, प्रसाद, गंगाजल</li>
          <li>5 इंच महामृत्युंजय यंत्र</li>
        </ul>
        <button type="button" class="plan-btn" onclick="selectPackage('vip')">🙏 शिव कृपा - Book करें</button>
      </div>
    </div>

    <!-- Booking Form -->
    <div class="booking-form-wrap">
      <form id="bookingForm" class="booking-form" onsubmit="return false;">
        <div class="form-group full">
          <label>पैकेज चुनें *</label>
          <div class="package-selector">
            <label class="pkg-radio" data-pkg="basic">
              <input type="radio" name="package" value="basic" required>
              <span class="pkg-label">बेसिक</span>
              <span class="pkg-price">₹1,100</span>
            </label>
            <label class="pkg-radio" data-pkg="premium">
              <input type="radio" name="package" value="premium">
              <span class="pkg-badge">✦ सबसे लोकप्रिय</span>
              <span class="pkg-label">प्रीमियम</span>
              <span class="pkg-price">₹2,100</span>
            </label>
            <label class="pkg-radio" data-pkg="vip">
              <input type="radio" name="package" value="vip">
              <span class="pkg-label">VIP</span>
              <span class="pkg-price">₹5,100</span>
            </label>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>रुद्राभिषेक की तिथि *</label>
            <input type="date" name="puja_date" id="puja_date" required>
            <small class="mon-note" id="monNote" style="display:none;color:var(--saffron);margin-top:6px;">🌙 सोमवार — विशेष मूल्य लागू</small>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>पूरा नाम *</label>
            <input type="text" name="name" placeholder="अपना पूरा नाम दर्ज करें" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>जन्म तिथि (वैकल्पिक)</label>
            <div class="dob-selectors">
              <select name="dob_day" id="dob_day"><option value="">दिन</option></select>
              <select name="dob_month" id="dob_month"><option value="">महीना</option></select>
              <select name="dob_year" id="dob_year"><option value="">साल</option></select>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>गोत्र (वैकल्पिक)</label>
            <input type="text" name="gotra" placeholder="अपना गोत्र दर्ज करें">
          </div>
        </div>

        <div class="form-row split">
          <div class="form-group">
            <label>ईमेल *</label>
            <input type="email" name="email" placeholder="email@example.com" required>
          </div>
          <div class="form-group">
            <label>मोबाइल नंबर *</label>
            <input type="tel" name="mobile" placeholder="+91 98765 43210" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>देश *</label>
            <input type="text" name="country" placeholder="भारत" value="भारत">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>उद्देश्य (वैकल्पिक)</label>
            <input type="text" name="purpose" placeholder="जैसे — स्वास्थ्य, व्यापार, परिवार सुख, etc.">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>आपका संकल्प (वैकल्पिक)</label>
            <textarea name="sankalp" placeholder="अपना विशेष संकल्प लिखें — जैसे परिवार की सुख-शांति, व्यापार में उन्नति, etc." rows="3"></textarea>
          </div>
        </div>

        <div id="bookingError" style="display:none;color:#ff5b3d;text-align:center;margin-bottom:16px;font-weight:700;"></div>

        <button type="submit" class="plan-btn plan-btn-gold book-slot-btn" id="bookSlotBtn" style="border:none;cursor:pointer;max-width:400px;margin:0 auto;">🙏 Book My Slot</button>
      </form>

      <!-- Calendar -->
      <div class="calendar-wrap">
        <div class="urgency-box">🔥 सूचना: शुरुआती सोमवार और वीकेंड (1 अगस्त से 10 अगस्त) की बुकिंग लगभग समाप्त होने वाली है!</div>
        <p style="text-align:center;color:var(--text-dim);font-size:14px;margin-bottom:12px;">📅 बुकिंग कैलेंडर — 30 जुलाई – 28 अगस्त 2026</p>
        <div class="calendar-weekdays"><span>सोम</span><span>मंगल</span><span>बुध</span><span>गुरु</span><span>शुक्र</span><span>शनि</span><span>रवि</span></div>
        <div class="calendar-grid">
          <div class="cal-day empty"></div><div class="cal-day empty"></div><div class="cal-day empty"></div>
          <div class="cal-day avail"><span class="cal-daynum">30</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">31</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day limited"><span class="cal-daynum">1</span><span class="cal-day-label">Filling Fast</span></div>
          <div class="cal-day limited"><span class="cal-daynum">2</span><span class="cal-day-label">Filling Fast</span></div>
          <div class="cal-day urgent"><span class="cal-daynum">3</span><span class="cal-day-label">Few Left</span></div>
          <div class="cal-day avail"><span class="cal-daynum">4</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">5</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">6</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">7</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day limited"><span class="cal-daynum">8</span><span class="cal-day-label">Filling Fast</span></div>
          <div class="cal-day limited"><span class="cal-daynum">9</span><span class="cal-day-label">Filling Fast</span></div>
          <div class="cal-day urgent"><span class="cal-daynum">10</span><span class="cal-day-label">Few Left</span></div>
          <div class="cal-day avail"><span class="cal-daynum">11</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">12</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">13</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">14</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">15</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">16</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">17</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">18</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">19</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">20</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">21</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">22</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">23</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">24</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">25</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">26</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">27</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day avail"><span class="cal-daynum">28</span><span class="cal-day-label">✅</span></div>
          <div class="cal-day empty"></div><div class="cal-day empty"></div>
        </div>
        <div class="cal-legend">
          <span><i class="dot dot-red"></i> Few slots left</span>
          <span><i class="dot dot-yellow"></i> Limited slots</span>
          <span><i class="dot dot-green"></i> Available</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== S12: FINAL CTA ===== -->
<section class="final-cta" id="final-cta">
  <div class="wrap">
    <span class="urgency">⏳ सीमित सीटें — पहले आएँ, पहले पाएँ</span>
    <h2>🔱 इस श्रावण महादेव का आशीर्वाद लें</h2>
    <p class="sub">अपने नाम से रुद्राभिषेक करवाएँ — घर बैठे, पूरे विधि-विधान के साथ। <br>लाइव संकल्प, वीडियो रिकॉर्डिंग और प्रसाद किट सहित।</p>
    <button class="btn btn-primary" onclick="scrollToBooking()">🙏 हाँ, मैं संकल्प करना चाहता हूँ</button>
  </div>
</section>

<!-- ===== S13: FOOTER ===== -->
<footer class="page-footer">
  <div class="wrap">
    <div class="footer-grid">
      <div class="footer-col">
        <h4>🔱 श्री रुद्राभिषेक सेवा</h4>
        <p>श्रावण मास 2026 — अपने नाम, गोत्र और परिवार के कल्याण हेतु घर बैठे रुद्राभिषेक करवाएँ। पूरी वीडियो रिकॉर्डिंग और प्रसाद किट के साथ।</p>
      </div>
      <div class="footer-col">
        <h4>त्वरित लिंक</h4>
        <a href="#top">होम</a>
        <a href="#why-different">यह अलग क्यों?</a>
        <a href="#process">प्रक्रिया</a>
        <a href="#faq">FAQ</a>
        <a href="#booking">बुकिंग</a>
      </div>
      <div class="footer-col">
        <h4>महत्वपूर्ण लिंक</h4>
        <a href="<?= BASE_URL ?>/privacy-policy.php">Privacy Policy</a>
        <a href="<?= BASE_URL ?>/refund-policy.php">Refund Policy</a>
        <a href="<?= BASE_URL ?>/terms-and-conditions.php">Terms & Conditions</a>
        <a href="<?= BASE_URL ?>/payment-details.php">Payment Details</a>
      </div>
      <div class="footer-col">
        <h4>संपर्क करें</h4>
        <div class="f-contact">
          <span>📞 +91-9971799858</span>
          <span>📧 info@vastumitraabhishek.in</span>
          <span>📍 Faridabad, Haryana</span>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="f-social">
        <a href="https://www.facebook.com/VastuMitraAbhishek" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/vastu_mitra_abhishek/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://youtu.be/Lb1re-Balng?si=cYGCWxJ6NVHaiqva" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
      <p>🔱 ॐ नमः शिवाय — श्री रुद्राभिषेक सेवा, श्रावण मास 2026</p>
      <p style="margin-top:6px;">&copy; 2026 Vastu Mitra Abhishek. All Rights Reserved.</p>
    </div>
  </div>
</footer>

<!-- ===== STICKY BOTTOM BAR ===== -->
<div class="sticky-bar" id="stickyBar">
  <button class="btn btn-primary" onclick="scrollToBooking()">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
    बुक करें
  </button>
  <a class="btn btn-wa" href="https://wa.me/917428284357" target="_blank" rel="noopener">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    WhatsApp
  </a>
</div>

<!-- ===== THANK YOU MODAL ===== -->
<div class="modal-overlay" id="thankyouModal">
  <div class="modal-box">
    <div class="icon">🙏</div>
    <h2>बुकिंग कन्फर्म!</h2>
    <p>आपकी रुद्राभिषेक बुकिंग सफलतापूर्वक कन्फर्म हो गई है।</p>
    <p>आपके रजिस्टर्ड ईमेल और WhatsApp पर पूजा की जानकारी भेज दी जाएगी।</p>
    <div class="ref-id" id="confirmRefId"></div>
    <p style="font-size:13px;color:var(--gold-dim);">🔱 ॐ नमः शिवाय</p>
    <button class="btn btn-primary" onclick="closeThankyou()">ठीक है</button>
  </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function scrollToBooking(){
  var el = document.getElementById('booking');
  if(el) el.scrollIntoView({behavior:'smooth'});
}

function scrollToPricing(){
  var el = document.getElementById('pricing');
  if(el) el.scrollIntoView({behavior:'smooth'});
}

function selectPackage(pkg){
  var radio = document.querySelector('.package-selector input[value="'+pkg+'"]');
  if(radio) radio.checked = true;
  scrollToBooking();
}

// FAQ accordion
document.querySelectorAll('.faq-q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.faq-item');
    var isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(function(el){ el.classList.remove('open'); });
    if(!isOpen) item.classList.add('open');
  });
});

// Sticky bar visibility
(function(){
  var bar = document.getElementById('stickyBar');
  if(!bar) return;
  function updateBar(){bar.style.display = window.innerWidth <= 600 ? 'flex' : 'none';}
  updateBar();
  window.addEventListener('resize', updateBar);
})();

// Populate DOB selectors
(function(){
  var daySel = document.getElementById('dob_day');
  var monthSel = document.getElementById('dob_month');
  var yearSel = document.getElementById('dob_year');

  if(daySel){
    daySel.innerHTML = '<option value="">दिन</option>';
    for(var d=1;d<=31;d++){
      var opt = document.createElement('option');
      opt.value = d;
      opt.textContent = d;
      daySel.appendChild(opt);
    }
  }
  if(monthSel){
    var months = ['','जनवरी','फरवरी','मार्च','अप्रैल','मई','जून','जुलाई','अगस्त','सितंबर','अक्टूबर','नवंबर','दिसंबर'];
    monthSel.innerHTML = '<option value="">महीना</option>';
    for(var m=1;m<=12;m++){
      var opt = document.createElement('option');
      opt.value = m;
      opt.textContent = months[m];
      monthSel.appendChild(opt);
    }
  }
  if(yearSel){
    yearSel.innerHTML = '<option value="">साल</option>';
    var cy = new Date().getFullYear();
    for(var y=cy-70;y<=cy;y++){
      var opt = document.createElement('option');
      opt.value = y;
      opt.textContent = y;
      yearSel.appendChild(opt);
    }
  }
})();

// Monday pricing hint
(function(){
  var dateInput = document.getElementById('puja_date');
  var monNote = document.getElementById('monNote');
  if(dateInput && monNote){
    dateInput.addEventListener('change', function(){
      if(this.value){
        var d = new Date(this.value);
        if(d.getDay() === 1){
          monNote.style.display = 'block';
        } else {
          monNote.style.display = 'none';
        }
      } else {
        monNote.style.display = 'none';
      }
    });
  }
})();

// Booking form submission with Razorpay
document.getElementById('bookingForm').addEventListener('submit', function(e){
  e.preventDefault();
  var form = this;
  var btn = document.getElementById('bookSlotBtn');
  var errDiv = document.getElementById('bookingError');
  errDiv.style.display = 'none';

  var pkgEl = form.querySelector('input[name="package"]:checked');
  if(!pkgEl){ errDiv.textContent = 'कृपया एक पैकेज चुनें'; errDiv.style.display = 'block'; return; }

  var pujaDate = form.querySelector('[name="puja_date"]').value;
  if(!pujaDate){ errDiv.textContent = 'कृपया रुद्राभिषेक की तिथि चुनें'; errDiv.style.display = 'block'; return; }

  var name = form.querySelector('[name="name"]').value.trim();
  if(!name){ errDiv.textContent = 'कृपया अपना नाम दर्ज करें'; errDiv.style.display = 'block'; return; }

  var email = form.querySelector('[name="email"]').value.trim();
  if(!email){ errDiv.textContent = 'कृपया अपना ईमेल दर्ज करें'; errDiv.style.display = 'block'; return; }

  var mobile = form.querySelector('[name="mobile"]').value.trim();
  if(!mobile){ errDiv.textContent = 'कृपया अपना मोबाइल नंबर दर्ज करें'; errDiv.style.display = 'block'; return; }

  var dobDay = form.querySelector('[name="dob_day"]').value;
  var dobMonth = form.querySelector('[name="dob_month"]').value;
  var dobYear = form.querySelector('[name="dob_year"]').value;
  var dob = '';
  if(dobDay && dobMonth && dobYear){
    dob = dobYear + '-' + String(dobMonth).padStart(2,'0') + '-' + String(dobDay).padStart(2,'0');
  }

  btn.disabled = true;
  btn.innerHTML = '<span class="spinner"></span> कृपया प्रतीक्षा करें...';

  var formData = {
    package_name: pkgEl.value,
    puja_date: pujaDate,
    name: name,
    dob: dob,
    gotra: form.querySelector('[name="gotra"]').value.trim(),
    email: email,
    mobile: mobile,
    state: form.querySelector('[name="country"]').value.trim(),
    city: '',
    pincode: '',
    address: form.querySelector('[name="purpose"]').value.trim() + ' | ' + form.querySelector('[name="sankalp"]').value.trim()
  };

  fetch('../api/create_order.php', {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify(formData)
  })
  .then(function(r){ return r.json(); })
  .then(function(orderData){
    if(orderData.status !== 'success'){
      throw new Error(orderData.message || 'Order creation failed');
    }

    var options = {
      key: orderData.key_id,
      amount: orderData.amount,
      currency: orderData.currency,
      order_id: orderData.order_id,
      name: 'Vastu Mitra Abhishek',
      description: 'रुद्राभिषेक — ' + orderData.package_name,
      image: '../assets/logo/logo.png',
      prefill: {
        name: formData.name,
        email: formData.email,
        contact: formData.mobile
      },
      theme: { color: '#d4af37' },
      handler: function(response){
        fetch('../api/verify_payment.php', {
          method: 'POST',
          headers: {'Content-Type':'application/json'},
          body: JSON.stringify({
            razorpay_order_id: response.razorpay_order_id,
            razorpay_payment_id: response.razorpay_payment_id,
            razorpay_signature: response.razorpay_signature
          })
        })
        .then(function(r){ return r.json(); })
        .then(function(vData){
          if(vData.status === 'success'){
            document.getElementById('confirmRefId').textContent = 'बुकिंग ID: RA-' + orderData.booking_id;
            document.getElementById('thankyouModal').classList.add('show');
            form.reset();
            var mn = document.getElementById('monNote');
            if(mn) mn.style.display = 'none';
          } else {
            errDiv.textContent = vData.message || 'Payment verification failed. Contact support.';
            errDiv.style.display = 'block';
          }
        })
        .catch(function(){
          errDiv.textContent = 'Verification error. Please contact support with payment ID: ' + response.razorpay_payment_id;
          errDiv.style.display = 'block';
        })
        .finally(function(){
          btn.disabled = false;
          btn.innerHTML = '🙏 Book My Slot';
        });
      },
      modal: {
        ondismiss: function(){
          btn.disabled = false;
          btn.innerHTML = '🙏 Book My Slot';
        }
      }
    };

    var rzp = new Razorpay(options);
    rzp.open();
  })
  .catch(function(err){
    errDiv.textContent = err.message || 'Something went wrong. Please try again.';
    errDiv.style.display = 'block';
    btn.disabled = false;
    btn.innerHTML = '🙏 Book My Slot';
  });
});

function closeThankyou(){
  document.getElementById('thankyouModal').classList.remove('show');
}

// Reel video cards — Instagram-style play/pause
(function(){
  var cards = document.querySelectorAll('.reel-card');
  cards.forEach(function(card){
    var video = card.querySelector('video');
    var poster = card.querySelector('.reel-poster');
    var playBtn = card.querySelector('.reel-play-btn');
    var muteBtn = card.querySelector('.reel-mute-btn');

    card.addEventListener('click', function(e){
      if(e.target.closest('.reel-mute-btn')) return;
      if(video.paused){
        video.play().then(function(){
          poster.classList.add('playing');
          playBtn.classList.add('hidden');
          muteBtn.classList.add('show');
        }).catch(function(){});
      } else {
        video.pause();
        poster.classList.remove('playing');
        playBtn.classList.remove('hidden');
        muteBtn.classList.remove('show');
      }
    });

    muteBtn.addEventListener('click', function(e){
      e.stopPropagation();
      video.muted = !video.muted;
      muteBtn.textContent = video.muted ? '🔇' : '🔊';
    });

    video.addEventListener('ended', function(){
      poster.classList.remove('playing');
      playBtn.classList.remove('hidden');
      muteBtn.classList.remove('show');
    });
  });
})();
</script>
</body>
</html>
