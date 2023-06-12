<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Support\Facades\File;

class UserServiceImplement extends Service implements UserService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getProfile($id){
      return $this->mainRepository->getProfile($id);
    }

    public function update($id, array $data)
    {
      try{
        $user = $this->mainRepository->getProfile($id);

        $avatar = $user->avatar;
  
        if(array_key_exists('file', $data)){
  
          if(File::exists(parseUrl($avatar))){
            File::delete(parseUrl($avatar));
          }
  
          $avatar = $data['file']->store('user_profile/'.$id);
  
          $avatar = asset('storage/'.$avatar);
        }

        $data['avatar'] = $avatar;
  
        return $this->mainRepository->update($id, $data);
      }catch(Exception $e){
        return $e->getMessage();
      }
    }
}
