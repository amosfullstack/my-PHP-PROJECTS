<?php 
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to cadidate.php if the user is logged in
   
    header('location:voter_login.php');
  
  }
require '../layout.php';

require '../dbconn.php';
  //candidate data registration
  $stmt=$conn->prepare("SELECT*FROM candidates WHERE candidate_id=?");
  $stmt->bind_param("s", $_SESSION['username']);
  $stmt->execute();
  $result =$stmt->get_result();
  if($result->num_rows >0)
  {
   header('location:zstatstructure.php');
   exit();

  }

$partycodeErr=$positionErr=$textareaErr=$file=$onsubmitErr="";
if($_SERVER['REQUEST_METHOD']=='POST')
{ //sanitize input data
    if(empty(htmlspecialchars($_POST['partycode']))){
        $partycodeErr = " code required.";
    }else{
        $partycode= htmlspecialchars($_POST['partycode']);
    }
    if(empty(htmlspecialchars($_POST['position']))){
        $positionErr = " position required.";
    }else{
        $position= htmlspecialchars($_POST['position']);
    }
    if(empty(htmlspecialchars($_POST['textarea']))){
        $textareaErr = " short description required.";
    }else{
        $textarea= htmlspecialchars($_POST['textarea']);
    }
    

    $valid=$conn->prepare("SELECT * FROM parties WHERE candidate_code=?");
    $valid->bind_param("s",$partycode);
    $valid->execute();
    $results =$valid->get_result();
    if($results->num_rows ==1)
    {
        $sql=$conn->prepare("UPDATE parties SET candidate_id=? WHERE candidate_code=? ");
        $sql->bind_param("ss", $_SESSION['username'],$partycode);
        $sql->execute();

        //candidate data registration
      /* $stmt=$conn->prepare("INSERT INTO candidates(candidate_id,firstname,middlename,lastname) SELECT voter_id,firstname,middlename,lastname FROM voters WHERE voter_id=?");
       $stmt->bind_param("s", $_SESSION['username']);
       $stmt->execute();*/

      

        //handle uploaded file
        if($_FILES['photoPath'] && $_FILES['photoPath']['error']=== UPLOAD_ERR_OK)
       {    
        $target_dir = "images/";
        $target_file = $target_dir .  basename($_FILES["photoPath"]["name"]);
    
         if (move_uploaded_file($_FILES["photoPath"]["tmp_name"], $target_file))
       {
        
        if( $partycode && $position && $textarea && $target_file){
             
       $stmt=$conn->prepare("INSERT INTO candidates(candidate_id,position, photoPath, textarea,partycode )VALUES(?,?,?,?,?)");
       $stmt->bind_param("sssss" ,$_SESSION['username'],$position,$target_file,$textarea,$partycode );
       $stmt->execute();


        //copy political party
        $stmt=$conn->prepare("UPDATE candidates SET party=( SELECT  party_initial FROM parties WHERE candidate_code=?)WHERE candidate_id=?");
        $stmt->bind_param("ss",$partycode,$_SESSION['username']);
        $stmt->execute();
 

       /* if($conn->query($sql)===TRUE)
        {
            echo "<div> data uploaded successfully.</div>";
        }
        else{
            echo "<div> data failed to upload...!".$conn->error;
        }*/
       }else{
        $onsubmitErr = "fill all field*";
      }
      }
      else
      {
        $file ="unexpected error  happened during file uploading.";
        
          }

        }
    }

}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate registration form.</title>
    <link rel="stylesheet" href="voting.css">
    
</head>
<body>

<div class="container">
    <article>Candidate registration</article>
    <form id="candidateForm" enctype="multipart/form-data" action="candidate.php" method="post">

    <div class="form-group">
            <label for="partycode"><i>party code:</i></label>
            <input type="text" id="code" name="partycode" accept="image/*" >
            <?php if($partycodeErr){ echo $partycodeErr;}  ?>
        </div>
      
            <label for="firstName"><i>choose your position.</i></label>
            <select class="form-group" name="position" id="position" >
                <option value="Chairman" >Chairman </option>
                <option value="Vice Chairman">Vice Chairman</option>
            </select>
            <?php if($positionErr){ echo $positionErr;}  ?>
    
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photoPath" accept="image/*" required>
            <?php if($file){ echo $file;}  ?>
        </div>
        <div class="form-group">
            <label for="description">Why are you better than other candidates?</label>
            <textarea id="description" name="textarea" required></textarea>
            <?php if($textareaErr){ echo $textareaErr;}  ?>
        </div>
        <?php if($onsubmitErr){ echo $onsubmitErr;}  ?>
        <button type="submit">Upload Candidate</button>
    </form>
</div>

</body>
</html>
