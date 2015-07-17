<?php


class RolesTableSeeder extends MasterTableSeeder {

    private $roles = [
        'admin'  => '1',
        'owner'  => '2',
        'public' => '3',
    ];

	public function run()
	{
		foreach($this->roles as $name => $id)
		{
			Role::create([
                'id' => $id,
                'name' => $name
            ]);
		}
	}

    public function createSlug()
    {
    }
}