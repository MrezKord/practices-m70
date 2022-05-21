<?php

namespace Core\DB;

interface DatabaseInterface
{
	public function __construct(DatabaseConnectionInterface $connection);
	public function table(string $table): DatabaseInterface;
	public function select(array $cols = ['*']): DatabaseInterface;
	public function insert(array $fields): DatabaseInterface;
	public function update(array $fields): DatabaseInterface;
	public function condition(string $val1, string $val2, string $operation = '=', string $model = 'WHERE'): DatabaseInterface;
	public function setStatment(string $stmt) : DatabaseInterface;
	public function join(string $secondTable, string $val, string $val1, $model = "INNER") : DatabaseInterface;
	public function groupBy(string $col) : DatabaseInterface;
	public function fetch();
	public function fetchAll();
	public function exec() : bool;
	public function execute();
}
