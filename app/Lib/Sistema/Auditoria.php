<?php

namespace App\Lib\Sistema;

use Illuminate\Database\Connection;

class DatabaseLogger extends Connection
{
    public function insert($query, $bindings = [], $useReadPdo = true)
    {
        $this->logQuery($query, $bindings);
        parent::insert($query, $bindings, $useReadPdo);
    }

    public function update($query, $bindings = [], $useReadPdo = true)
    {
        $this->logQuery($query, $bindings);
        parent::update($query, $bindings, $useReadPdo);
    }

    public function delete($query, $bindings = [], $useReadPdo = true)
    {
        $this->logQuery($query, $bindings);
        parent::delete($query, $bindings, $useReadPdo);
    }

    protected function logQuery($query, $bindings)
    {
        $user_id = auth()->user()->id;
        $ip_address = request()->ip();
        $log = [
            'query' => $query,
            'user_id' => $user_id,
            'ip_address' => $ip_address,
            'created_at' => now(),
        ];
        $this->table('auditoria')->insert($log);
    }
}
