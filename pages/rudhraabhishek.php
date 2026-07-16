<!DOCTYPE html>
<!--
  ============================================================================
  RUDRA ABHISHEK 2026 — SHRAVAN MAAS LANDING PAGE
  ============================================================================
  Pure HTML / CSS / JavaScript — no build step, no framework, no dependencies
  other than the Google Fonts CDN link below.

  Folder structure:
    index.html
    assets/css/styles.css   — all styling (dark + gold devotional theme)
    assets/js/main.js       — FAQ accordion, smooth-scroll, sticky CTA bar
    assets/images/          — 6 production photos (see README.md / ASSETS.md)
    assets/fonts/           — see README.md (fonts are loaded via CDN, not
                               bundled locally — folder kept for future use)

  See README.md for setup instructions and DEVELOPER_NOTES.md for
  integration points (payment/booking, WhatsApp number, etc.).
  ============================================================================
-->
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>श्री रुद्राभिषेक 2026 — श्रावण मास | घर बैठे संकल्प करें</title>

<!-- Google Fonts: Noto Serif/Sans Devanagari (external dependency — see DEVELOPER_NOTES.md) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Devanagari:wght@500;700;800;900&family=Noto+Sans+Devanagari:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Main stylesheet -->
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="grain"></div>

<div class="grain"></div>

<!-- ============ HERO ============ -->
<section class="hero" id="top">
  <div class="wrap hero-inner">
    <div class="hero-portrait">
      <div class="frame">
        <img src="../assets/images/hero.jpg" alt="पुजारी द्वारा किया गया रुद्राभिषेक">
      </div>
    </div>
    <p class="hero-portrait-cap">भगवान शिव — घर पर रुद्राभिषेक पूजा</p>
    <svg class="trishul" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M32 8 L32 56" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
      <path d="M32 8 C24 8 20 16 24 24 C26 20 29 18 32 18" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
      <path d="M32 8 C40 8 44 16 40 24 C38 20 35 18 32 18" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
      <path d="M32 4 L32 20" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
      <path d="M20 40 L44 40" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
    </svg>
    <span class="eyebrow">श्रावण मास 2026 · विशेष आयोजन</span>
    <h1>🔱 घर बैठे करवाएँ <span>श्री रुद्राभिषेक</span></h1>
    <p class="sub">अपने नाम, गोत्र और परिवार के कल्याण हेतु — पूरी वीडियो रिकॉर्डिंग के साथ, और प्रसाद किट सीधे आपके घर पर।</p>
    <div class="cta-row">
      <button class="btn btn-primary" onclick="scrollToPricing()">संकल्प लें</button>
    </div>
    <p class="hero-note">🔒 सुरक्षित भुगतान · 📹 24 घंटे में वीडियो · 🚚 3–5 दिनों में प्रसाद किट</p>
  </div>
</section>

<!-- ============ KAILASH MANSAROVAR — DIVINE SIGNIFICANCE ============ -->
<section class="mansarovar-section">
  <div class="wrap mansarovar-inner">
    <figure class="photo mansarovar-photo">
      <div class="img-frame" style="aspect-ratio:16/9;">
        <img src="assets/images/mansarovar.jpg" alt="कैलाश पर्वत पर ध्यानमग्न भगवान शिव">
      </div>
      <figcaption>कैलाश — भगवान शिव का दिव्य निवास स्थान</figcaption>
    </figure>
    <div class="mansarovar-text">
      <span class="tag">दिव्य महत्व</span>
      <h2>🏔️ कैलाश — जहाँ स्वयं महादेव विराजते हैं</h2>
      <p>हिमालय की गोद में बसा कैलाश पर्वत भगवान शिव का शाश्वत निवास माना जाता है। जिस श्रद्धा से साधक कैलाश-मानसरोवर की यात्रा कर शिव का आशीर्वाद पाते हैं, उसी भाव से यह रुद्राभिषेक आपके घर पर वही दिव्य अनुभूति लेकर आता है — बिना यात्रा की कठिनाई के, पूरी श्रद्धा और विधि-विधान के साथ।</p>
    </div>
  </div>
</section>

<!-- ============ SOCIAL PROOF ============ -->
<section class="proof">
  <div class="wrap proof-inner">
    <h3>हज़ारों श्रद्धालुओं का भरोसा 🙏</h3>
    <div class="diya-divider"></div>
    <p>हज़ारों श्रद्धालु अपने नाम और परिवार के कल्याण हेतु घर बैठे यह पवित्र सेवा ले चुके हैं। पूरी श्रद्धा और विधि-विधान के साथ, आपके भरोसे के लिए हम प्रतिबद्ध हैं।</p>
    <figure class="photo" style="max-width:520px;margin:28px auto 0;">
      <div class="img-frame" style="aspect-ratio:16/9;">
        <img src="../assets/images/testimonials.jpg" alt="विधि-विधान से किया गया रुद्राभिषेक">
      </div>
      <figcaption>श्रद्धा और पूरे विधि-विधान से किया गया रुद्राभिषेक पूजन</figcaption>
    </figure>
  </div>
</section>

<!-- ============ WHY RUDRA ABHISHEK ============ -->
<section class="section" id="why">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">महत्व</span>
      <h2>रुद्राभिषेक क्यों कराना चाहिए?</h2>
    </div>
    <div class="reason-split">
      <figure class="photo">
        <div class="img-frame">
          <img src="../assets/images/about.jpg" alt="भव्य शिवलिंग">
        </div>
        <figcaption>मंदिर में विराजमान भव्य शिवलिंग</figcaption>
      </figure>
      <div class="reason-points">
        <div class="reason-point">
          <span class="icon">🧘</span>
          <div>
            <h4>मानसिक शांति</h4>
            <p>रुद्राभिषेक मन को स्थिर करता है और भीतर की बेचैनी को शांत कर गहरी शांति का अनुभव कराता है।</p>
          </div>
        </div>
        <div class="reason-point">
          <span class="icon">🔓</span>
          <div>
            <h4>बाधाओं से मुक्ति</h4>
            <p>जीवन में आ रही रुकावटों और नकारात्मक ऊर्जा को दूर कर नए मार्ग खोलने में सहायक माना जाता है।</p>
          </div>
        </div>
        <div class="reason-point">
          <span class="icon">🔱</span>
          <div>
            <h4>शिव कृपा</h4>
            <p>श्रद्धा और विधि-विधान से किया गया अभिषेक भगवान शिव की विशेष कृपा प्राप्त करने का माध्यम है।</p>
          </div>
        </div>
        <div class="reason-point">
          <span class="icon">🌧️</span>
          <div>
            <h4>श्रावण का महत्व</h4>
            <p>श्रावण मास शिव भक्ति के लिए सबसे पावन समय माना जाता है, इसमें किया गया पूजन कई गुना फलदायी होता है।</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ BENEFITS ============ -->
<section class="section benefits">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">परिणाम</span>
      <h2>रुद्राभिषेक से क्या लाभ होता है?</h2>
    </div>
    <figure class="photo" style="max-width:560px;margin:0 auto 40px;">
      <div class="img-frame" style="aspect-ratio:16/9;">
        <img src="../assets/images/experience.jpg" alt="परिवार सहित रुद्राभिषेक अनुभव">
      </div>
      <figcaption>परिवार सहित मिलकर किया गया रुद्राभिषेक अनुभव</figcaption>
    </figure>
    <div class="benefit-grid">
      <div class="benefit-card">
        <div class="benefit-icon">🕊️</div>
        <h4>तनाव मुक्ति</h4>
        <p>दैनिक जीवन के तनाव और चिंता से राहत मिलती है, मन हल्का और शांत महसूस होता है।</p>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">📈</div>
        <h4>करियर में स्थिरता</h4>
        <p>कार्यक्षेत्र में आ रही अड़चनें दूर होकर स्थायित्व और प्रगति का मार्ग बनता है।</p>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">🏠</div>
        <h4>परिवार में सुख</h4>
        <p>घर-परिवार में आपसी प्रेम, सामंजस्य और सुख-शांति बनी रहती है।</p>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">💪</div>
        <h4>बेहतर स्वास्थ्य</h4>
        <p>शारीरिक और मानसिक स्वास्थ्य में सुधार होकर सकारात्मक ऊर्जा का संचार होता है।</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ PRICING ============ -->
<section class="section pricing" id="pricing">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">पैकेज चुनें</span>
      <h2>अपने अनुसार रुद्राभिषेक पैकेज चुनें</h2>
    </div>
    <p class="monday-dates">📅 सोमवार को विशेष श्रृंगार व पूजा — पूरी जानकारी नीचे "सोमवार स्पेशल पैकेज" सेक्शन में</p>
    <figure class="photo" style="max-width:520px;margin:0 auto 40px;">
      <div class="img-frame" style="aspect-ratio:16/9;">
        <img src="../assets/images/samagri.jpg" alt="पूजा सामग्री — रुद्राक्ष, भस्म, गंगाजल">
      </div>
      <figcaption>पूजा सामग्री — रुद्राक्ष, भस्म, गंगाजल और पंचामृत</figcaption>
    </figure>

    <div class="plans">
      <!-- Basic -->
      <div class="plan">
        <div class="plan-name">बेसिक</div>
        <div class="plan-for">11 लोगों के लिए (सामूहिक)</div>
        <div class="plan-price"><span class="now">₹1,100</span></div>
        <div class="plan-mon">सोमवार को: <b>₹2,100</b></div>
        <ul class="plan-list">
          <li>11 लोगों का सामूहिक रुद्राभिषेक</li>
          <li>पूरी HD वीडियो रिकॉर्डिंग</li>
          <li>प्रसाद किट — रुद्राक्ष, भस्म, प्रसाद, गंगाजल</li>
        </ul>
        <button class="plan-btn" onclick="bookPlan('बेसिक')">🙏 शिव कृपा - Book करें</button>
      </div>

      <!-- Premium -->
      <div class="plan featured">
        <span class="badge">✦ सबसे लोकप्रिय</span>
        <div class="plan-name">प्रीमियम</div>
        <div class="plan-for">5 लोगों के लिए (सामूहिक)</div>
        <div class="plan-price"><span class="now">₹2,100</span></div>
        <div class="plan-mon">सोमवार को: <b>₹3,100</b></div>
        <ul class="plan-list">
          <li>5 लोगों का सामूहिक रुद्राभिषेक</li>
          <li>पूरी HD वीडियो रिकॉर्डिंग</li>
          <li>प्रसाद किट — रुद्राक्ष, भस्म, प्रसाद, गंगाजल</li>
          <li>3 इंच महामृत्युंजय यंत्र</li>
        </ul>
        <button class="plan-btn" onclick="bookPlan('प्रीमियम')">🙏 शिव कृपा - Book करें</button>
      </div>

      <!-- VIP -->
      <div class="plan">
        <div class="plan-name">VIP</div>
        <div class="plan-for">1 व्यक्ति के लिए (सिर्फ आपके लिए)</div>
        <div class="plan-price"><span class="now">₹5,100</span></div>
        <div class="plan-mon">सोमवार को: <b>₹7,100</b></div>
        <ul class="plan-list">
          <li>आपका अकेला व्यक्तिगत रुद्राभिषेक</li>
          <li>पूरी HD वीडियो रिकॉर्डिंग</li>
          <li>प्रसाद किट — रुद्राक्ष, भस्म, प्रसाद, गंगाजल</li>
          <li>5 इंच महामृत्युंजय यंत्र</li>
        </ul>
        <button class="plan-btn" onclick="bookPlan('VIP')">🙏 शिव कृपा - Book करें</button>
      </div>
    </div>
  </div>
</section>

<!-- ============ SOMWAR SPECIAL PACKAGE + CALENDAR ============ -->
<section class="section somwar-section" id="somwar">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">विशेष ऑफर</span>
      <h2>🌙 सोमवार स्पेशल रुद्राभिषेक पैकेज</h2>
    </div>

    <div class="somwar-table">
      <div class="somwar-row somwar-head">
        <span>पैकेज</span>
        <span>सामान्य मूल्य</span>
        <span>सोमवार मूल्य</span>
        <span>अतिरिक्त</span>
      </div>
      <div class="somwar-row">
        <span data-label="पैकेज" class="s-pkg">बेसिक <em>(11 लोग)</em></span>
        <span data-label="सामान्य मूल्य" class="s-normal">₹1,100</span>
        <span data-label="सोमवार मूल्य" class="s-monday">₹2,100 <span class="somwar-badge">सोमवार स्पेशल</span></span>
        <span data-label="अतिरिक्त" class="s-extra">+ ₹1,000</span>
      </div>
      <div class="somwar-row">
        <span data-label="पैकेज" class="s-pkg">प्रीमियम <em>(5 लोग)</em></span>
        <span data-label="सामान्य मूल्य" class="s-normal">₹2,100</span>
        <span data-label="सोमवार मूल्य" class="s-monday">₹3,100 <span class="somwar-badge">सोमवार स्पेशल</span></span>
        <span data-label="अतिरिक्त" class="s-extra">+ ₹1,000</span>
      </div>
      <div class="somwar-row">
        <span data-label="पैकेज" class="s-pkg">VIP <em>(1 व्यक्ति)</em></span>
        <span data-label="सामान्य मूल्य" class="s-normal">₹5,100</span>
        <span data-label="सोमवार मूल्य" class="s-monday">₹7,100 <span class="somwar-badge">सोमवार स्पेशल</span></span>
        <span data-label="अतिरिक्त" class="s-extra">+ ₹2,000</span>
      </div>
    </div>

    <p class="somwar-note">📌 हर सोमवार पर विशेष श्रृंगार, विशेष पूजा अर्चन और विशेष प्रसाद के कारण <b>बेसिक</b> और <b>प्रीमियम</b> पैकेज पर <b>₹1,000</b> और <b>VIP</b> पैकेज पर <b>₹2,000</b> अतिरिक्त लागू होंगे।</p>
    <p class="somwar-timing">⏰ समय: हर सोमवार <b>सुबह 6 बजे से दोपहर 12 बजे तक</b></p>

    <div class="section-head calendar-head">
      <span class="tag">उपलब्धता</span>
      <h3>📅 बुकिंग कैलेंडर व उपलब्धता</h3>
      <p class="calendar-range">30 जुलाई – 28 अगस्त 2026</p>
    </div>

    <div class="urgency-box">
      🔥 सूचना: शुरुआती सोमवार और वीकेंड (1 अगस्त से 10 अगस्त) की बुकिंग लगभग समाप्त होने वाली है!
    </div>

    <div class="calendar-weekdays">
      <span>सोम</span><span>मंगल</span><span>बुध</span><span>गुरु</span><span>शुक्र</span><span>शनि</span><span>रवि</span>
    </div>
    <div class="calendar-month-grid">
      <div class="cal-day empty"></div>
      <div class="cal-day empty"></div>
      <div class="cal-day empty"></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">30</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">31</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-yellow" data-tooltip="Limited slots — Slots jaldi fill ho rahe hain - Book now"><span class="cal-daynum">1</span><span class="cal-day-label">Filling Fast</span></div>
      <div class="cal-day status-yellow" data-tooltip="Limited slots — Slots jaldi fill ho rahe hain - Book now"><span class="cal-daynum">2</span><span class="cal-day-label">Filling Fast</span></div>

      <div class="cal-day status-red" data-tooltip="Only few slots left — Slots jaldi fill ho rahe hain - Book now"><span class="cal-daynum">3</span><span class="cal-day-label">Filling Fast</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">4</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">5</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">6</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">7</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-yellow" data-tooltip="Limited slots — Slots jaldi fill ho rahe hain - Book now"><span class="cal-daynum">8</span><span class="cal-day-label">Filling Fast</span></div>
      <div class="cal-day status-yellow" data-tooltip="Limited slots — Slots jaldi fill ho rahe hain - Book now"><span class="cal-daynum">9</span><span class="cal-day-label">Filling Fast</span></div>

      <div class="cal-day status-red" data-tooltip="Only few slots left — Slots jaldi fill ho rahe hain - Book now"><span class="cal-daynum">10</span><span class="cal-day-label">Filling Fast</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">11</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">12</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">13</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">14</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">15</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">16</span><span class="cal-day-label">✅</span></div>

      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">17</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">18</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">19</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">20</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">21</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">22</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">23</span><span class="cal-day-label">✅</span></div>

      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">24</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">25</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">26</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">27</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day status-normal" data-tooltip="Available - Secure your slot"><span class="cal-daynum">28</span><span class="cal-day-label">✅</span></div>
      <div class="cal-day empty"></div>
      <div class="cal-day empty"></div>
    </div>

    <div class="calendar-legend">
      <span><i class="dot dot-red"></i> Only few slots left</span>
      <span><i class="dot dot-yellow"></i> Limited slots</span>
      <span><i class="dot dot-green"></i> Available</span>
    </div>

    <button class="plan-btn book-slot-btn" onclick="scrollToPricing()">🙏 Book My Slot</button>
  </div>
</section>

<!-- ============ HOW IT WORKS ============ -->
<section class="section" id="how">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">प्रक्रिया</span>
      <h2>🔱 यह कैसे काम करता है?</h2>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step-num">चरण 01</div>
        <div class="step-icon">📝</div>
        <h3>बुकिंग करें</h3>
        <p>नाम, गोत्र, पता डालकर पेमेंट करें।</p>
      </div>
      <div class="step">
        <div class="step-num">चरण 02</div>
        <div class="step-icon">📅</div>
        <h3>समय कन्फर्म होगा</h3>
        <p>WhatsApp पर पूजा का समय बताया जाएगा।</p>
      </div>
      <div class="step">
        <div class="step-num">चरण 03</div>
        <div class="step-icon">🔗</div>
        <h3>Video Link पर संकल्प लें</h3>
        <p>पूजा से 30 मिनट पहले video link मिलेगा, आप live जुड़कर संकल्प लें।</p>
      </div>
      <div class="step">
        <div class="step-num">चरण 04</div>
        <div class="step-icon">🎁</div>
        <h3>वीडियो + प्रसाद पाएँ</h3>
        <p>24 घंटे में HD video और 3–5 दिनों में प्रसाद किट कूरियर।</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ PRASAD KIT ============ -->
<section class="section kit">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">आपके घर पर आएगा</span>
      <h2>🎁 शिव प्रसाद किट में क्या आएगा?</h2>
    </div>
    <div class="kit-grid">
      <div class="kit-item">
        <div class="kit-icon">📿</div>
        <h4>रुद्राक्ष</h4>
        <p>पूजित रुद्राक्ष</p>
      </div>
      <div class="kit-item">
        <div class="kit-icon">🌫️</div>
        <h4>भस्म</h4>
        <p>पवित्र विभूति</p>
      </div>
      <div class="kit-item">
        <div class="kit-icon">🍬</div>
        <h4>प्रसाद</h4>
        <p>पूजा का प्रसाद</p>
      </div>
      <div class="kit-item">
        <div class="kit-icon">💧</div>
        <h4>गंगाजल</h4>
        <p>शुद्ध गंगाजल</p>
      </div>
      <div class="kit-item">
        <div class="kit-icon">🔯</div>
        <h4>महामृत्युंजय यंत्र</h4>
        <p>प्रीमियम में 3", VIP में 5"</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section" id="faq">
  <div class="wrap">
    <div class="section-head">
      <span class="tag">शंका समाधान</span>
      <h2>❓ अक्सर पूछे जाने वाले सवाल</h2>
    </div>
    <div class="faq-list" id="faqList">
      <div class="faq-item">
        <button class="faq-q">
          <span>क्या पूजा सच में मेरे नाम से होगी?</span>
          <span class="plus">+</span>
        </button>
        <div class="faq-a"><div class="faq-a-inner">हाँ, आपका पूरा नाम, गोत्र, पिता/पति का नाम लिया जाएगा।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">
          <span>वीडियो कब मिलेगी?</span>
          <span class="plus">+</span>
        </button>
        <div class="faq-a"><div class="faq-a-inner">पूजा के 24 घंटे में WhatsApp और Email पर भेजी जाएगी।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">
          <span>प्रसाद किट कब तक आएगी?</span>
          <span class="plus">+</span>
        </button>
        <div class="faq-a"><div class="faq-a-inner">3–5 कार्य दिवसों में आपके पते पर कूरियर हो जाएगी।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">
          <span>क्या मैं विदेश से बुक कर सकता हूँ?</span>
          <span class="plus">+</span>
        </button>
        <div class="faq-a"><div class="faq-a-inner">हाँ, online payment और video से किसी भी देश से संभव है।</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">
          <span>सोमवार पर extra charge क्यों?</span>
          <span class="plus">+</span>
        </button>
        <div class="faq-a"><div class="faq-a-inner">विशेष श्रृंगार, विशेष पूजा अर्चन और विशेष प्रसाद के कारण।</div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="final-cta">
  <div class="wrap final-cta-inner">
    <span class="urgency">⏳ सीमित सीटें — पहले आएँ, पहले पाएँ</span>
    <h2>🔱 इस श्रावण महादेव का आशीर्वाद लें</h2>
    <p class="sub">अपने नाम से रुद्राभिषेक करवाएँ — घर बैठे, पूरे विधि-विधान के साथ।</p>
    <div class="cta-row">
      <button class="btn btn-primary" onclick="scrollToPricing()">🙏 शिव कृपा</button>
    </div>
  </div>
</section>

<footer>
  🔱 श्री रुद्राभिषेक सेवा — श्रावण मास 2026 · ॐ नमः शिवाय
</footer>

<!-- ============ STICKY MOBILE BAR ============ -->
<div class="sticky-bar" id="stickyBar">
  <button class="btn btn-primary" onclick="scrollToPricing()">अभी बुक करें</button>
  <a class="btn btn-ghost" href="https://wa.me/910000000000" target="_blank" rel="noopener">WhatsApp</a>
</div>


<!-- Main JavaScript (FAQ accordion, smooth scroll, sticky CTA bar) -->
<script src="assets/js/main.js" defer></script>

</body>
</html>

<style>
/* ==========================================================================
   RUDRA ABHISHEK 2026 — SHRAVAN MAAS LANDING PAGE
   Stylesheet
   ==========================================================================
   Theme: Dark background with gold/saffron spiritual accents
   Font:  Noto Serif Devanagari (headings) + Noto Sans Devanagari (body)
          loaded via Google Fonts CDN — see index.html <head>
   Structure: CSS custom properties (variables) defined in :root, then
              styles are grouped by page section in the same top-to-bottom
              order they appear in index.html. Each section is labelled
              with a comment banner, e.g. /* ==== HERO ==== */
/* ========================================================================== */

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
  }
  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body{
    margin:0;
    background:var(--bg-0);
    color:var(--text-hi);
    font-family:'Noto Sans Devanagari','Noto Sans',sans-serif;
    -webkit-font-smoothing:antialiased;
    overflow-x:hidden;
  }
  h1,h2,h3,.serif{
    font-family:'Noto Serif Devanagari','Noto Serif',serif;
    font-weight:800;
    margin:0;
  }
  p{margin:0;}
  img,svg{display:block;}
  .wrap{
    max-width:1100px;
    margin:0 auto;
    padding:0 24px;
  }
  a{color:inherit;text-decoration:none;}
  ::selection{background:var(--saffron);color:#1a0a02;}

  /* subtle sacred-ash texture overlay */
  .grain{
    position:fixed;
    inset:0;
    pointer-events:none;
    opacity:0.05;
    z-index:1;
    background-image:radial-gradient(circle at 1px 1px, #fff 1px, transparent 0);
    background-size:22px 22px;
  }

  /* ================= HERO ================= */
  .hero{
    position:relative;
    padding:64px 0 80px;
    text-align:center;
    background:
      radial-gradient(ellipse 90% 60% at 50% -10%, rgba(255,122,41,0.18), transparent 60%),
      linear-gradient(180deg, rgba(21,10,5,0.94) 0%, rgba(21,10,5,0.98) 75%, var(--bg-0) 100%),
      url('../images/hero.jpg') center 35%/cover no-repeat;
    overflow:hidden;
    border-bottom:1px solid var(--line);
  }
  .hero::before{
    content:"";
    position:absolute;
    top:-120px;left:50%;
    transform:translateX(-50%);
    width:640px;height:640px;
    background:radial-gradient(circle, rgba(212,175,55,0.28) 0%, rgba(212,175,55,0.06) 45%, transparent 70%);
    filter:blur(6px);
    animation:auraPulse 6s ease-in-out infinite;
    z-index:0;
  }
  @keyframes auraPulse{
    0%,100%{opacity:0.75; transform:translateX(-50%) scale(1);}
    50%{opacity:1; transform:translateX(-50%) scale(1.08);}
  }
  .hero-inner{position:relative;z-index:2;}
  .hero-portrait{
    width:132px;height:132px;
    margin:0 auto 20px;
    border-radius:50%;
    padding:4px;
    background:conic-gradient(from 0deg, var(--gold), var(--saffron), var(--gold-light), var(--gold));
    box-shadow:0 0 32px rgba(242,220,155,0.45);
    animation:auraPulse 6s ease-in-out infinite;
  }
  .hero-portrait .frame{
    width:100%;height:100%;
    border-radius:50%;
    overflow:hidden;
    border:3px solid var(--bg-0);
  }
  .hero-portrait img{
    width:100%;height:100%;
    object-fit:cover;
    display:block;
  }
  .hero-portrait-cap{
    font-size:11.5px;
    color:var(--text-dim);
    text-align:center;
    font-style:italic;
    margin:-10px auto 18px;
  }
  .trishul{
    width:54px;height:54px;
    margin:0 auto 22px;
    color:var(--gold-light);
    filter:drop-shadow(0 0 14px rgba(242,220,155,0.55));
    animation:flicker 3.2s ease-in-out infinite;
  }
  @keyframes flicker{
    0%,100%{opacity:1;}
    45%{opacity:0.82;}
    50%{opacity:1;}
    75%{opacity:0.9;}
  }
  .eyebrow{
    display:inline-block;
    letter-spacing:0.18em;
    font-size:13px;
    color:var(--gold);
    border:1px solid var(--line);
    padding:6px 16px;
    border-radius:999px;
    margin-bottom:22px;
    background:rgba(212,175,55,0.06);
  }
  .hero h1{
    font-size:clamp(30px,5.6vw,54px);
    line-height:1.28;
    color:var(--text-hi);
    text-shadow:0 2px 24px rgba(255,122,41,0.25);
  }
  .hero h1 span{color:var(--saffron);}
  .hero .sub{
    max-width:600px;
    margin:22px auto 0;
    font-size:clamp(15px,2.4vw,19px);
    color:var(--text-mid);
    line-height:1.75;
  }
  .cta-row{
    margin-top:36px;
    display:flex;
    gap:16px;
    justify-content:center;
    flex-wrap:wrap;
  }
  .btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:16px 34px;
    border-radius:12px;
    font-size:17px;
    font-weight:700;
    cursor:pointer;
    border:none;
    transition:transform .18s ease, box-shadow .18s ease;
  }
  .btn:active{transform:scale(0.97);}
  .btn-primary{
    background:linear-gradient(135deg, var(--saffron) 0%, var(--saffron-deep) 100%);
    color:#fff5e8;
    box-shadow:0 10px 30px -8px rgba(255,122,41,0.55);
  }
  .btn-primary:hover{box-shadow:0 14px 34px -6px rgba(255,122,41,0.7);transform:translateY(-2px);}
  .btn-ghost{
    background:#fdf6e8;
    color:#3a1f08;
    box-shadow:0 10px 26px -10px rgba(0,0,0,0.5);
  }
  .btn-ghost:hover{transform:translateY(-2px);}
  .hero-note{
    margin-top:18px;
    font-size:13px;
    color:var(--text-dim);
    letter-spacing:0.02em;
  }

  /* ================ KAILASH MANSAROVAR SECTION ================ */
  .mansarovar-section{
    background:var(--bg-1);
    border-bottom:1px solid var(--line);
    padding:70px 0;
  }
  .mansarovar-inner{
    display:grid;
    grid-template-columns:1.1fr 1fr;
    gap:44px;
    align-items:center;
  }
  .mansarovar-photo .img-frame{box-shadow:0 20px 50px -18px rgba(0,0,0,0.6);}
  .mansarovar-text .tag{
    color:var(--gold);
    font-size:13px;
    letter-spacing:0.16em;
    display:block;
    margin-bottom:10px;
  }
  .mansarovar-text h2{
    font-size:clamp(22px,3.4vw,30px);
    color:var(--text-hi);
    margin-bottom:16px;
  }
  .mansarovar-text p{
    font-size:15px;
    color:var(--text-mid);
    line-height:1.85;
  }
  @media(max-width:900px){
    .mansarovar-inner{grid-template-columns:1fr; gap:26px;}
    .mansarovar-text{text-align:center;}
  }

  /* ================ SOCIAL PROOF BAND ================ */
  .proof{
    background:var(--bg-2);
    border-bottom:1px solid var(--line);
    padding:34px 0;
  }
  .proof-inner{
    display:flex;
    align-items:center;
    gap:20px;
    max-width:800px;
    margin:0 auto;
    text-align:center;
    flex-direction:column;
  }
  .proof h3{
    font-size:clamp(19px,3vw,24px);
    color:var(--gold-light);
  }
  .proof p{
    color:var(--text-mid);
    font-size:15.5px;
    line-height:1.85;
    max-width:640px;
  }
  .diya-divider{
    width:120px;height:2px;
    margin:6px auto 2px;
    background:linear-gradient(90deg, transparent, var(--gold), transparent);
  }

  /* ================ SECTION HEADERS ================ */
  .section{padding:76px 0;}
  .section-head{
    text-align:center;
    margin-bottom:46px;
  }
  .section-head .tag{
    color:var(--gold);
    font-size:13px;
    letter-spacing:0.16em;
    display:block;
    margin-bottom:10px;
  }
  .section-head h2{
    font-size:clamp(24px,4vw,34px);
    color:var(--text-hi);
  }

  /* ================ PHOTO FIGURES (placeholders) ================ */
  figure.photo{
    margin:0;
    position:relative;
  }
  figure.photo .img-frame{
    position:relative;
    border-radius:var(--radius);
    overflow:hidden;
    border:1px solid var(--line);
    box-shadow:0 18px 40px -20px rgba(0,0,0,0.6);
  }
  figure.photo img{
    width:100%;
    height:100%;
    display:block;
    object-fit:cover;
  }
  figure.photo .ph-tag{
    position:absolute;
    top:12px;left:12px;
    background:rgba(21,10,5,0.72);
    border:1px solid var(--line);
    color:var(--gold-light);
    font-size:11px;
    padding:4px 10px;
    border-radius:999px;
    letter-spacing:0.03em;
  }
  figure.photo figcaption{
    margin-top:10px;
    font-size:12.5px;
    color:var(--text-dim);
    text-align:center;
    font-style:italic;
    line-height:1.5;
  }

  /* ================ WHY / REASON SECTION ================ */
  .reason-split{
    display:grid;
    grid-template-columns:0.85fr 1.15fr;
    gap:44px;
    align-items:center;
  }
  .reason-split figure.photo .img-frame{aspect-ratio:4/5;}
  .reason-points{
    display:flex;
    flex-direction:column;
    gap:20px;
  }
  .reason-point{
    display:flex;
    gap:16px;
    align-items:flex-start;
  }
  .reason-point .icon{
    flex-shrink:0;
    width:46px;height:46px;
    border-radius:50%;
    background:rgba(212,175,55,0.10);
    border:1px solid var(--line);
    display:flex;align-items:center;justify-content:center;
    font-size:21px;
  }
  .reason-point h4{
    font-size:16px;
    font-weight:700;
    color:var(--gold-light);
    margin-bottom:4px;
  }
  .reason-point p{
    font-size:13.8px;
    color:var(--text-mid);
    line-height:1.65;
  }

  /* ================ BENEFITS SECTION ================ */
  .benefits{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
  .benefit-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
  }
  .benefit-card{
    background:var(--bg-2);
    border:1px solid var(--line);
    border-radius:var(--radius);
    padding:28px 20px;
    text-align:center;
    transition:transform .2s ease;
  }
  .benefit-card:hover{transform:translateY(-4px);}
  .benefit-icon{
    font-size:28px;
    margin-bottom:14px;
  }
  .benefit-card h4{
    font-size:15.5px;
    font-weight:700;
    color:var(--gold-light);
    margin-bottom:8px;
  }
  .benefit-card p{
    font-size:13px;
    color:var(--text-mid);
    line-height:1.6;
  }

  /* ================ PRICING ================ */
  .pricing{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
  .monday-dates{
    text-align:center;
    color:var(--text-dim);
    font-size:14px;
    margin-bottom:38px;
  }
  .monday-dates b{color:var(--gold-light);font-weight:700;}
  .plans{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px;
    align-items:stretch;
  }
  .plan{
    background:var(--bg-2);
    border:1px solid var(--line);
    border-radius:var(--radius);
    padding:30px 26px 28px;
    display:flex;
    flex-direction:column;
    position:relative;
    transition:transform .2s ease, box-shadow .2s ease;
  }
  .plan:hover{transform:translateY(-6px);}
  .plan.featured{
    border:1px solid var(--gold);
    background:linear-gradient(180deg, rgba(212,175,55,0.10), var(--bg-2) 40%);
    box-shadow:0 20px 50px -20px rgba(212,175,55,0.35);
    order:-1;
  }
  .badge{
    position:absolute;
    top:-13px;left:50%;
    transform:translateX(-50%);
    background:linear-gradient(135deg,var(--gold),#a9832b);
    color:#241205;
    font-size:12.5px;
    font-weight:800;
    padding:6px 16px;
    border-radius:999px;
    letter-spacing:0.03em;
    white-space:nowrap;
  }
  .plan-name{
    font-family:'Noto Serif Devanagari',serif;
    font-weight:800;
    font-size:22px;
    color:var(--gold-light);
    margin-bottom:4px;
  }
  .plan-for{
    color:var(--text-dim);
    font-size:13.5px;
    margin-bottom:18px;
  }
  .plan-price{
    display:flex;
    align-items:baseline;
    gap:10px;
    margin-bottom:4px;
  }
  .plan-price .now{
    font-size:32px;
    font-weight:800;
    color:var(--text-hi);
  }
  .plan-mon{
    font-size:12.5px;
    color:var(--text-dim);
    margin-bottom:20px;
  }
  .plan-mon b{color:var(--saffron);font-weight:700;}
  .plan-list{
    list-style:none;
    padding:0;margin:0 0 26px;
    display:flex;
    flex-direction:column;
    gap:11px;
    flex-grow:1;
  }
  .plan-list li{
    font-size:14.5px;
    color:var(--text-mid);
    line-height:1.6;
    display:flex;
    gap:9px;
  }
  .plan-list li::before{
    content:"卐";
    content:"◆";
    color:var(--gold);
    font-size:10px;
    margin-top:5px;
    flex-shrink:0;
  }
  .plan-btn{
    width:100%;
    text-align:center;
    padding:17px 18px;
    border-radius:12px;
    font-weight:800;
    font-size:16.5px;
    letter-spacing:0.01em;
    cursor:pointer;
    border:none;
    background:linear-gradient(135deg, #FFE580 0%, #FFD700 45%, #E8B800 100%);
    color:#2b1704;
    box-shadow:0 10px 26px -8px rgba(255,215,0,0.55);
    transition:transform .2s ease, box-shadow .25s ease, filter .2s ease;
  }
  .plan-btn:hover{
    transform:translateY(-3px) scale(1.015);
    box-shadow:0 0 0 3px rgba(255,215,0,0.18), 0 0 26px 4px rgba(255,215,0,0.75), 0 14px 30px -8px rgba(255,215,0,0.6);
    filter:brightness(1.05);
  }
  .plan-btn:active{transform:translateY(-1px) scale(0.99);}

  /* ================ SOMWAR SPECIAL + CALENDAR ================ */
  .somwar-section{background:var(--bg-1); border-top:1px solid var(--line); border-bottom:1px solid var(--line); overflow:hidden;}
  .somwar-table{
    display:flex;
    flex-direction:column;
    gap:2px;
    background:var(--line);
    border-radius:var(--radius);
    overflow:hidden;
    border:1px solid var(--line);
    max-width:840px;
    margin:0 auto 30px;
  }
  .somwar-row{
    display:grid;
    grid-template-columns:1.3fr 1fr 1.5fr 1fr;
    gap:10px;
    align-items:center;
    background:var(--bg-2);
    padding:16px 20px;
  }
  .somwar-row.somwar-head{
    background:rgba(212,175,55,0.12);
    font-size:12.5px;
    letter-spacing:0.04em;
    color:var(--gold);
    font-weight:700;
    padding:12px 20px;
  }
  .somwar-row .s-pkg{font-weight:700; color:var(--text-hi); font-size:15px;}
  .somwar-row .s-pkg em{font-style:normal; color:var(--text-dim); font-size:12.5px; display:block;}
  .somwar-row .s-normal{color:var(--text-mid); font-size:14.5px; text-decoration:line-through; opacity:0.75;}
  .somwar-row .s-monday{color:var(--gold-light); font-weight:800; font-size:16px; display:flex; align-items:center; gap:8px; flex-wrap:wrap;}
  .somwar-row .s-extra{color:var(--saffron); font-weight:700; font-size:14.5px;}
  .somwar-badge{
    display:inline-block;
    background:linear-gradient(135deg,#FFE580,#FFD700 60%,#E8B800);
    color:#2b1704;
    font-size:10.5px;
    font-weight:800;
    padding:3px 9px;
    border-radius:999px;
    letter-spacing:0.02em;
    white-space:nowrap;
  }
  .somwar-note{
    max-width:700px;
    margin:0 auto 14px;
    text-align:center;
    font-size:13.8px;
    color:var(--text-mid);
    line-height:1.75;
  }
  .somwar-timing{
    text-align:center;
    font-size:14.5px;
    color:var(--gold-light);
    margin-bottom:50px;
  }
  .calendar-head{margin-bottom:18px;}
  .calendar-range{
    text-align:center;
    color:var(--text-dim);
    font-size:13.5px;
    margin-top:6px;
  }
  .urgency-box{
    max-width:720px;
    margin:0 auto 34px;
    text-align:center;
    background:linear-gradient(135deg, rgba(255,215,0,0.14), rgba(255,122,41,0.10));
    border:1px solid rgba(255,215,0,0.45);
    border-radius:14px;
    padding:16px 22px;
    color:var(--gold-light);
    font-weight:700;
    font-size:14.5px;
    line-height:1.7;
    box-shadow:0 0 24px rgba(255,215,0,0.18);
  }
  .calendar-weekdays{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:6px;
    max-width:640px;
    margin:0 auto 8px;
    text-align:center;
    font-size:11.5px;
    color:var(--gold-dim);
    letter-spacing:0.02em;
  }
  .calendar-month-grid{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:6px;
    max-width:640px;
    margin:0 auto 22px;
  }
  .cal-day{
    position:relative;
    aspect-ratio:1/1;
    border-radius:10px;
    background:var(--bg-2);
    border:1px solid var(--line);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:2px;
    padding:4px 2px;
  }
  .cal-day.empty{visibility:hidden;}
  .cal-daynum{
    font-family:'Noto Serif Devanagari',serif;
    font-weight:700;
    font-size:14px;
    color:var(--text-hi);
  }
  .cal-day-label{
    font-size:8px;
    line-height:1.2;
    text-align:center;
    color:var(--text-dim);
  }
  .cal-day.status-normal .cal-day-label{color:#6fdc8c; font-size:11px;}
  .cal-day.status-yellow{
    background:linear-gradient(160deg, rgba(255,207,77,0.28), rgba(255,207,77,0.10));
    border-color:#ffcf4d;
    animation:yellowGlow 2.2s ease-in-out infinite;
  }
  @keyframes yellowGlow{
    0%,100%{box-shadow:0 0 10px rgba(255,207,77,0.45);}
    50%{box-shadow:0 0 20px rgba(255,207,77,0.8);}
  }
  .cal-day.status-yellow .cal-daynum{color:#ffe38a;}
  .cal-day.status-yellow .cal-day-label{color:#3a2a06; background:#ffcf4d; border-radius:5px; padding:1px 3px; font-weight:800; font-size:7.8px;}
  .cal-day.status-red{
    background:linear-gradient(160deg, rgba(255,120,40,0.35), rgba(198,43,31,0.18));
    border-color:#FFD700;
    box-shadow:0 0 14px rgba(255,80,50,0.45), 0 0 0 1px rgba(255,215,0,0.25) inset;
    animation:redGlow 2.2s ease-in-out infinite;
  }
  @keyframes redGlow{
    0%,100%{box-shadow:0 0 12px rgba(255,80,50,0.45), 0 0 6px rgba(255,215,0,0.3);}
    50%{box-shadow:0 0 24px rgba(255,80,50,0.85), 0 0 14px rgba(255,215,0,0.6);}
  }
  .cal-day.status-red .cal-daynum{color:#ffe9b0;}
  .cal-day.status-red .cal-day-label{color:#2b1704; background:linear-gradient(135deg,#FFE580,#FFD700); border-radius:5px; padding:1px 3px; font-weight:800; font-size:7.8px;}
  /* custom hover tooltip for all dates */
  .cal-day[data-tooltip]{cursor:default;}
  .cal-day[data-tooltip]::after{
    content:attr(data-tooltip);
    position:absolute;
    bottom:calc(100% + 8px);
    left:50%;
    transform:translateX(-50%) translateY(4px);
    background:#1a0f08;
    border:1px solid var(--gold-dim);
    color:var(--text-hi);
    font-size:11px;
    line-height:1.5;
    padding:8px 12px;
    border-radius:8px;
    white-space:normal;
    width:170px;
    text-align:center;
    opacity:0;
    pointer-events:none;
    transition:opacity .2s ease, transform .2s ease;
    z-index:5;
    box-shadow:0 10px 24px -8px rgba(0,0,0,0.6);
  }
  .cal-day[data-tooltip]:hover::after{opacity:1; transform:translateX(-50%) translateY(0);}
  .calendar-legend{
    display:flex;
    justify-content:center;
    gap:22px;
    flex-wrap:wrap;
    margin-bottom:34px;
    font-size:12.5px;
    color:var(--text-mid);
  }
  .calendar-legend .dot{
    display:inline-block;
    width:9px;height:9px;
    border-radius:50%;
    margin-right:6px;
  }
  .dot-red{background:#ff5b3d;}
  .dot-yellow{background:#ffcf4d;}
  .dot-green{background:#6fdc8c;}
  .book-slot-btn{
    display:block;
    max-width:340px;
    margin:0 auto;
    font-size:17.5px;
    padding:19px 20px;
  }

  /* ================ HOW IT WORKS ================ */
  .steps{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
  }
  .step{
    position:relative;
    padding:28px 20px 24px;
    border:1px solid var(--line);
    border-radius:var(--radius);
    background:var(--bg-2);
    text-align:center;
  }
  .step-num{
    font-family:'Noto Serif Devanagari',serif;
    font-size:13px;
    color:var(--gold-dim);
    letter-spacing:0.1em;
    margin-bottom:10px;
  }
  .step-icon{font-size:30px;margin-bottom:12px;}
  .step h3{
    font-size:16.5px;
    color:var(--text-hi);
    margin-bottom:8px;
    font-weight:700;
  }
  .step p{
    font-size:13.6px;
    color:var(--text-mid);
    line-height:1.65;
  }
  .step-connector{
    display:none;
  }
  @media(min-width:769px){
    .steps{position:relative;}
    .steps::before{
      content:"";
      position:absolute;
      top:64px;left:12%;right:12%;
      height:1px;
      background:repeating-linear-gradient(90deg, var(--gold-dim) 0 8px, transparent 8px 16px);
      opacity:0.5;
      z-index:0;
    }
    .step{z-index:1;}
  }

  /* ================ PRASAD KIT ================ */
  .kit{background:var(--bg-1);border-top:1px solid var(--line);border-bottom:1px solid var(--line);}
  .kit-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:18px;
  }
  .kit-item{
    text-align:center;
    padding:26px 12px;
    border:1px solid var(--line);
    border-radius:var(--radius);
    background:var(--bg-2);
  }
  .kit-icon{
    font-size:30px;
    margin-bottom:10px;
  }
  .kit-item h4{
    font-size:14.5px;
    font-weight:700;
    color:var(--gold-light);
    margin-bottom:5px;
  }
  .kit-item p{
    font-size:12.5px;
    color:var(--text-dim);
    line-height:1.5;
  }

  /* ================ FAQ ================ */
  .faq-list{
    max-width:760px;
    margin:0 auto;
    display:flex;
    flex-direction:column;
    gap:12px;
  }
  .faq-item{
    border:1px solid var(--line);
    border-radius:12px;
    background:var(--bg-2);
    overflow:hidden;
  }
  .faq-q{
    width:100%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:14px;
    padding:18px 22px;
    background:none;
    border:none;
    color:var(--text-hi);
    font-family:inherit;
    font-size:15.5px;
    font-weight:700;
    text-align:right;
    cursor:pointer;
  }
  .faq-q .plus{
    flex-shrink:0;
    width:22px;height:22px;
    border-radius:50%;
    border:1px solid var(--gold-dim);
    color:var(--gold-light);
    display:flex;align-items:center;justify-content:center;
    font-size:16px;
    transition:transform .25s ease;
  }
  .faq-item.open .plus{transform:rotate(45deg);}
  .faq-a{
    max-height:0;
    overflow:hidden;
    transition:max-height .28s ease;
  }
  .faq-a-inner{
    padding:0 22px 20px;
    color:var(--text-mid);
    font-size:14.5px;
    line-height:1.75;
  }

  /* ================ FINAL CTA ================ */
  .final-cta{
    position:relative;
    padding:90px 0 96px;
    text-align:center;
    background:
      radial-gradient(ellipse 70% 80% at 50% 110%, rgba(255,122,41,0.22), transparent 60%),
      linear-gradient(180deg, var(--bg-0), var(--bg-1));
    overflow:hidden;
  }
  .final-cta::before{
    content:"";
    position:absolute;
    bottom:-160px;left:50%;
    transform:translateX(-50%);
    width:560px;height:560px;
    background:radial-gradient(circle, rgba(212,175,55,0.22), transparent 65%);
    animation:auraPulse 7s ease-in-out infinite;
  }
  .final-cta-inner{position:relative;z-index:2;}
  .urgency{
    display:inline-block;
    background:rgba(255,122,41,0.14);
    border:1px solid rgba(255,122,41,0.4);
    color:var(--saffron);
    font-size:13px;
    font-weight:700;
    padding:7px 18px;
    border-radius:999px;
    margin-bottom:24px;
  }
  .final-cta h2{
    font-size:clamp(26px,4.6vw,40px);
    color:var(--text-hi);
    margin-bottom:14px;
  }
  .final-cta .sub{
    color:var(--text-mid);
    font-size:15.5px;
    margin-bottom:34px;
  }

  footer{
    padding:30px 0 110px;
    text-align:center;
    color:var(--text-dim);
    font-size:12.5px;
    border-top:1px solid var(--line);
  }
  @media(max-width:768px){footer{padding-bottom:96px;}}

  /* sticky mobile bar */
  .sticky-bar{
    position:fixed;
    bottom:0;left:0;right:0;
    z-index:50;
    display:none;
    gap:10px;
    padding:12px 16px calc(12px + env(safe-area-inset-bottom));
    background:rgba(21,10,5,0.92);
    backdrop-filter:blur(10px);
    border-top:1px solid var(--line);
    transform:translateY(100%);
    transition:transform .3s ease;
  }
  .sticky-bar.show{transform:translateY(0);}
  .sticky-bar .btn{flex:1;padding:13px 10px;font-size:14.5px;justify-content:center;}

  /* ================ RESPONSIVE ================ */
  @media(max-width:900px){
    .plans{grid-template-columns:1fr;}
    .plan.featured{order:0;}
    .steps{grid-template-columns:1fr 1fr;}
    .kit-grid{grid-template-columns:repeat(3,1fr);}
    .reason-split{grid-template-columns:1fr;}
    .reason-split figure.photo{max-width:420px;margin:0 auto 8px;}
    .reason-split figure.photo .img-frame{aspect-ratio:16/10;}
    .benefit-grid{grid-template-columns:repeat(2,1fr);}
  }
  @media(max-width:700px){
    .somwar-row{grid-template-columns:1fr; gap:10px; text-align:center;}
    .somwar-row.somwar-head{display:none;}
    .somwar-row:not(.somwar-head){border-radius:10px; margin-bottom:2px; padding:20px;}
    .somwar-row span[data-label]::before{content:attr(data-label); display:block; font-size:10.5px; color:var(--gold-dim); letter-spacing:0.04em; margin-bottom:4px; font-weight:600;}
    .somwar-row .s-pkg{font-size:16px;}
    .somwar-row .s-monday{justify-content:center;}
  }
  @media(max-width:600px){
    .steps{grid-template-columns:1fr;}
    .kit-grid{grid-template-columns:repeat(2,1fr);}
    .benefit-grid{grid-template-columns:1fr;}
    .sticky-bar{display:flex;}
    .section{padding:56px 0;}
    .hero{padding:52px 0 64px;}
    .proof-inner{padding:0 4px;}
    .calendar-weekdays, .calendar-month-grid{gap:4px;}
    .cal-daynum{font-size:12px;}
    .cal-day-label{font-size:6.5px;}
    .cal-day.status-normal .cal-day-label{font-size:9px;}
    .cal-day.status-red .cal-day-label, .cal-day.status-yellow .cal-day-label{font-size:6.2px; padding:1px 2px;}
    .cal-day[data-tooltip]::after{width:130px; font-size:10px;}
    .calendar-legend{gap:14px; font-size:11.5px;}
  }

  @media (prefers-reduced-motion: reduce){
    *{animation:none !important; transition:none !important;}
  }
</style>