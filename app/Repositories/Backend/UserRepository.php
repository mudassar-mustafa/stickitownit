<?php

namespace App\Repositories\Backend;

use App\Models\User;
use App\Contracts\Backend\UserContract;
use Spatie\Permission\Models\Role;

class UserRepository extends BaseRepository implements UserContract
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listUser(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findUserById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createUser(array $params)
    {
        $params['user_type'] = 'customer';
        $user = $this->create($params);
        $user->assignRole(Role::findById(3));
        return $user;

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUser($id, array $params)
    {
        $params['user_type'] = 'customer';
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteUser($id)
    {
        return $this->delete($id);
    }
}
