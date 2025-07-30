<?php
require_once __DIR__.'/cms/db.php';
session_start();
$db = cms_get_db();
$theme = cms_get_setting('theme','2004');

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
        array_map('unlink', glob($tmpDir.'/*'));
        @rmdir($tmpDir);
        unset($_SESSION['mc']);
        echo json_encode(['success'=>1]);
        exit;
    }
}

$tpl = cms_theme_layout('map_contest.twig', $theme);
cms_render_template($tpl, ['page_title'=>'Map Contest']);
