<?php  
session_start() ;
require '../dbconn.php';

function checktimer($conn) {
    $currentDate = new DateTime();
    $stmt = $conn->prepare("SELECT * FROM announcements WHERE election_day IS NOT NULL");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $targetDate = new DateTime($row['election_day']);
        $endDate = new DateTime($row['election_end']);
        $_SESSION['date'] = $targetDate;// Make sure 'election_day' is in the correct format (e.g., 'YYYY-MM-DD')

        if ($currentDate > $targetDate) {
            if($currentDate < $endDate )
            {
                return 'vote.php';
            }else{
                return 'votelast.php';
            }
           
        } else {
            return 'dashboard.php';
          }
    }
    return null;
}

$response = ['redirect' => checktimer($conn)];
header('Content-Type: application/json');
echo json_encode($response);





?>