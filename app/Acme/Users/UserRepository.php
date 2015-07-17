<?php  namespace Acme\Users; 

use Acme\Base\BaseRepositoryInterface;
use User;

class UserRepository implements BaseRepositoryInterface {

    public function save(User $user)
    {
        return $user->save();
    }

    public function getTableData()
    {
        // TODO: Implement getTableData() method.
    }

    public function getTableColumns()
    {
        // TODO: Implement getTableColumns() method.
    }
}