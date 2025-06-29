<?php
/**
 * Steam-style Large Capsule (Flash 2007 -> PHP/JS clone – v2)
 * Expects largecapsule.xml in the same directory.
 * PHP >= 7.4
 */

declare(strict_types=1);

// ---------- helpers ----------
function fmt($v, $mode = 'currency') {
    return $mode === 'currency'
        ? '$' . number_format((float)$v, 2)
        : (string)$v;
}

// ---------- load XML ----------
$file = __DIR__ . '/largecapsule.xml';
if (!$xml = @simplexml_load_file($file)) {
    http_response_code(500);
    exit('largecapsule.xml missing or malformed');
}
$items = [];
foreach ($xml->capsule as $c) {
    $items[] = [
        'img'   => trim((string)$c->img),
        'title' => trim((string)$c->title),
        'price' => fmt($c->price, 'currency'),
        'url'   => trim((string)$c->url)
    ];
}
$json = json_encode($items, JSON_THROW_ON_ERROR);
?>
<!doctype html><html lang="en"><meta charset="utf-8">
<title>Large Capsule</title>
<style>
/* ---------- universal ---------- */
*{box-sizing:border-box;margin:0;padding:0}
body{background:#1b1b1b;font:14px/1.4 "Verdana","Trebuchet MS",sans-serif;color:#d0d0d0;
     display:flex;justify-content:center;align-items:center;height:100vh}

/* ---------- capsule shell ---------- */
#capsule{
    width:589px;height:267px;                       /* Flash capture dimensions */
    border:1px solid #3a3a3a;border-radius:6px;
    background:#2f2f2f;overflow:hidden;
    position:relative;font-size:0;                  /* kill gaps */
    box-shadow:inset 0 2px 3px rgba(0,0,0,.6);
}

/* image area */
#capImg{
    width:100%;height:215px;display:block;
    object-fit:cover;object-position:center top;
    border-bottom:1px solid #1e1e1e;
}

/* bottom rail (title, dots, price) */
#rail{
    height:52px;background:#2f2f2f;
    display:flex;align-items:center;gap:8px;
    padding:0 10px;
    font-size:14px;
}

/* navigation dots (10 squares) */
#dots{display:flex;gap:6px}
.dot{
    width:33px;height:20px;border-radius:3px;background:#505050;
    opacity:.45;cursor:pointer;position:relative;
    transition:opacity .15s, box-shadow .15s;
}
.dot.active{
    opacity:1;background:#8f8f8f;box-shadow:0 0 0 1px #fff;
}
.dot:hover{opacity:.75}

/* title & price */
#title{
    flex:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
    color:#bfc4c9;font:16px/1 "Trebuchet MS",sans-serif;margin-left:6px}
#price{color:#c9d0d6;font:bold 20px/1 "Trebuchet MS",sans-serif}

/* subtle snow specks (from the SWF) – optional eye-candy */
.snow{
    content:'';position:absolute;top:0;left:0;width:100%;height:215px;
    pointer-events:none;background:
        url("data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=") repeat;
    animation:snow 12s linear infinite;
    opacity:.12;
}
@keyframes snow{to{background-position:0 215px}}
</style>

<div id="capsule">
    <img id="capImg" src="">
    <span class="snow"></span>

    <div id="rail">
        <div id="dots"></div>
        <div id="title"></div>
        <div id="price"></div>
    </div>
</div>

<script>
/* ---------- data from PHP ---------- */
const data = <?= $json ?>;
let cur = 0, timer = null, D ;

// build dot bar
const dotsBox = document.getElementById('dots');
data.forEach((_, i)=>{
    const d = document.createElement('div');
    d.className = 'dot';
    d.onclick = ()=> { show(i); reset(); };
    dotsBox.appendChild(d);
});
D = [...dotsBox.children];

// dom refs
const img   = document.getElementById('capImg');
const title = document.getElementById('title');
const price = document.getElementById('price');

function show(i){
    const o = data[i];
    img.src = o.img;
    img.onerror = ()=> img.style.visibility='hidden';
    img.onload  = ()=> img.style.visibility='visible';
    img.onclick = ()=> window.open(o.url,'_blank');
    title.textContent = o.title;
    price.textContent = o.price;
    D[cur].classList.remove('active');
    D[i].classList.add('active');
    cur = i;
}

function next(){ show( (cur+1)%data.length ); }
function reset(){
    clearInterval(timer);
    timer = setInterval(next, 5000);
}

show(0); timer = setInterval(next, 5000);

// allow ←/→ keyboard nav (handy for testing)
addEventListener('keydown',e=>{
    if(e.key==='ArrowRight'){next();reset();}
    if(e.key==='ArrowLeft'){show((cur-1+data.length)%data.length);reset();}
});
</script>
</html>
