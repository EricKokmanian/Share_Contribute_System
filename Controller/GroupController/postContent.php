<?php
    include('../../Model/Config/db_server.php');
    session_start();
    $db = new DB();
    $arrayInfo = array();
    $allInfo= array();
    $arrayInfo[0] = false;
    if(isset($_SESSION['username']))
    if($_SESSION["username"] != null){
        $content = $_POST['content'];
        $type = $_POST['type'];
        $groupID = $_POST['groupID'];

        if($content == "" || $type == ""){
            echo json_encode(false);
            return;
        }
        $db->query("insert into postgroup(userID,groupID,type,date)values(".$_SESSION["usernameId"].",'".$groupID."','".$type."', NOW())");

        $result = $db->query("select * from postgroup where userID =".$_SESSION["usernameId"]." and type = '".$type."' order by ID desc");
        if($result){
            $postInserted = array();
            while($row = $result->fetch_assoc()){
                $postInserted[] = $row;
                break;
            }
        $db->query("insert into posttexttogroup(content,postID,groupID)values('".$content."', ".$postInserted[0]['ID'].", '".$groupID."')");  
        
        $result = $db->query("select p.ID,u.name,p.type,p.date,pt.content from postgroup as p  inner join posttexttogroup as pt on pt.postID = p.ID
                                inner join users as u on u.id = p.userID where pt.groupID = ".$groupID." order by p.date desc");
        if($result){
            while($row = $result->fetch_assoc()){
                $allCommentInfo = array();
                $result2 = $db->query("select u.name,c.comment,c.date from commentpostgroup as c inner join users as u on u.ID = c.userID where c.postID = ".$row['ID']."");
                while($row2 = $result2->fetch_assoc()){
                    $allCommentInfo[] = $row2;
                }
                $row['children'] = $allCommentInfo;
                $allInfo[] = $row;
            }
        }
        $arrayInfo[0] = true;
        $arrayInfo[1] = $allInfo;
        }
    }
    echo json_encode($arrayInfo);
?>