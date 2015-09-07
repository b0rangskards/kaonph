<?php

class DatabaseSeeder extends Seeder
{

    protected $tables = [
	    'users',
        'roles',
	    'restaurants',
	    'food_types',
	    'foods'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        Eloquent::unguard();

        $this->seedTables();
    }

    public function seedTables()
    {
        $this->setForeignKeyChecks(false);
        $this->setSQLMode();

        foreach ( $this->tables as $tableName )
        {
	        $tableNameFormatted = strpos($tableName, '_') !== false
								? Str::title($tableName)
	                            : ucfirst(Str::camel($tableName));

	        $tableSeeder = $tableNameFormatted . 'TableSeeder';

	        $this->call($tableSeeder);
        }

        $this->setForeignKeyChecks(true);
    }

    public function cleanDatabase()
    {
        $this->setForeignKeyChecks(false);

        foreach ( $this->tables as $tableName ) {
            DB::table($tableName)->truncate();
        }

        $this->setForeignKeyChecks(true);
    }

    public function setSQLMode($value = 'NO_AUTO_VALUE_ON_ZERO')
    {
        if ( $this->isMySQL() ) {
            DB::statement('SET sql_mode = ' . $value);
        }
    }

    public function setForeignKeyChecks($enable = true)
    {
        if ( $this->isSQLite() ) {
            $statement = 'PRAGMA foreign_keys=' . ($enable ? '1' : '0');
            DB::statement(DB::raw($statement));
            return;
        }

        $statement = 'SET FOREIGN_KEY_CHECKS=' . ($enable ? '1' : '0');
        DB::statement($statement);
    }

    /**
     * @return bool
     */
    protected function isSQLite()
    {
        return DB::getDriverName() === 'sqlite';
    }

    /**
     * @return bool
     */
    protected function isMySQL()
    {
        return DB::getDriverName() === 'mysql';
    }

}
