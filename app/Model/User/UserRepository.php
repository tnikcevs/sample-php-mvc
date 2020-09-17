<?php
declare(strict_types=1);
namespace App\Model\User;
use App\Core\Db;

class UserRepository
{
    /**
     * Fetch user from database based on email
     *
     * @param $email
     * @return User|false
     */
    public function getUserByEmail($email)
    {
        $user = false;
        $db = Db::getInstance();
        $statement = $db->prepare('select * from user where email = (?)', [$email]);
        // If there are more parameters execute will take them in order in array
        $statement->execute([
            $email
        ]);
        foreach ($statement->fetchAll() as $user) {
            $user = new User([
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'pass' => $user->pass
            ]);
        }
        return $user;
    }
}