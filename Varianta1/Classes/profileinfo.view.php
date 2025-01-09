<?php

class ProfileInfoView extends ProfileInfo {

    public function fetchAbout($userId){
        $profileInfo = $this->getProfileInfo($userId);

        return $profileInfo[0]["profiles_about"];
    }

    public function fetchSkills($userId){
        $profileInfo = $this->getProfileInfo($userId);

        return $profileInfo[0]["users_skills"];
    }

    public function fetchCV($userId){
        $profileInfo = $this->getProfileInfo($userId);

        return $profileInfo[0]["users_cv"];
    }

    public function fetchFullName($userId){
        return $this->getFullName($userId);

    }

    public function fetchAllNannies(){
        return $this->getAllNannies();
    }

    public function fetchPhoneNumber($userid){
        return $this->getPhoneNumber($userid);
    }

    public function fetchEmail($userid){
        return $this->getEmail($userid);
    }

    public function fetchType($userid){
        return $this->getType($userid);
    }
    public function fetchPrice($userid){
        return $this->getPrice($userid);
    }

    public function fetchPicture($userid){
        return $this->getPicture($userid);
    }

    public function fetchBookings($userid,$role){
        return $this->getBookings($userid,$role);
    }

    public function fetchReviews($userid){
        return $this->getReviews($userid);
    }


}