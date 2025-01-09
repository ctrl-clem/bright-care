<?php

class ProfileInfoController extends ProfileInfo
{

    private $userId;
    private $userUId;
    private $role;


    public function __construct($userId, $userUId, $role)
    {
        $this->userId = $userId;
        $this->userUId = $userUId;
        $this->role = $role;

    }

    public function defaultProfileInfoNanny()
    {
        $profileAbout = "";
        $skills = "";
        $cv = "";
        $this->setProfileInfoNanny($profileAbout, $this->userId, $skills, $cv);
    }


    public function updateProfileInfo($profileAbout, $skills, $cv)
    {

        if ($this->emptyInputCheck($profileAbout)) {
            header("location: ../ProfileSettings.php?error=emptyinput");
            exit();
        }
        if ($this->emptyInputCheck($skills)) {
            header("location: ../ProfileSettings.php?error=emptyinput");
            exit();
        }
        if ($this->emptyInputCheck($cv)) {
            header("location: ../ProfileSettings.php?error=emptyinput");
            exit();
        }


        $this->setNewProfileInfo($profileAbout, $this->userId, $skills, $cv);
    }

    private function emptyInputCheck($about)
    {
        $result = false;
        if (empty($about)) {
            $result = true;
        }
        return $result;
    }

    public function defaultProfileInfoParent($q1, $q2, $q3, $q4, $q5, $q6)
    {
        $this->setProfileInfoParent($q1, $q2, $q3, $q4, $q5, $q6, $this->userId);

    }

    public function saveNannyInfo($id, $type, $experience, $price)
    {
        $stmt = $this->connect()->prepare("INSERT INTO nanny_criteria (usersId, users_availability, users_experience, users_price) VALUES (?, ?, ?, ?)");
        if (!$stmt->execute([$id, $type, $experience, $price])) {
            $stmt = null;
            header("location: ../ProfileSettings.php?error=sqlerror");
            exit();
        }
        $stmt = null;
    }

    public function savePicture($userid, $files, $targetFile){
        if (move_uploaded_file($files['profile_picture']['tmp_name'], $targetFile)) {
            $stmt = $this->connect()->prepare("UPDATE nanny_profiles SET users_picture = ? WHERE users_id = ?");

            if (!$stmt->execute([$targetFile, $userid])) {
                $stmt = null;
                header("location: ../NannyProfile.php?error=sqlerror");
                exit();
            }
        }
    }
}