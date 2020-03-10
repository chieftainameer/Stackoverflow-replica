<?php
session_start();
include "../functions/db.php";
 					date_default_timezone_set("Asia/Taipei");
                        $datetime=date("Y-m-d h:i:sa");
                        $userid = $_SESSION['user_Id'];
                        
extract($_POST);
$title = $con->real_escape_string($title);
$content = $con->real_escape_string($content);
$sql_cat = "SELECT * FROM `category` WHERE category='$category'";
$result_cat = $con->query($sql_cat);
$result_cat = $result_cat->fetch_assoc();
extract($result_cat);

$sql = "INSERT INTO tblpost(title,content, cat_id,postdate,user_id) VALUES ('$title','$content',$cat_id,'$datetime',$userid)";

$res = $con->query($sql);

if($res==true)
                            {
                                   echo '<script language="javascript">';
                                    echo 'alert("Post Successfully")';
                                    echo '</script>';
                                    echo '<meta http-equiv="refresh" content="0;url=home.php" />';
                            }
                            else
                            {
                            	echo "error occured";
                            }


?>