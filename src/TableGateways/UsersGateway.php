<?php
	namespace Src\TableGateways;

	class UsersGateway {
		private $db = NULL;

		public function __construct($db) {
			$this->db = $db;
		}

		public function findAll($page) {
			$limit = 5;

			if ($page > 1) {
				$start = (($page - 1) * $limit);
				$page = $page;
			} else {
				$start = 0;
			}

			$sql = "SELECT * FROM users ";
			$sql = $sql . 'LIMIT ' . $start . ', ' . $limit;
			try {
				$data = run($this->db, $sql, []);
				if (is_array($data)) {
					$total_data = run($this->db, "SELECT * FROM users", [], 'count');

					if ($total_data > 0) {
						$total_links = ceil($total_data / $limit);

						$previous_link = '';
						$next_link = '';
						$page_link = [];

						if ($total_links > 4) {
							if ($page < 5) {
								for ($count = 1; $count <= 5; $count++) {
									$page_array[] = $count;
								}
								$page_array[] = '...';
								$page_array[] = $total_links;
							} else {
								$end_limit = $total_links - 5;
								if ($page > $end_limit) {
									$page_array[] = 1;
									$page_array[] = '...';

									for ($count = $end_limit; $count <= $total_links; $count++) {
										$page_array[] = $count;
									}
								} else {
									$page_array[] = 1;
									$page_array[] = '...';
									for ($count = $page - 1; $count <= $page + 1; $count++) {
										$page_array[] = $count;
									}
									$page_array[] = '...';
									$page_array[] = $total_links;
								}
							}
						} else {
							for ($count = 1; $count <= $total_links; $count++) {
								$page_array[] = $count;
							}
						}

						for ($count = 0; $count < count($page_array); $count++) {
							if ($page == $page_array[$count]) {
								$page_link['active_page'] = $page_array[$count];

								$previous_id = $page_array[$count] - 1;
								if ($previous_id > 0) {
									$previous_link .= $previous_id;
								} else {
									$previous_link .= 'disabled';
								}

								$next_id = $page_array[$count] + 1;
								if ($next_id >= $total_links) {
									$next_link .= 'disabled';
								} else {
									$next_link .= $next_id;
								}

							} else {
								
								if ($page_array[$count] == '...') {
									$page_link['list_pages'] = ' ... | disabled';
								} else {
									$page_link[] = $page_array[$count];
								}
							}

						}

					}

					return  array(
						'data' => $data, 
						'total' => $total_data, 
						'previous_page' => $previous_link, 
						'page_link' => $page_link, 
						'next_page' => $next_link
					);
				}

			} catch (\PDOException $e) {
				exit($e->getMessage);
			}
		}

		public function find($id) {
			if ($id) {
				$sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
				try {
					$data = run($this->db, $sql, [$id]);
					if (is_array($data)) {
						return $data;
					}
					return false;
				} catch (\PDOException $e) {
					exit($e->getMessage);
				}
			}
		}

		public function insert(Array $params) {

			$uid = array('user_id' => guidv4());
			$params = array_merge($params, $uid);

			$array_keys = array_keys($params);
			$array_key = implode(',', $array_keys);

			$array_values = array_values($params);

			$values = '';
			for ($i=0; $i < count($array_keys); $i++) { 
				$values .= '?,';
			}
			$values = rtrim($values, ',');

			try {
				$data = run($this->db, "INSERT INTO users ($array_key) VALUES ($values)", $array_values);
				return $data;
			} catch (\PDOException $e) {
				exit($get->getMessage());
			}
		}

		public function update($id, Array $params) {
			$array_keys = array_keys($params);
			$columns = '';
			foreach ($array_keys as $key) {
				$columns .= $key . ' = ?, ';
			}
			$columns = rtrim($columns, ', ');
			$array_values = array_values($params);
			$array_values = array_merge($array_values, [$id]);

			$sql = "UPDATE users SET $columns WHERE user_id = ?";
			try {
				$data = run($this->db, $sql, $array_values);
				return $data;
			} catch (\PDOException $e) {
				exit($e->getMessage());
			}
		}

		public function delete($id) {
			$sql = "DELETE FROM users WHERE user_id = ?";
			try {
				$data = run($this->db, $sql, [$id]);
				return $data;
			} catch (\PDOException $e) {
				exit($e->getMessage());
			}
		}
	
	}
	