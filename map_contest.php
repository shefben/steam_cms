<?php
require_once __DIR__.'/cms/db.php';
session_start();
$db   = cms_get_db();
$theme = cms_get_setting('theme','2004');
$base  = cms_base_url();

if(isset($_GET['ajax'])){
    header('Content-Type: application/json');
    if(isset($_GET['upload']) && $_GET['upload']==='screen'){
        if(!empty($_FILES['screenshot'])){
            $dir = __DIR__.'/map_contest/_tmp/'.session_id();
            if(!is_dir($dir)) mkdir($dir,0777,true);
            if(count($_SESSION['mc']['screens'] ?? []) >= 3){
                echo json_encode(['error'=>'Maximum 3 screenshots']);
                exit;
            }
            $ext = pathinfo($_FILES['screenshot']['name'], PATHINFO_EXTENSION);
            $name = 'ss_'.uniqid().'.'.$ext;
            move_uploaded_file($_FILES['screenshot']['tmp_name'], $dir.'/'.$name);
            $_SESSION['mc']['screens'][] = $name;
            echo json_encode(['ok'=>1,'name'=>$name,'url'=>'map_contest/_tmp/'.session_id().'/'.$name]);
        } else {
            echo json_encode(['error'=>'No file']);
        }
        exit;
    }
    if(isset($_GET['action']) && $_GET['action']==='remove_screen'){
        $name = $_POST['name'] ?? '';
        $screens = $_SESSION['mc']['screens'] ?? [];
        $idx = array_search($name,$screens, true);
        if($idx !== false){
            $dir = __DIR__.'/map_contest/_tmp/'.session_id();
            @unlink($dir.'/'.$name);
            array_splice($_SESSION['mc']['screens'],$idx,1);
        }
        echo json_encode(['ok'=>1]);
        exit;
    }

    $page = (int)($_GET['page'] ?? 1);
    if($page===1){
        $_SESSION['mc']['page1'] = $_POST;
        echo json_encode(['ok'=>1]);
        exit;
    }
    if($page===2){
        $files = [];
        if(isset($_FILES['mapFile'])){
            $dir = __DIR__.'/map_contest/_tmp/'.session_id();
            if(!is_dir($dir)) mkdir($dir,0777,true);
            $name = 'map_'.basename($_FILES['mapFile']['name']);
            move_uploaded_file($_FILES['mapFile']['tmp_name'],$dir.'/'.$name);
            $files['map_file'] = $name;
        }
        if(isset($_FILES['sourceFiles'])){
            $dir = __DIR__.'/map_contest/_tmp/'.session_id();
            if(!is_dir($dir)) mkdir($dir,0777,true);
            $name = 'src_'.basename($_FILES['sourceFiles']['name']);
            move_uploaded_file($_FILES['sourceFiles']['tmp_name'],$dir.'/'.$name);
            $files['source_files'] = $name;
        }
        $files['screens'] = $_SESSION['mc']['screens'] ?? [];
        $_SESSION['mc']['page2'] = array_merge($_POST,$files);
        echo json_encode(['ok'=>1]);
        exit;
    }
    if($page===3){
        $_SESSION['mc']['page3'] = $_POST;
        $data = array_merge($_SESSION['mc']['page1'] ?? [], $_SESSION['mc']['page2'] ?? [], $_POST);
        $stmt=$db->prepare('SELECT id FROM map_contest_entries WHERE full_name=? OR email=?');
        $stmt->execute([$data['cFullName']??'', $data['cEmail']??'']);
        if($stmt->fetchColumn()){
            echo json_encode(['success'=>0,'error'=>'Entry already exists']);
            exit;
        }
        $email = preg_replace('/[^a-zA-Z0-9@._-]/','',$data['cEmail']);
        $destDirRel = 'map_contest/'.$email;
        $destDir = __DIR__.'/'.$destDirRel;
        if(!is_dir($destDir)) mkdir($destDir,0777,true);
        $tmpDir = __DIR__.'/map_contest/_tmp/'.session_id();
        $map_file=null;$src_file=null;$ss1=null;$ss2=null;$ss3=null;
        if(!empty($data['map_file'])){
            $map_file = $destDirRel.'/'.basename($data['map_file']);
            rename($tmpDir.'/'.$data['map_file'],$destDir.'/'.basename($data['map_file']));
        }
        if(!empty($data['source_files'])){
            $src_file = $destDirRel.'/'.basename($data['source_files']);
            rename($tmpDir.'/'.$data['source_files'],$destDir.'/'.basename($data['source_files']));
        }
        if(!empty($data['screens'])){
            $i=1;
            foreach($data['screens'] as $sc){
                $dest = 'ss_'.$i.'.'.pathinfo($sc,PATHINFO_EXTENSION);
                rename($tmpDir.'/'.$sc,$destDir.'/'.$dest);
                ${'ss'.$i} = $destDirRel.'/'.$dest;
                $i++; if($i>3) break;
            }
        }
        $ins=$db->prepare('INSERT INTO map_contest_entries(full_name,address,city,state,country,zip,dob,phone,email,group_name,group_member1,group_member2,group_member3,group_member4,map_name,map_file,source_files,map_description,recommended_players,game_mode,development_time,tools,inspiration,screenshot1,screenshot2,screenshot3,previous_experience,additional_comments,how_did_you_hear,original_work,agree_rules,agree_license,confirm_age) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $ins->execute([
            $data['cFullName']??'',
            $data['cAddress']??'',
            $data['cCity']??'',
            $data['cState']??'',
            $data['cCountry']??'',
            $data['cZip']??'',
            $data['cDOB']??'',
            $data['cPhone']??'',
            $data['cEmail']??'',
            $data['cGroupName']??'',
            $data['cGroupMemberName1']??'',
            $data['cGroupMemberName2']??'',
            $data['cGroupMemberName3']??'',
            $data['cGroupMemberName4']??'',
            $data['mapName']??'',
            $map_file,
            $src_file,
            $data['mapDescription']??'',
            $data['recommendedPlayers']??'',
            $data['gameMode']??'',
            $data['developmentTime']??'',
            $data['tools']??'',
            $data['inspiration']??'',
            $ss1,$ss2,$ss3,
            $data['previousExperience']??'',
            $data['additionalComments']??'',
            $data['howDidYouHear']??'',
            empty($data['originalWork'])?0:1,
            empty($data['agreeToRules'])?0:1,
            empty($data['agreeToLicense'])?0:1,
            empty($data['confirmAge'])?0:1
        ]);
        cms_create_notification('Map Contest', 'New submission from '.($data['cFullName']??'unknown'));
        array_map('unlink', glob($tmpDir.'/*'));
        @rmdir($tmpDir);
        unset($_SESSION['mc']);
        echo json_encode(['success'=>1]);
        exit;
    }
}

$contestEnd = cms_get_setting('MapContest','0') === '1';
$banner = ($base ? rtrim($base, '/').'/' : '/').'archived_steampowered/2005/v1/img/map_contest/ProductBanner_HL2DM.jpg';
$content = '';
if ($contestEnd) {
    $content = <<<HTML
<font color="#bfba50">Half-Life 2: Deathmatch Map Making Contest</font></span> 
                        <p></p>
                        <p class="statusContent2"><span class="statusContent2">Valve would like to thank everyone who participated in the Half-Life 2: Deathmatch Map Making Contest. The judging process has begun. Details regarding that process and more may be found on the contest <a href="https://web.archive.org/web/20050207091922/http://www.steampowered.com/?area=map_contest_rules">rules</a> page.</span></p>
                        <p></p>
                        <p></p>
HTML;
} else {
    $base_url  = $base;
    $theme_url = ($base_url ? rtrim($base_url,'/').'/' : '')."themes/$theme";
    $content = <<<HTML
<link rel="stylesheet" href="$theme_url/css/map_contest.css">
<div id="contest-container">
<div id="mc-page1" class="mc-page">
<form id="mc-form1">
<input type="hidden" name="area" value="map_contest">
<p>Full legal name<br><input type="text" name="cFullName" size="42" required></p>
<p>Address<br><input type="text" name="cAddress" size="42" required></p>
<p>City<br><input type="text" name="cCity" size="42" required></p>
<p>State/Province<br><input type="text" name="cState" size="16" required></p>
<p>Country<br><input type="text" name="cCountry" size="16" required></p>
<p>Zip or Postal Code<br><input type="text" name="cZip" size="16" required></p>
<p>Date of Birth<br><input type="date" name="cDOB" size="16" required></p>
<p>Phone<br><input type="text" name="cPhone" size="42" required></p>
<p>Email<br><input type="email" name="cEmail" size="42" required></p>
<p>Group Name<br><input type="text" name="cGroupName" size="42"></p>
<p>Group Members<br><input type="text" name="cGroupMemberName1" size="42"><br>
<input type="text" name="cGroupMemberName2" size="42"><br>
<input type="text" name="cGroupMemberName3" size="42"><br>
<input type="text" name="cGroupMemberName4" size="42"></p>
<p><button type="submit">Next &raquo;</button></p>
</form>
</div>
<div id="mc-page2" class="mc-page" style="display:none;">
<form id="mc-form2" enctype="multipart/form-data">
<p>Map Name<br><input type="text" name="mapName" size="42" required></p>
<p>Map File (.bsp)<br><input type="file" name="mapFile" id="mapFile" accept=".bsp" required><progress id="mapProg" value="0" max="100" style="display:none;width:100%"></progress></p>
<p>Source Files (.zip)<br><input type="file" name="sourceFiles" id="sourceFiles" accept=".zip,.rar"><progress id="srcProg" value="0" max="100" style="display:none;width:100%"></progress></p>
<p>Map Description<br><textarea name="mapDescription" rows="4" cols="40"></textarea></p>
<p>Recommended Players<br><select name="recommendedPlayers" required>
<option value="">Select...</option>
<option value="2-4">2-4</option>
<option value="4-8">4-8</option>
<option value="8-12">8-12</option>
<option value="12-16">12-16</option>
<option value="16+">16+</option>
</select></p>
<p>Game Mode<br><select name="gameMode" required>
<option value="">Select...</option>
<option value="deathmatch">Deathmatch</option>
<option value="team">Team</option>
<option value="combine_vs_resistance">Combine vs. Resistance</option>
<option value="other">Other</option>
</select></p>
<p>Development Time<br><input type="text" name="developmentTime"></p>
<p>Tools Used<br><input type="text" name="tools" size="42"></p>
<p>Inspiration<br><textarea name="inspiration" rows="3" cols="40"></textarea></p>
<p>Screenshots (maximum of 3)<br>
<input type="file" id="ss-upload" accept="image/*" multiple>
<div id="shotList" class="shot-list"></div>
</p>
<p><button type="button" class="mc-prev" data-prev="1">&laquo; Previous</button> <button type="submit">Next &raquo;</button></p>
</form>
</div>
<div id="mc-page3" class="mc-page" style="display:none;">
<form id="mc-form3">
<p>Previous Mapping Experience<br><textarea name="previousExperience" rows="3" cols="40"></textarea></p>
<p>Additional Comments<br><textarea name="additionalComments" rows="3" cols="40"></textarea></p>
<p>How did you hear about this contest?<br><select name="howDidYouHear">
<option value="">Select...</option>
<option value="steam">Steam Client</option>
<option value="valve_website">Valve Website</option>
<option value="gaming_forum">Gaming Forum</option>
<option value="friend">Friend</option>
<option value="gaming_site">Gaming Site</option>
<option value="other">Other</option>
</select></p>
<p><label><input type="checkbox" name="originalWork" required> This map is my original work</label></p>
<p><label><input type="checkbox" name="agreeToRules" required> I agree to the contest rules</label></p>
<p><label><input type="checkbox" name="agreeToLicense" required> I grant Valve rights to my submission</label></p>
<p><label><input type="checkbox" name="confirmAge" required> I am at least 13 years old</label></p>
<p><button type="button" class="mc-prev" data-prev="2">&laquo; Previous</button> <button type="submit">Submit Entry</button></p>
</form>
</div>
</div>
<script src="$theme_url/js/jquery.min.js"></script>
<script src="$theme_url/js/map_contest.js"></script>
HTML;
}
$tpl = cms_theme_layout('productpage.twig', $theme);
cms_render_template($tpl, ['content' => $content, 'banner' => $banner]);
