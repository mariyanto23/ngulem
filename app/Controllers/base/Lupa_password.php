<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\DashboardModel;

class Lupa_password extends Controller
{
    public function __construct() {
        //mengisi variable global dengan data
        $this->session = session();
        
        $this->DashboardModel = new DashboardModel(); 
        helper('text');
       
	    $this->request = \Config\Services::request(); //memanggil class request
        $this->uri = $this->request->uri; //class request digunakan untuk request uri/url
        $this->cache = \Config\Services::cache();
    }

    public function index()
    {
        $data['title'] = 'Reset Password';
        $data['view'] = 'base/dashboard/auth/lupa_password';
        return view('base/dashboard/auth/layout', $data);
        // echo $_SESSION['id'];
    }

    public function do_kirim(){
        $email = trim((string) $this->request->getPost('email'));
        $genericMessage = 'Jika email terdaftar, kami sudah mengirim tautan reset password.';

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->setFlashdata('success', [$genericMessage]);
            return redirect()->to(base_url('/login'));
        }

        if (! $this->consumeResetAttempt($email)) {
            $this->session->setFlashdata('success', [$genericMessage]);
            return redirect()->to(base_url('/login'));
        }

        $hasil = $this->DashboardModel->get_user_by_email($email);
        if(count($hasil) > 0)
        {
            $id = $hasil[0]->id;
            $hp = $hasil[0]->hp;
            $plainToken = bin2hex(random_bytes(32));
            $hashedToken = hash('sha256', $plainToken);
            $update = $this->DashboardModel->token_reset($hashedToken, $id);
            $pesan = 'Hallo Kak,<br>
            Terimakasih sudah menggunakan layanan <b>'.DOMAIN_UTAMA.'<b><br>
            Silahkan Klik Tautan berikut untuk ubah password baru<br>
            <a href="'.SITE_UTAMA.'/ganti_password/'.$plainToken.'">KLIK DISINI</a><br><br>
            <b>Terima Kasih dan Sukses Selalu</b>';
            $kirim = $this->sendEmail($email, 'Reset Password', $pesan);
            $token_wa = $this->DashboardModel->get_token();
            $message = 'Hallo Kak, Terimakasih sudah menggunakan layanan *'.DOMAIN_UTAMA.'*
            
Reset Password Berhasil,
Silahkan Klik Tautan berikut untuk ubah password baru
*'.SITE_UTAMA.'/ganti_password/'.$plainToken.'*

*Terimakasih dan Sukses Selalu*';
        
        
            if($kirim){
                if($token_wa !=''){
                    $this->send_wa($token_wa, $hp, $message);
                }
            }else{
                log_message('error', 'Reset password email gagal terkirim ke {email}', ['email' => $email]);
            }

            $this->session->setFlashdata('success', [$genericMessage]);
            return redirect()->to(base_url('/login'));
        }
        else
        {
            $this->session->setFlashdata('success', [$genericMessage]);
            return redirect()->to(base_url('/login'));
        }
		
    }
    
    public function ganti_password()
    {
        $plainToken = (string) $this->uri->getSegment(3);
        $user = $this->resolveResetUser($plainToken);
        if($user){
            $data['id_user'] = $user->id;
            $data['reset_token'] = $plainToken;
            $data['title'] = 'Ganti Password';
            $data['view'] = 'base/dashboard/auth/ganti_password';
            return view('base/dashboard/auth/layout', $data);
        }else{
            $this->session->setFlashdata('errors', ['Token Tidak Valid, Ulang Kembali']);
            return redirect()->to(base_url('/lupa_password'));
        }
    }
    public function update_password(){
        $id = (int) $this->request->getPost('id_user');
        $pass = (string) $this->request->getPost('pass');
        $pass2 = (string) $this->request->getPost('pass2');
        $plainToken = (string) $this->request->getPost('reset_token');
        $user = $this->resolveResetUser($plainToken);

        if (! $user || (int) $user->id !== $id) {
            $this->session->setFlashdata('errors', ['Token tidak valid atau sudah tidak berlaku.']);
            return redirect()->to(base_url('/lupa_password'));
        }

        if (strlen($pass) < 8) {
            $this->session->setFlashdata('errors', ['Password minimal 8 karakter.']);
            return redirect()->back()->withInput();
        }

        if($pass == $pass2){
            $password = password_hash($pass, PASSWORD_DEFAULT);
            $update = $this->DashboardModel->update_password($password, $id);
            
            $this->session->setFlashdata('success', ['Password Berhasil Diubah']);
            return redirect()->to(base_url('/login'));

        } else  {
            $this->session->setFlashdata('errors', ['Password tidak sama']);
            return redirect()->back()->withInput();
        }

            
    }

    private function resolveResetUser($plainToken)
    {
        if ($plainToken === '' || strlen($plainToken) < 32) {
            return null;
        }

        $hashedToken = hash('sha256', $plainToken);
        $hasil = $this->DashboardModel->get_user_by_token($hashedToken);
        if (empty($hasil)) {
            $hasil = $this->DashboardModel->get_user_by_token($plainToken);
        }
        if (empty($hasil)) {
            return null;
        }

        $user = $hasil[0];
        $created = $user->created_token ?? null;
        if (empty($created)) {
            return null;
        }

        $expiresAt = strtotime('+1 day', strtotime($created));
        if ($expiresAt === false || time() >= $expiresAt) {
            return null;
        }

        return $user;
    }

    private function consumeResetAttempt($email)
    {
        $key = 'reset-password:' . sha1(strtolower($email) . '|' . (string) $this->request->getIPAddress());
        $now = time();
        $window = 900;
        $maxAttempts = 3;

        try {
            $state = $this->cache->get($key);
            if (! is_array($state) || ! isset($state['count'], $state['first_at'])) {
                $state = ['count' => 0, 'first_at' => $now];
            }

            if (($now - (int) $state['first_at']) >= $window) {
                $state = ['count' => 0, 'first_at' => $now];
            }

            if ((int) $state['count'] >= $maxAttempts) {
                log_message('notice', 'Reset password dibatasi untuk email {email} dari IP {ip}', [
                    'email' => $email,
                    'ip' => (string) $this->request->getIPAddress(),
                ]);
                return false;
            }

            $state['count'] = (int) $state['count'] + 1;
            $this->cache->save($key, $state, $window);
        } catch (\Throwable $th) {
            log_message('error', 'Throttle reset password gagal: {message}', ['message' => $th->getMessage()]);
        }

        return true;
    }
    private function sendEmail($to, $title, $pesan){
        foreach ($this->DashboardModel->get_setting() as $row) {
                $email_kirim = $row->email;
                $pass_email = $row->pass_email;
                $host_email = $row->host_email;
        }
        $nama = SITE_NAME;
        $email_smtp = \Config\Services::email();
        $config["protocol"] = "smtp";
        //isi sesuai nama domain/mail server
        $config["SMTPHost"]  = $host_email;
        //alamat email SMTP
        $config["SMTPUser"]  = $email_kirim; 

        //password email SMTP
        $config["SMTPPass"]  = $pass_email; 
        $config["SMTPPort"]  = 587;
        $config["SMTPCrypto"] = "tls";

        $email_smtp->initialize($config);

		$email_smtp->setFrom($email_kirim, $nama);
		$email_smtp->setTo($to);
		$email_smtp->setSubject($title);
		$email_smtp->setMessage($pesan);

		if(!$email_smtp->send()){
			return false;
		}else{
			return true;
		}
    }
    
    private function parseWaGatewayConfig($value, $tokenValue = ''){
        $config = [
            'enabled' => true,
            'provider' => 'nusagateway',
            'token' => $this->parseWaTokenValue($tokenValue),
        ];

        if (empty($value)) {
            return $config;
        }

        if (strpos($value, 'off:') === 0) {
            $config['enabled'] = false;
            $config['provider'] = substr($value, 4) ?: 'nusagateway';
            return $config;
        }

        $config['provider'] = $value;
        return $config;
    }

    private function parseWaTokenValue($token){
        if (empty($token)) {
            return '';
        }

        if (strpos($token, '__disabled__:') === 0) {
            return substr($token, 13);
        }

        return $token;
    }

    private function isWaGatewayEnabled($gatewayValue, $tokenValue = ''){
        if (strpos((string) $gatewayValue, 'off:') === 0) {
            return false;
        }

        return strpos((string) $tokenValue, '__disabled__:') !== 0;
    }

    private function send_wa($token, $phone, $message){
	    foreach ($this->DashboardModel->get_setting() as $row){
            $waGatewayConfig = $this->parseWaGatewayConfig($row->wa_gateway, $row->token_wa);
        }
        $token = $this->parseWaTokenValue($token);
        if (! $this->isWaGatewayEnabled($row->wa_gateway ?? '', $row->token_wa ?? '') || empty($token) || empty($phone)) {
            return false;
        }
        $wa_gateway = $waGatewayConfig['provider'];
		if($wa_gateway == 'nusagateway'){
			$url = 'http://nusagateway.com/api/send-message.php';
			$curl = curl_init($url);
			$gateway = ['token' => $token,'phone' => $phone,'message' => $message];
			curl_setopt($curl, CURLOPT_POSTFIELDS, $gateway);
			// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			curl_close($curl);
			$content = json_decode($response);
			$status = $content->result;
		}else if($wa_gateway == 'starsender'){
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://starsender.online/api/sendText?message='.rawurlencode($message).'&tujuan='.rawurlencode($phone.'@s.whatsapp.net'),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_HTTPHEADER => array(
				'apikey: '.$token
			),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			$content = json_decode($response);
			$status = $content->status;
		}else if($wa_gateway == 'onesender'){
            $postData = [
                'phone' => $phone,
                'message' => $message
            ];
            
            $header = [
                'Authorization: Bearer '.$token,
            ]; 
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://onesender.my.id/api/message');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE,true);
            $response = curl_exec($ch);
            $content = json_decode($response);
			$code = $content->code;
            if($code == '200'){
                $status = 'true';
            }else{
                $status = 'false';
            }
        }
        if(($status ?? 'false') == 'true'){
			return true;
		}else{
			return false;
		
        }
	}
}
