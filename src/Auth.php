<?php 
	namespace Src;

	use Src\TableGateways\UserGateway;

	class Auth {
		public function __construct(private UserGateway $user_gateway, private Jwt $JwtCtrl) {
	    
	    }

		public function authenticateJWTToken(): bool {
			if (!preg_match("/^Bearer\s+(.*)$/", $_SERVER["HTTP_AUTHORIZATION"], $matches)) {
				http_response_code(400);
				echo json_encode(["message" => "Incomplete authorization header!"]);
				return false;
			}

			try {
				$data = $this->JwtCtrl->decode($matches[1]);
			} catch (InvalidSignatureException) {
				http_response_code(401);
				echo json_encode(["message" => "Invalid signature!"]);
				return false;
			} catch (Exception $e) {
				http_response_code(400);
				echo json_encode(["message" => $e->getMessage()]);
				return false;
			}

			return true;

		}
	}
