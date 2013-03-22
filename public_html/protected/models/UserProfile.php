<?php

class UserProfile{
    public    $username; 
    public    $first_name; 
    public    $last_name; 
    public    $gender;  
    public    $dob; 
    public    $country; 
    public    $city;
    public    $marital; 
    public    $info; 
    
    public function __construct($model){
        $this->id= $model->id;
        $this->status= $model->profile->status;
        $this->username= $model->username;
        $this->first_name = $model->profile->first_name;
        $this->last_name = $model->profile->last_name;
        $this->gender = $model->profile->gender;  
        $this->dob = $model->profile->dob;
        $this->country =  $model->profile->country;
        $this->city = $model->profile->city;
        $this->marital = $model->profile->marital;
        $this->info = $model->profile->info;
        
        foreach($this as &$u){
            $u = CHtml::encode($u);
        }
        
        $this->photo = $model->profile->photo;  
      //  $this->dob = $this->rus_date("Y-i-s", $this->dob);
    }
    
 

    
    
}