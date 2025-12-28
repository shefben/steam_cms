<?php
/**
 * Single Large Capsule (2008/2009/2010 themes)
 * PHP adaptation of the 2008 capsule_lg.php that loads app data from database
 * Visual style matches the original 2008 SWF capsule (481x238, grey background)
 * Supports up to 12 entries per theme with appid, image_path, description, url
 * Title and price are looked up from store_apps table
 * PHP >= 7.4
 */

declare(strict_types=1);

// Include CMS functions
require_once __DIR__ . '/functions.php';

// Get theme from URL parameter or use default
$theme = $_GET['theme'] ?? cms_get_setting('theme', '2008');

// Get database connection
$db = cms_get_db();

// Load single large capsule data from database
$stmt = $db->prepare('
    SELECT
        slc.id,
        slc.appid,
        slc.image_path,
        slc.description,
        slc.url,
        a.name AS title,
        a.price,
        a.discount_percent,
        a.original_price
    FROM single_large_capsule slc
    LEFT JOIN store_apps a ON slc.appid = a.appid
    WHERE slc.theme = ?
    ORDER BY slc.`order` ASC
    LIMIT 12
');
$stmt->execute([$theme]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)) {
    http_response_code(404);
    echo 'No capsule entries found for this theme';
    return;
}

// Build slides array matching the 2008 SWF FlashVars format
$slides = [];
foreach ($rows as $i => $row) {
    // Use the URL from the database, or fallback to game page if appid is set
    $url = $row['url'];
    if (empty($url) && $row['appid']) {
        $url = "index.php?area=game&AppId={$row['appid']}";
    }

    // Build image path - check if it's absolute or relative
    $imgPath = $row['image_path'];
    if ($imgPath && strpos($imgPath, 'http') !== 0 && strpos($imgPath, '/') !== 0) {
        $imgPath = '../storefront/images/capsules/' . $imgPath;
    }

    // Format price
    $price = '';
    if ($row['price'] !== null) {
        $price = '$' . number_format((float)$row['price'], 2);
    }

    // Format old price and discount if available
    $oldPrice = '';
    $discount = '';
    if (!empty($row['original_price']) && $row['original_price'] > $row['price']) {
        $oldPrice = '$' . number_format((float)$row['original_price'], 2);
    }
    if (!empty($row['discount_percent']) && $row['discount_percent'] > 0) {
        $discount = '-' . (int)$row['discount_percent'] . '%';
    }

    $slides[] = [
        'id'       => $i + 1,
        'img'      => $imgPath,
        'txt'      => $row['title'] ?: 'Unknown Game',
        'url'      => $url ?: '#',
        'fullurl'  => '',
        'price'    => $price,
        'oldprice' => $oldPrice,
        'discount' => $discount,
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
    left:var(--BORDER);
    top:0px;
    display:flex;
    gap:2px;
    align-items:flex-start;
  }

  .pgBtn{
    position:relative;
    width:27px;
    height:14px;
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
    background:#2F3030;
  }

  .pgBtn.active::before,
  .pgBtn.hovered::before{
    width:27px;
    height:16px;
    background-color:#CECBC3;
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
    color:#cfcbc2;
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
    font-size:18px;
    line-height:18px;
    font-weight:normal;
    color:#cfcbc2;
    transform: scale(0.625);
    transform-origin: right top;
    display:flex;
    gap:6px;
    align-items:baseline;
  }

  .oldPrice{
    color:#8c8c8c;
    text-decoration:line-through;
  }

  .discount{
    color:#b6d9ff;
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
      b.className = 'pgBtn' + (idx === cur ? ' active' : '');
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

      imgB.src = nextImg;
      imgB.style.opacity = '1';

      setInfo(s);
      stage.title = s.txt || '';

      window.setTimeout(() => fade.classList.remove('on'), 40);
    }, 120);

    if (commit) {
      cur = idx;
      setActivePager(cur);
    }
  }

  // Flash function names
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
    if (target && target !== '#') window.parent.location.href = target;
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
  if (SLIDES.length > 0) {
    const first = SLIDES[0];
    imgB.src = first.img || '';
    imgB.style.opacity = '1';
    setInfo(first);
    buildPager();
    restartRotate();
  }
})();
</script>
</body>
</html>
