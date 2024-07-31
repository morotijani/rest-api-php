<?php 
	namespace Src;

	class RefreshTokenGateway {

		private $db;
		private string $key;

		public function __construct($db, string $key) {
			$this->db = $db;
			$this->key = $key;
		}

		public function create(string $token, int $expiry): bool {
			$hash = hash_hmac("sha256", $token, $this->key);

			$sql = "INSERT into refresh_token (token_hash, expires_at) VALUES (?, ?)";
			$sql = run($this->db, $sql, [$hash, $expiry]);

			return $sql;
		}

		public function delete(string $token): int {
			$hash = hash_hmac("sha256", $token, $this->key);
			$sql = "DELETE FROM refresh_token WHERE token_hash = ?";
			$sql = run($this->db, $sql, [$hash], 'count');

			return $sql;
		}

		public function getByToken(string $token): array | false {
			$hash = hash_hmac("sha256", $token, $this->key);

			$sql = "SELECT * FROM refresh_token WHERE token_hash = ?";
			$sql = run($this->db, $sql, [$hash]);

			return $sql;
		}

		public function deleteExpired(): int {
			$sql = "DELETE FROM refresh_token WHERE expires_at < UNIX_TIMESTAMP()";
			$sql = run($this->db, $sql, [], 'count');

			return $sql;
		}
	}