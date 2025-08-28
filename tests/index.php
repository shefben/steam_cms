<?php
$cfg = require __DIR__ . '/config.php';
$duration = (int)$cfg['duration'];
$slides = glob(__DIR__ . '/assets/slides/*.png');
natsort($slides);
$slides = array_values($slides);
$total = count($slides);
function slide_url($idx, $cfg) { return $cfg['links'][$idx+1] ?? '#'; }
function slide_title($idx, $cfg) { return $cfg['titles'][$idx+1] ?? ''; }
function slide_price($idx, $cfg) { return $cfg['prices'][$idx+1] ?? ''; }
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Large Capsule Clone (2009)</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
html,body{margin:0;padding:0;background:#0f0f0f;color:#ddd;font:12px/1.2 Arial,Helvetica,sans-serif}
.wrapper{position:relative;width:576px;height:224px;margin:20px auto; image-rendering: pixelated;}

.stage{position:absolute;left:0;top:0;width:576px;height:224px;overflow:hidden}
.slide{position:absolute;left:0;top:0;width:576px;height:224px;opacity:0;transition:opacity .35s linear}
.slide.active{opacity:1}

/* thin separator above the info bar (1px, light) */
.stage::after{content:'';position:absolute;left:0;bottom:44px;width:576px;height:1px;background:#c9c7c0;}

/* bottom info bar */
.infobar{position:absolute;left:0;bottom:0;width:576px;height:44px;background:#4b4a47;color:#d7d6d2;}
.price{position:absolute;right:8px;top:4px;font-size:12px;color:#d6d0c8;}
.title{position:absolute;left:8px;bottom:6px;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:560px;}

/* rectangle indicator strip */
.rects{position:absolute;left:8px;top:6px;right:80px;height:18px;display:flex;gap:4px;align-items:center;}
.rects .rect{flex:1 1 auto;height:14px;background:#2f2f2e;border:1px solid #3a3a39;box-sizing:border-box;cursor:pointer;transition:background .08s linear, transform .06s linear;}
.rects .rect.dim{background:#2f2f2e;border-color:#3a3a39;}
.rects .rect.active{background:#bdb8ab;border-color:#bdb8ab;}
.rects .rect:hover{background:#e6e1d6;transform:translateY(-1px);}
/* when the whole stage is hovered, brighten the CURRENT rect (Flash's _global.ovr) */
.rects.hover .rect.active{background:#efeae0;border-color:#efeae0;}

/* click overlay should NOT cover the bottom bar; height=224-44 */
a.hit{position:absolute;left:0;top:0;width:576px;height:180px;display:block;text-decoration:none}
</style>
</head>
<body>
<div class="wrapper" id="capsule" data-duration="<?php echo htmlspecialchars($duration, ENT_QUOTES); ?>">
    <div class="stage" id="stage">
        <?php foreach ($slides as $i => $path):
            $rel = 'assets/slides/' . basename($path);
            $href = slide_url($i, $cfg);
        ?>
        <a class="hit" href="<?php echo htmlspecialchars($href, ENT_QUOTES); ?>" target="_self" data-index="<?php echo $i; ?>"></a>
        <img class="slide<?php echo $i===0 ? ' active':''; ?>" src="<?php echo htmlspecialchars($rel, ENT_QUOTES); ?>" width="576" height="224" alt="slide <?php echo $i+1; ?>">
        <?php endforeach; ?>
        <div class="infobar">
            <div class="rects" id="rects">
                <?php for ($i=0; $i<$total; $i++): ?>
                <div class="rect<?php echo $i===0 ? ' active':''; ?>" data-index="<?php echo $i; ?>"></div>
                <?php endfor; ?>
            </div>
            <div class="price" id="price"><?php echo htmlspecialchars(slide_price(0, $cfg), ENT_QUOTES); ?></div>
            <div class="title" id="title"><?php echo htmlspecialchars(slide_title(0, $cfg), ENT_QUOTES); ?></div>
        </div>
    </div>
</div>
<script>
(function(){
    // Utility to mimic the Flash string patching we saw in the decompile
    function normalizeTitle(s){
        if (!s) return '';
        return s.split('@#153;').join('™').split('@').join('&'); // rough port of the replace() usage
    }

    var stage = document.getElementById('stage');
    var slides = Array.prototype.slice.call(stage.querySelectorAll('.slide'));
    var wrap = document.getElementById('capsule');
    var duration = parseInt(wrap.dataset.duration, 10) || 5000;
    var rectWrap = document.getElementById('rects');
    var rects = Array.prototype.slice.call(rectWrap.querySelectorAll('.rect'));
    var titleEl = document.getElementById('title');
    var priceEl = document.getElementById('price');
    var titles = <?php echo json_encode(array_values($cfg['titles']), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>;
    var prices = <?php echo json_encode(array_values($cfg['prices']), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>;
    var cur = 0, timer = null, paused = false;

    function setActive(i, user) {
        if (i === cur) return;
        slides[cur].classList.remove('active');
        rects[cur].classList.remove('active');
        cur = i;
        slides[cur].classList.add('active');
        rects[cur].classList.add('active');
        titleEl.innerHTML = normalizeTitle(titles[cur] || '');
        priceEl.textContent = prices[cur] || '';
        if (user) resetTimer();
    }
    function next() {
        var n = (cur + 1) % slides.length;
        setActive(n, false);
    }
    function resetTimer() {
        if (timer) clearInterval(timer);
        if (!paused && slides.length > 2) {
            timer = setInterval(next, duration);
        }
    }

    // click rectangles => _global.hit(idx, true)
    rects.forEach(function(r){
        r.addEventListener('click', function(){
            var idx = parseInt(this.getAttribute('data-index'), 10);
            setActive(idx, true);
        });
    });

    // stage hover => _global.ovr(_global.curImg) and pause
    stage.addEventListener('mouseenter', function(){
        paused = true; if (timer) clearInterval(timer);
        rectWrap.classList.add('hover'); // brighten the current active rect
    });
    // stage out => _global.out() and resume
    stage.addEventListener('mouseleave', function(){
        rectWrap.classList.remove('hover');
        paused = false; resetTimer();
    });

    // init
    titleEl.innerHTML = normalizeTitle(titles[cur] || '');
    priceEl.textContent = prices[cur] || '';
    resetTimer();
})();
</script>
</body>
</html>
