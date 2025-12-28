<?php
/**
 * capsule_lg_2008.php
 *
 * Single-file PHP port of the 2008 steampowered.com "large capsule" Flash rotator.
 * Drop this file next to your assets, and feed it FlashVar-like GET params:
 *   img1, txt1, url1, fullurl1, price1, oldprice1, discount1, ... up to 9
 *
 * Example:
 *   capsule_lg_2008.php?img1=/capsules/gta4.jpg&txt1=Grand+Theft+Auto+IV&price1=%2449.99&url1=/app/12210
 *
 * Notes:
 * - Visual layout fixed to 481x238 to match the original SWF capsule.
 * - Behavior mirrors the SWF: hover previews, click-through, auto-rotate, pager.
 */

header('Content-Type: text/html; charset=utf-8');

function g($k, $default = '') {
    return isset($_GET[$k]) ? (string)$_GET[$k] : $default;
}

$max = 9;
$slides = [];
for ($i=1; $i<=$max; $i++) {
    $img = g("img$i");
    $txt = g("txt$i");
    $url = g("url$i");
    $full = g("fullurl$i");
    $price = g("price$i");
    $oldprice = g("oldprice$i");
    $discount = g("discount$i");
    if ($img === '' && $txt === '' && $url === '' && $full === '' && $price === '' && $oldprice === '' && $discount === '') {
        continue;
    }
    // Flash-era escaping quirks used by Valve's generator for this SWF:
    // "@#153;" => ™, and lone '@' => '&'
    $txt = str_replace("@#153;", "™", $txt);
    $txt = str_replace("@", "&", $txt);

    $slides[] = [
        'id' => $i,
        'img' => $img,
        'txt' => $txt,
        'url' => $url,
        'fullurl' => $full,
        'price' => $price,
        'oldprice' => $oldprice,
        'discount' => $discount,
    ];
}

if (count($slides) === 0) {
    $slides = [
        [
            'id' => 1,
            'img' => '/capsules/game1.jpg',
            'txt' => 'Demo Item One™',
            'url' => '#',
            'fullurl' => '',
            'price' => '$49.99',
            'oldprice' => '',
            'discount' => '',
        ],
        [
            'id' => 2,
            'img' => '/capsules/game2.jpg',
            'txt' => 'Demo Item Two™',
            'url' => '#',
            'fullurl' => '',
            'price' => '$19.99',
            'oldprice' => '$29.99',
            'discount' => '',
        ],
        [
            'id' => 3,
            'img' => '/capsules/game3.jpg',
            'txt' => 'Demo Item Three™',
            'url' => '#',
            'fullurl' => '',
            'price' => '$9.99',
            'oldprice' => '',
            'discount' => '',
        ],
    ];
}

$data_json = json_encode($slides, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>2008 Large Capsule</title>
<style>
html, body, .capsule {
    font-family: Arial, Helvetica, sans-serif;
}

  /* Fixed 1:1 geometry (matches the original SWF screenshot: 481x238) */
  :root{
    --W: 467px;
    --H: 225px;
    --IMG_H: 175px;          /* total image region height (includes top border) */
    --BORDER: 5px;           /* top/side border thickness around image */
    --LINE: 1px;             /* separator line under image */
    --BOTTOM_H: 49px;        /* space under the line */
    --BG: #4A4945;           /* main grey background */
    --LINE_COLOR: #CECBC3;   /* 1px line color */
  }

  /* Do NOT let the browser "help" with subpixel rounding. */
  *{ box-sizing:border-box; }

  body{
    margin:0;
    background:#111;
    font-family: Arial, Helvetica, sans-serif;
  }

  .capsule{
    width:var(--W);
    height:var(--H);
    position:relative;
    overflow:hidden;

   background: var(--BG);
  }

  /* Top image stage */
  .stage{
    position:absolute;
    left:0; top:0;
    width:var(--W);
    height:var(--IMG_H);
    overflow:hidden;
    background:transparent;
    border-top:var(--BORDER) solid var(--BG);
    border-left:var(--BORDER) solid var(--BG);
    border-right:var(--BORDER) solid var(--BG);
    border-bottom:none;
    cursor:pointer;
  }

  .imgB{
    position:absolute;
    left:0; top:0;
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
    transform: translate(0, 0);
  }

  /* Fade overlay approximating DefineSprite_25 alpha ramp */
  .fadeOverlay{
    position:absolute;
    left:0; top:0;
    width:100%; height:100%;
    background:#000;
    opacity:0;
    pointer-events:none;
    transition: opacity 220ms linear;
  }
  .fadeOverlay.on{ opacity:1; }

  
  .underLine{
    position:absolute;
    left:var(--BORDER);
    top:var(--IMG_H);
    width:calc(var(--W) - (var(--BORDER) * 2));
    height:var(--LINE);
    background:var(--LINE_COLOR);
  }

  .bottom{
    position:absolute;
    left:0;
    top:calc(var(--IMG_H) + var(--LINE));
    width:var(--W);
    height:var(--BOTTOM_H);
    background:var(--BG);
  }

  .pager{
    position:absolute;
    left:var(--BORDER);      /* 5px in, aligned to inside of image border */
    top:0px;                 /* 1px below the line already, since bottom starts after line */
    display:flex;
    gap:2px;                 /* 2px spacing between squares */
    align-items:flex-start;
  }

  .pgBtn{
    position:relative;
    width:27px;              /* exact */
    height:14px;             /* exact */
    padding:0;
    margin:0;
    border:none;
    background:transparent;
    user-select:none;
    cursor:pointer;
  }
.pgBtn::before{
    content:'';
    position:absolute;
    left:0;
    top:0;
    width:27px;
    height:14px;
    background:#2F3030;   /* FORCE correct unselected color */
}
  /* use the provided art, but size it to the exact required dimensions */
.pgBtn.art::before{
    background-color:#2F3030; /* keep correct color */
    background-image:url("data:image/png;base64,....");
    background-repeat:no-repeat;
    background-position:0 0;
    background-size:27px 14px;
}
.pgBtn.active::before,
.pgBtn.hovered::before{
    width:27px;
    height:16px;
    background-color:#CECBC3;
    background-image:url("data:image/png;base64,....");
    background-size:27px 16px;
}


  .title{
    position:absolute;
    left:7px;                /* 7px from left edge */
    bottom:15px;             /* bottom of text 15px from bottom area */
    font-size:16px;
    line-height:16px;
    color:#d9d9d9;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
    right:140px;
  }

  .priceBox{
    position:absolute;
    right:7px;               /* last decimal no closer than 7px */
   top:3px;
    display:flex;
    gap:8px;
    align-items:baseline;
    font-size:6px;          /* approximates 6x8-ish in typical rendering */
    line-height:0px;
    color:#e6e6e6;
  }
  .oldPrice{
    color:#8c8c8c;
    text-decoration:line-through;
  }
  .discount{
    color:#b6d9ff;
  }


  .info{
    position:absolute;
    left:0;
    top:calc(var(--IMG_H) + var(--PAGER_H));
    width:var(--W);
    height:var(--INFO_H);
    background:#555555;
    border-top:1px solid #6a6a6a;
  }

.title{
    position:absolute;
    left:4px;
    bottom:14px;
    right:140px;

    font-family: Arial, Helvetica, sans-serif;
    font-size:11px;
    line-height:10px;
    font-weight:normal;

    color:#cfcbc2; /* alpha ignored by CSS, this is correct visual match */
    text-align:left;

    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.priceBox{
    position:absolute;
    right:7px;
    top:3px;

    font-family: Arial, Helvetica, sans-serif;
    font-size:18px;              /* browser minimum */
    line-height:18px;
    font-weight:normal;

    color:#cfcbc2;

    transform: scale(0.625);    /* 5 / 8 = 0.625 */
    transform-origin: right top;

    display:flex;
    gap:6px;
    align-items:baseline;
}

.oldPrice{
    color:# ffcfcbc2;
    text-decoration:line-through;
}

.discount{
    color:#ff666666;
}


  /* Invisible hit regions like Flash buttons: stage + pager buttons */
  .hit{
    position:absolute;
    left:0; top:0;
    width:100%; height:100%;
  }
</style>
</head>
<body>
<div class="capsule" id="capsule">
  <div class="stage" id="stage" title="">
    <img class="imgB" id="imgB" alt="" style="opacity:0">
    <div class="fadeOverlay" id="fade"></div>
    <div class="hit" id="stageHit"></div>
  </div>

  <div class="underLine"></div>

  <div class="bottom">
    <div class="pager" id="pager"></div>
    <div class="title" id="title"></div>
    <div class="priceBox">
      <div class="discount" id="discount"></div>
      <div class="oldPrice" id="oldprice"></div>
      <div class="price" id="price"></div>
    </div>
  </div>
</div>
</div>

<script>
(() => {
  // Data from PHP (FlashVars equivalent)
  const SLIDES = <?php echo $data_json; ?>;

  // Original timing vibe: slow rotate, quick hover.
  const ROTATE_MS = 6000;

  const stage = document.getElementById('stage');
  const imgB  = document.getElementById('imgB');
  const fade  = document.getElementById('fade');
  const pager = document.getElementById('pager');

  const title = document.getElementById('title');
  const price = document.getElementById('price');
  const oldp  = document.getElementById('oldprice');
  const disc  = document.getElementById('discount');

  let cur = 0;
  let hover = null;
  let rotating = null;
  let frontIsA = true;

  function buildPager() {
    pager.innerHTML = '';
    SLIDES.forEach((s, idx) => {
      const b = document.createElement('div');
      b.className = 'pgBtn art' + (idx === cur ? ' active' : '');
      b.textContent = String(idx + 1);
      b.dataset.idx = String(idx);

      // Flash behavior: rollOver previews that slide, release commits it.
      b.addEventListener('mouseenter', () => ovr(idx));
      b.addEventListener('mouseleave', () => out());
      b.addEventListener('click', () => hit(idx, true));

      pager.appendChild(b);
    });
  }

  function setInfo(s) {
    title.textContent = s.txt || '';
    price.textContent = s.price || '';
    oldp.textContent  = s.oldprice || '';
    disc.textContent  = s.discount || '';
  }

  function setActivePager(idx) {
    [...pager.children].forEach((el, i) => {
      el.classList.toggle('active', i === idx);
    });
  }

  function swapTo(idx, commit=true) {
    idx = Math.max(0, Math.min(SLIDES.length - 1, idx));
    const s = SLIDES[idx];

    // Fade like the SWF overlay sprite
    fade.classList.add('on');
    // At peak black, swap image, then fade out.
    window.setTimeout(() => {
      const nextImg = s.img || '';
      const front = imgB;
      const back  = imgB

      back.src = nextImg;
      back.style.opacity = '1';
      front.style.opacity = '0';
      frontIsA = !frontIsA;

      setInfo(s);
      stage.title = s.txt || '';

      window.setTimeout(() => fade.classList.remove('on'), 40);
    }, 120);

    if (commit) {
      cur = idx;
      setActivePager(cur);
    }
  }

  // Flash function names, because you wanted “1:1”.
  function ovr(idx) {
    hover = idx;
    swapTo(idx, false);
  }

  function out() {
    hover = null;
    swapTo(cur, false);
  }

  function go() {
    const s = SLIDES[cur];
    const target = (s.fullurl && s.fullurl.length) ? s.fullurl : s.url;
    if (target && target !== '#') window.location.href = target;
  }

  function hit(idx, fromPager) {
    // Commit chosen slide
    swapTo(idx, true);
    restartRotate();
  }

  function next() {
    const n = (cur + 1) % SLIDES.length;
    swapTo(n, true);
  }

  function restartRotate() {
    if (rotating) window.clearInterval(rotating);
    if (SLIDES.length > 1) {
      rotating = window.setInterval(() => {
        // If user is hovering previews, don't fight them.
        if (hover === null) next();
      }, ROTATE_MS);
    }
  }

  // Stage hit region
  stage.addEventListener('mouseenter', () => ovr(cur));
  stage.addEventListener('mouseleave', () => out());
  stage.addEventListener('click', () => go());

  // Init
  // Load first image
  const first = SLIDES[0];
  imgB.src = first.img || '';
  setInfo(first);
  buildPager();
  restartRotate();
})();
</script>
</body>
</html>
