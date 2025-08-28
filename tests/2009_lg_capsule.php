<?php
// Auto-generated SWF clone: cycles through extracted assets at a fixed interval.
// This aims to be pixel-aligned to the SWF stage and use the same background color.
$assets = glob(__DIR__ . '/assets/*.{png,jpg,jpeg,gif}', GLOB_BRACE);
natsort($assets); // natural order by filename/id
$assets = array_values($assets);

// Read manifest for dimensions + bg color
$manifest_path = __DIR__ . '/manifest.json';
$width = 0; $height = 0; $bg = '#000';
$fps = 12;
if (file_exists($manifest_path)) {
  $man = json_decode(file_get_contents($manifest_path), true);
  if (isset($man['stage_width_px'])) $width = intval(round($man['stage_width_px']));
  if (isset($man['stage_height_px'])) $height = intval(round($man['stage_height_px']));
  if (isset($man['background_rgb']) && is_array($man['background_rgb'])) {
    $bg = sprintf('#%02x%02x%02x', $man['background_rgb'][0], $man['background_rgb'][1], $man['background_rgb'][2]);
  }
  if (isset($man['frame_rate'])) $fps = floatval($man['frame_rate']);
}
if ($width <= 0) $width = 468; // fallback
if ($height <= 0) $height = 60;  // fallback

// Timing: approximate slide duration as 3 seconds or nearest multiple of frame time
$frame_time_ms = intval(round(1000.0 / max($fps, 1.0)));
$slide_ms = max(1000, intval(round(3000.0 / $frame_time_ms)) * $frame_time_ms);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SWF Clone</title>
<style>
  html, body { margin:0; padding:0; background: #000; }
  .stage {
    position: relative;
    width: <?php echo $width; ?>px;
    height: <?php echo $height; ?>px;
    background: <?php echo $bg; ?>;
    overflow: hidden;
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
  }
  .stage img {
    position: absolute;
    top: 0; left: 0;
    width: <?php echo $width; ?>px;
    height: <?php echo $height; ?>px;
    display: block;
    /* exact pixel scaling; avoid subpixel smoothing */
  }
  .slide { opacity: 0; }
  .slide.active { opacity: 1; }
  .fade {
    transition: opacity <?php echo max(100, intval($frame_time_ms*6)); ?>ms linear;
  }
  .nav {
    position:absolute; bottom:4px; right:6px; display:flex; gap:4px;
  }
  .dot {
    width:8px; height:8px; border:1px solid #fff; border-radius:8px; background:transparent; cursor:pointer;
  }
  .dot.active { background:#fff; }
</style>
</head>
<body>
<div class="stage" id="stage">
<?php foreach ($assets as $i => $path): $url = 'assets/'.basename($path); ?>
  <img class="slide fade<?php echo $i===0 ? ' active' : ''; ?>" src="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" alt="slide-<?php echo $i; ?>">
<?php endforeach; ?>
  <div class="nav" id="nav">
  <?php for ($i=0; $i<count($assets); $i++): ?>
    <div class="dot<?php echo $i===0 ? ' active' : ''; ?>" data-idx="<?php echo $i; ?>"></div>
  <?php endfor; ?>
  </div>
</div>
<script>
(function(){
  const slides = Array.from(document.querySelectorAll('.slide'));
  const dots = Array.from(document.querySelectorAll('.dot'));
  if (slides.length === 0) return;
  let idx = 0;
  const SLIDE_MS = <?php echo $slide_ms; ?>;
  function show(i){
    slides[idx].classList.remove('active');
    dots[idx]?.classList.remove('active');
    idx = (i + slides.length) % slides.length;
    slides[idx].classList.add('active');
    dots[idx]?.classList.add('active');
  }
  let timer = setInterval(()=>show(idx+1), SLIDE_MS);
  dots.forEach(d => d.addEventListener('click', () => {
    clearInterval(timer);
    show(parseInt(d.dataset.idx,10)||0);
    timer = setInterval(()=>show(idx+1), SLIDE_MS);
  }));
  // Optional: Pause on hover to mimic some SWF behavior
  const stage = document.getElementById('stage');
  stage.addEventListener('mouseenter', ()=> clearInterval(timer));
  stage.addEventListener('mouseleave', ()=> { timer = setInterval(()=>show(idx+1), SLIDE_MS); });
})();
</script>
</body>
</html>