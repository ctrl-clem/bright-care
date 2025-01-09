<?php

class ProfileInfo extends Dbh{

    protected function getProfileInfo($userUid){
        $stmt = $this->connect()->prepare("SELECT * FROM `nanny_profiles` WHERE `users_id` = ?;");

        if(!$stmt->execute([$userUid])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: NannyProfile.php?error=profilenotfound');
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;

    }

    protected function setNewProfileInfo($profileAbout,$userUid,$skills,$cv){
        $stmt = $this->connect()->prepare("UPDATE nanny_profiles SET profiles_about = ?, users_skills = ?, users_cv = ?  WHERE users_id=?;" );

        if(!$stmt->execute([$profileAbout,$skills,$cv,$userUid])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }

        $stmt = null;

    }

    protected function setProfileInfoNanny($profileAbout, $userUid, $skills, $cv){
        $stmt = $this->connect()->prepare("INSERT INTO `nanny_profiles` (profiles_about,users_id,users_skills,users_cv) VALUES (?,?,?,?);" );

        if(!$stmt->execute([$profileAbout,$userUid,$skills,$cv])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }

        $stmt = null;

    }

    protected function getFullName($userId){
        $stmt = $this->connect()->prepare("SELECT * FROM `users` WHERE `usersId` = ?;");
        if(!$stmt->execute([$userId])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: NannyProfile.php?error=profilenotfound');
            exit();
        }
        $fullname = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $fullname[0]["usersFirstName"]." ".$fullname[0]["usersLastName"];
    }

    function getCoordinatesFromZip($zipCode) {
        $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($zipCode) . "&format=json";

        $options = [
            "http" => [
                "header" => "User-Agent: BrightCare/1.0 (clemntinamoisa17@gmail.com)"
            ]
        ];
        $context = stream_context_create($options);

        $response = file_get_contents($url, false, $context);

        if ($response === FALSE) {
            return null;
        }

        $data = json_decode($response, true);

        if (!empty($data)) {
            return ['latitude' => $data[0]['lat'], 'longitude' => $data[0]['lon']];
        }
        return null;
    }

    function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371; // Earth's radius in kilometers
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c; // Distance in kilometers
    }

    protected function getPhoneNumber($userId){
        $stmt = $this->connect()->prepare("SELECT * FROM `users` WHERE `usersId` = ?;");
        if(!$stmt->execute([$userId])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: NannyProfile.php?error=profilenotfound');
            exit();
        }
        $phone = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $phone[0]["usersPhone"];
    }

    protected function getEmail($userId){
        $stmt = $this->connect()->prepare("SELECT * FROM `users` WHERE `usersId` = ?;");
        if(!$stmt->execute([$userId])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: NannyProfile.php?error=profilenotfound');
            exit();
        }
        $email = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $email[0]["usersEmail"];
    }

    protected function getType($id){
        $stmt = $this->connect()->prepare("SELECT users_availability FROM nanny_criteria WHERE `usersId` = ?;");
        if(!$stmt->execute([$id])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header('location: NannyProfile.php?error=profilenotfound');
            exit();
        }
        $type = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $type[0]["users_availability"];
    }

    protected function getPrice($id){
        $stmt = $this->connect()->prepare("SELECT users_price FROM nanny_criteria WHERE `usersId` = ?;");
        if(!$stmt->execute([$id])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header('location: NannyProfile.php?error=profilenotfound');
            exit();
        }
        $type = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $type[0]["users_price"];
    }

    protected function setProfileInfoParent($q1,$q2,$q3,$q4,$q5,$q6,$userUid){
        $stmt = $this->connect()->prepare("INSERT INTO `parent_profiles` (q1, q2, q3,q4,q5,q6,users_id) VALUES (?,?,?,?,?,?,?);" );

        if(!$stmt->execute([$q1,$q2,$q3,$q4,$q5,$q6,$userUid])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }

        $stmt = null;

    }

    protected function getAllNannies(){
        $stmt = $this->connect()->prepare("
    SELECT  np.users_picture, 
            s.usersFirstName,
            s.usersLastName,
            s.usersId,
            s.users_experience,
            s.users_availability,
            s.users_price,
            s.zipCode
           FROM (
           SELECT u.usersFirstName,
                        u.usersLastName,
                        u.usersId,
                        nc.users_experience,
                        nc.users_availability,
                        nc.users_price,
                        u.zipCode FROM `nanny_criteria` nc
            LEFT JOIN `users` u
            on u.`usersId` = nc.`usersId`
            ) as s
    RIGHT JOIN nanny_profiles np
    on s.usersId = np.users_id;
    ");
        if(!$stmt->execute()){
            $stmt = null;
            header('location: ../DisplayNannies.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: ../DisplayNannies.php?error=nonanniesfound');
            exit();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getNanniesWithinReach($parentZip)
    {
        $nannies = [];
        $all = $this->getAllNannies();
        $parentCoordinates = $this->getCoordinatesFromZip($parentZip);

        $parentLat = $parentCoordinates['latitude'];
        $parentLon = $parentCoordinates['longitude'];

        foreach ($all as $nanny) {
            $nannyCoordinates = $this->getCoordinatesFromZip($nanny['zipCode']);
            if ($nannyCoordinates) {
                $distance = $this->calculateDistance(
                    $parentLat,
                    $parentLon,
                    $nannyCoordinates['latitude'],
                    $nannyCoordinates['longitude']
                );

                if ($distance <= 20) {
                    $nannies[] = $nanny;
                }
            }
        }

        return $nannies;
    }

    public function filterNannies($nannies,$type,$experience,$price,$startDate,$endDate){
        $filteredNannies = [];
        if(empty($nannies))
            return [];

        foreach ($nannies as $nanny) {
            $inputType = strtolower($type);
            $nannyTypeNormalized = strtolower($nanny['users_availability']);
            if ($this->availableDuringDate($nanny['usersId'],$startDate,$endDate)===0 &&
                ($nannyTypeNormalized === $inputType || $nannyTypeNormalized === 'any-type') &&
                $nanny['users_experience'] >= (int)$experience &&
                $nanny['users_price'] <= (int)$price)
                $filteredNannies[] = $nanny;
        }

        return $filteredNannies;
    }

    protected function getPicture($id){
        $stmt = $this->connect()->prepare("SELECT users_picture FROM nanny_profiles WHERE `users_id` = ?;");
        if(!$stmt->execute([$id])){
            $stmt = null;
            header('location: ../NannyProfile.php?error=stmtfailed');
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['users_picture'];
    }

    protected function availableDuringDate($nannyId,$startDate,$endDate){
        $stmt = $this->connect()->prepare("
        SELECT * FROM bookings
        WHERE nanny_id = ? AND NOT (? <= start_date OR ? >= end_date);");
        if(!$stmt->execute([$nannyId,$endDate,$startDate])){
            $stmt = null;
            header('location: ../Bookings.php?error=stmtfailed');
            exit();
        }
        return $stmt->rowCount();
    }

    public function addBooking($userid, $profileId, $start_date, $end_date){
        $stmt = $this->connect()->prepare("insert into bookings(parent_id,nanny_id,start_date,end_date) values(?,?,?,?);)");
        if(!$stmt->execute([$userid,$profileId,$start_date,$end_date])){
            $stmt = null;
            header('location: ../Bookings.php?error=stmtfailed');
            exit();
        }
    }

    public function getBookings($userid,$role){
        if($role == "nanny"){
            $stmt = $this->connect()->prepare("
            select b.id, u.usersEmail, u.usersPhone,u.usersFirstName, u.usersLastName, b.start_date, b.end_date, b.review
            from bookings b
            left join users u on b.parent_id = u.usersId
            where nanny_id = ?;");
            if(!$stmt->execute([$userid])){
                $stmt = null;
                header('location: ../DisplayBookings.php?error=stmtfailed');
                exit();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            $stmt = $this->connect()->prepare("
            select b.id, u.usersEmail, u.usersPhone,u.usersFirstName, u.usersLastName, b.start_date, b.end_date, b.review
            from bookings b
            left join users u on b.nanny_id = u.usersId
            where parent_id = ?;");
            if(!$stmt->execute([$userid])){
                $stmt = null;
                header('location: ../DisplayBookings.php?error=stmtfailed');
                exit();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function addReview($review,$bookingId){
        $stmt = $this->connect()->prepare("UPDATE bookings SET review = ? WHERE id = ?");
        if (!$stmt) {
            error_log("SQL Error: Failed to prepare statement.");
            throw new Exception("SQL Error: Failed to prepare statement.");
        }
        return $stmt->execute([$review,$bookingId]);

    }

    public function getReviews($id){
        $stmt = $this->connect()->prepare("
        select u.usersFirstName, u.usersLastName, b.review
        from bookings b
        left join users u on u.usersId = b.parent_id 
        where nanny_id = ?;");

        if(!$stmt->execute([$id])){
            $stmt = null;
            header('location: ../NannyProfile.php?error=stmtfailed');
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


}