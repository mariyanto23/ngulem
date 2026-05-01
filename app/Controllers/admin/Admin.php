<?php namespace App\Controllers\admin;

use CodeIgniter\Controller;
use App\Models\admin\AdminModel;
use ZipArchive;
class Admin extends Controller
{
    public function __construct() {
        //mengisi variable global dengan data
        $this->session = session();
        $this->AdminModel = new AdminModel(); 
	    $this->request = \Config\Services::request(); //memanggil class request
        $this->uri = $this->request->uri; //class request digunakan untuk request uri/url
        $this->email = \Config\Services::email();
        $this->validate = \Config\Services::validation();
    }

    public function index()
    {
        if (session()->has('masukAdmin')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        return redirect()->to(rtrim(SITE_ADMIN, '/') . '/login');
    }

    public function do_auth(){
        $email = trim((string) $this->request->getPost('email'));
        $plainPassword = (string) $this->request->getPost('password');
        $hasil = $this->AdminModel->get_admin_by_email($email);
        
        if(count($hasil) > 0)
        {
            $admin = $hasil[0];
            $storedPassword = (string) ($admin->password ?? '');
            $isModernHash = password_get_info($storedPassword)['algo'] !== 0;
            $passwordValid = $isModernHash
                ? password_verify($plainPassword, $storedPassword)
                : hash_equals($storedPassword, md5($plainPassword));

            if (! $passwordValid) {
                $this->session->setFlashdata('errors', ['Email atau password salah.']);
                return redirect()->to(base_url('/login'));
            }

            if (! $isModernHash) {
                $this->AdminModel->update_admin_password_by_id(password_hash($plainPassword, PASSWORD_DEFAULT), $admin->id);
            }

            // set session
            $sess_data = array('masukAdmin' => TRUE, 'uname_admin' => $admin->username, 'id_admin' => $admin->id);
            $this->session->set($sess_data);
            return redirect()->to(base_url('admin/dashboard'));
            exit();
        }
        else
        {
            $this->session->setFlashdata('errors', ['Email atau password salah.']);
            return redirect()->to(base_url('/login'));
        }
		
    }
    
    public function do_unauth(){

        $this->session->destroy();
        return redirect()->to(base_url('/login'));
		
	}

    public function login()
    {
        if(session()->has('masukAdmin'))
        {
        	return redirect()->to(base_url('admin/dashboard'));
        }
        $data['title'] = 'Selamat Datang!';
        $data['view'] = 'admin/auth/login';
        return view('admin/auth/layout', $data);
    }

    public function dashboard()
    {
        $data['title'] = 'Admin Dashboard';
        $data['view'] = 'admin/index';
        $data['join'] = $this->AdminModel->get_all_join();
        $data['totalPending'] = $this->AdminModel->get_total_pending();
        $data['totalKeuntungan'] = $this->AdminModel->get_total_keuntungan();
        $data['setting'] = $this->AdminModel->get_setting();
        $data['setting_bayar'] = $this->AdminModel->get_setting_pembayaran();
        return view('admin/layout', $data);
    }

    public function pengguna()
    {
        $data['title'] = 'Data Pengguna';
        $data['view'] = 'admin/pengguna';
        $data['join'] = $this->AdminModel->get_all_pembayaran();
        $data['setting'] = $this->AdminModel->get_setting();
        return view('admin/layout', $data);
    }
    

    public function do_hapus_user(){

        $id = $this->request->getPost('id');

        $kunci= $this->request->getPost('kunci');
        
        $path = 'assets/users/'.$kunci;
        if(file_exists($path)){
        helper('filesystem'); // load the helper
        delete_files($path, true); // delete all files/folders inside images folder
        $remove = rmdir($path);
        }

        $delete = $this->AdminModel->delete_user($id);
            
        if($delete){
        $session = session();
            $session->setFlashdata("success", "Data Pengguna Berhasil dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Pengguna Gagal dihapus");
            echo 'gagal';
        }

    }
    
    public function testimoni()
    {
        $data['testimoni'] = $this->AdminModel->get_testimoni();
        $data['title'] = 'Data Testimonial';
        $data['view'] = 'admin/testimoni';
        
        return view('admin/layout', $data);
    }
    public function aktiftesti(){

        $id = $this->request->getPost('id');

        $update = $this->AdminModel->aktiftesti($id);
        if($update){
        $session = session();
            $session->setFlashdata("success", "Testimoni Berhasil diaktifkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Testimoni Gagal diaktifkan");
            echo 'gagal';
        }
    }
    public function nonaktiftesti(){

        $id = $this->request->getPost('id');

        $update = $this->AdminModel->nonaktiftesti($id);
        if($update){
        $session = session();
            $session->setFlashdata("success", "Testimoni Berhasil dinonaktfikan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Testimoni Gagal dinonaktfikan");
            echo 'gagal';
        }
    }
    
    public function hapus_testi(){

        $id = $this->request->getPost('id');

        $delete = $this->AdminModel->delete_testi($id);
        if($delete){
        $session = session();
            $session->setFlashdata("success", "Testimoni Berhasil dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Testimoni Gagal dihapus");
            echo 'gagal';
        }

    }
    
    public function pembayaran(){
        $data['title'] = 'Data Pembayaran';
        $data['view'] = 'admin/pembayaran';
        $data['join'] = $this->AdminModel->get_all_join();
        $data['setting'] = $this->AdminModel->get_setting();
        $data['setting_bayar'] = $this->AdminModel->get_setting_pembayaran();
        return view('admin/layout', $data);
    }

    public function do_konfirmasi(){

        $id = $this->request->getPost('id');
        $update = $this->AdminModel->konfirmasi_user($id);
        if($update){
            foreach ($this->AdminModel->get_setting() as $row) {
                $token = $row->token_wa;
           }
            foreach ($this->AdminModel->get_user_all($id) as $row) {
                $phone = $row->hp;
                $email = $row->email;
                $invoice = $row->invoice;
                $domain = $row->domain;
           }
            $paket = $this->AdminModel->get_paket_by_domain($domain);
            if($paket[0]->buku_tamu == 1){
                $link_bukutamu = SITE_BUKUTAMU.'/'.$domain;
            }else {
                $link_bukutamu = '-';
            }
            $pesan = "<h2>Konfirmasi Pembayaran</h2>Halo Kak, Terima Kasih Sudah Memesan Undangan Digital <b>".DOMAIN_UTAMA."</b><br><br>Pembayaran Anda <b>#".$invoice."</b> dengan domain <b>".$domain."</b> Berhasil dikonfirmasi oleh Admin <b>".DOMAIN_UTAMA."</b><br><br><b>Terima Kasih Dan Sukses Selalu</b>";
            $message = 'Halo Kak, Terima Kasih Sudah Memesan Undangan Digital '.DOMAIN_UTAMA.'
            
Pembayaran Anda #'.$invoice.' dengan domain *'.$domain.'* Berhasil dikonfirmasi oleh Admin '.DOMAIN_UTAMA.'.

*Berikut rincian informasi pesananan Anda :*

*Login Dashboard :* '.SITE_UTAMA.'/'.$domain.'
*Halaman Undangan :* '.SITE_UNDANGAN.'/'.$domain.'
*Halaman Bukutamu :* '.$link_bukutamu.'

*Terima Kasih Dan Sukses Selalu*';
            $this->send_wa($token, $phone, $message);
            $this->sendEmail($email, 'Konfirmasi Pembayaran', $pesan);
	 		$session = session();
            $session->setFlashdata("success", "Pembayaran Berhasil dikonfirmasi");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Pembayaran Gagal dikonfirmasi");
            echo 'gagal';
	 	}
    }
    
    private function sendEmail($to, $title, $pesan){
        foreach ($this->AdminModel->get_setting() as $row) {
                $host_email = $row->host_email;
                $email_kirim = $row->email;
                $pass_email = $row->pass_email;
                $smtp_port = isset($row->smtp_port) && (int) $row->smtp_port > 0 ? (int) $row->smtp_port : 587;
                $smtp_crypto = ! empty($row->smtp_crypto) ? $row->smtp_crypto : 'tls';
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
        $config["SMTPPort"]  = $smtp_port;
        $config["SMTPCrypto"] = $smtp_crypto;

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

    private function ensureMailSettingSchema()
    {
        try {
            $db = \Config\Database::connect();
            $columns = [
                'smtp_port' => "ALTER TABLE `setting` ADD `smtp_port` INT(11) DEFAULT 587 AFTER `pass_email`",
                'smtp_crypto' => "ALTER TABLE `setting` ADD `smtp_crypto` VARCHAR(10) DEFAULT 'tls' AFTER `smtp_port`",
                'incoming_host' => "ALTER TABLE `setting` ADD `incoming_host` VARCHAR(200) DEFAULT NULL AFTER `smtp_crypto`",
                'incoming_port' => "ALTER TABLE `setting` ADD `incoming_port` INT(11) DEFAULT NULL AFTER `incoming_host`",
            ];

            foreach ($columns as $column => $query) {
                $result = $db->query("SHOW COLUMNS FROM `setting` LIKE " . $db->escape($column));
                if (empty($result->getResultArray())) {
                    $db->query($query);
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Gagal memastikan schema mail setting: {message}', ['message' => $e->getMessage()]);
        }
    }

    public function profil(){
        $data['admin'] = $this->AdminModel->get_admin_by_id();
        $data['title'] = 'Profil Admin';
        $data['view'] = 'admin/profil';
		return view('admin/layout', $data);
    }

    public function do_update_admin(){

        if($this->request->getPost('password') != ''){
            $newPassword = (string) $this->request->getPost('password');
            if (strlen($newPassword) < 8) {
                echo 'gagal';
                return;
            }
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $data['username'] = $this->request->getPost('username');
        $data['nama_lengkap'] = $this->request->getPost('nama');
        $data['email'] = $this->request->getPost('email');

        $update = $this->AdminModel->update_admin($data);
        if($update){
            $this->session->set('uname_admin', $data['username']);
            echo 'sukses';
        }else{
            echo 'gagal';
        }
       
    }

    public function setting(){
        $data['setting'] = $this->AdminModel->get_setting();
        $data['music_library'] = $this->getMusicLibraryTracks();
        $data['quote_library'] = $this->getQuoteLibraryItems();
        $data['title'] = 'Setting Web';
        $data['view'] = 'admin/setting';
		return view('admin/layout', $data);
    }

    public function upload_musik_library()
    {
        if (!$this->validate([
            'musik_library' => [
                'rules' => 'uploaded[musik_library]'
                    . '|mime_in[musik_library,audio/mpeg,audio/mpg,audio/x-mpeg,audio/mp3]'
                    . '|max_size[musik_library,5120]',
                'errors' => [
                    'uploaded' => 'Silakan pilih file musik terlebih dahulu.',
                    'mime_in' => 'File musik harus berformat MP3.',
                    'max_size' => 'Ukuran file musik maksimal 5 MB.',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validate->getError('musik_library'));
            return redirect()->back()->withInput();
        }

        $musik = $this->request->getFile('musik_library');
        if (! $musik || ! $musik->isValid() || $musik->hasMoved()) {
            session()->setFlashdata('error', 'File musik tidak valid.');
            return redirect()->back()->withInput();
        }

        $this->ensureMusicLibraryStorage();

        $title = trim((string) $this->request->getPost('judul_musik'));
        $originalName = pathinfo($musik->getClientName(), PATHINFO_FILENAME);
        $safeBaseName = url_title($originalName ?: 'musik-admin', '-', true);
        if ($safeBaseName === '') {
            $safeBaseName = 'musik-admin';
        }

        $fileName = $safeBaseName . '-' . time() . '.mp3';
        $musik->move($this->getMusicLibraryDir(), $fileName, true);

        $titles = $this->readMusicLibraryTitles();
        $titles[$fileName] = $title !== '' ? $title : ucwords(str_replace('-', ' ', $safeBaseName));
        $this->writeMusicLibraryTitles($titles);

        session()->setFlashdata('success', 'Musik bawaan admin berhasil ditambahkan.');
        return redirect()->back();
    }

    public function upload_logo_utama()
    {
        if (! $this->validate([
            'logo_utama' => [
                'rules' => 'uploaded[logo_utama]|mime_in[logo_utama,image/png]|max_size[logo_utama,5120]',
                'errors' => [
                    'uploaded' => 'Silakan pilih file logo terlebih dahulu.',
                    'mime_in' => 'Logo utama harus berformat PNG.',
                    'max_size' => 'Ukuran logo utama maksimal 5 MB.',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validate->getError('logo_utama'));
            return redirect()->back()->withInput();
        }

        $logo = $this->request->getFile('logo_utama');
        if (! $logo || ! $logo->isValid() || $logo->hasMoved()) {
            session()->setFlashdata('error', 'File logo tidak valid.');
            return redirect()->back()->withInput();
        }

        $targetDir = FCPATH . 'assets/base/img/';
        if (! is_dir($targetDir)) {
            @mkdir($targetDir, 0775, true);
        }

        $targetPath = $targetDir . 'logo.png';
        if (file_exists($targetPath) && ! is_writable($targetPath)) {
            session()->setFlashdata('error', 'Logo utama tidak dapat diperbarui karena file tidak bisa ditulis.');
            return redirect()->back();
        }

        $content = @file_get_contents($logo->getTempName());
        if ($content === false) {
            session()->setFlashdata('error', 'Gagal membaca file logo yang diupload.');
            return redirect()->back();
        }

        if (@file_put_contents($targetPath, $content) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan logo utama.');
            return redirect()->back();
        }

        session()->setFlashdata('success', 'Logo utama berhasil diperbarui.');
        return redirect()->back();
    }

    public function upload_logo_dashboard()
    {
        if (! $this->validate([
            'logo_dashboard' => [
                'rules' => 'uploaded[logo_dashboard]|mime_in[logo_dashboard,image/png]|max_size[logo_dashboard,5120]',
                'errors' => [
                    'uploaded' => 'Silakan pilih file logo dashboard terlebih dahulu.',
                    'mime_in' => 'Logo dashboard harus berformat PNG.',
                    'max_size' => 'Ukuran logo dashboard maksimal 5 MB.',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validate->getError('logo_dashboard'));
            return redirect()->back()->withInput();
        }

        $logo = $this->request->getFile('logo_dashboard');
        if (! $logo || ! $logo->isValid() || $logo->hasMoved()) {
            session()->setFlashdata('error', 'File logo dashboard tidak valid.');
            return redirect()->back()->withInput();
        }

        $targetDir = FCPATH . 'assets/base/img/';
        if (! is_dir($targetDir)) {
            @mkdir($targetDir, 0775, true);
        }

        $targetPath = $targetDir . 'logo2.png';
        if (file_exists($targetPath) && ! is_writable($targetPath)) {
            session()->setFlashdata('error', 'Logo dashboard tidak dapat diperbarui karena file tidak bisa ditulis.');
            return redirect()->back();
        }

        $content = @file_get_contents($logo->getTempName());
        if ($content === false) {
            session()->setFlashdata('error', 'Gagal membaca file logo dashboard yang diupload.');
            return redirect()->back();
        }

        if (@file_put_contents($targetPath, $content) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan logo dashboard.');
            return redirect()->back();
        }

        session()->setFlashdata('success', 'Logo dashboard berhasil diperbarui.');
        return redirect()->back();
    }

    public function upload_favicon_situs()
    {
        if (! $this->validate([
            'favicon_situs' => [
                'rules' => 'uploaded[favicon_situs]|ext_in[favicon_situs,png,ico]|max_size[favicon_situs,1024]',
                'errors' => [
                    'uploaded' => 'Silakan pilih file favicon terlebih dahulu.',
                    'mime_in' => 'Favicon situs harus berformat PNG atau ICO.',
                    'max_size' => 'Ukuran favicon situs maksimal 1 MB.',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validate->getError('favicon_situs'));
            return redirect()->back()->withInput();
        }

        $favicon = $this->request->getFile('favicon_situs');
        if (! $favicon || ! $favicon->isValid() || $favicon->hasMoved()) {
            session()->setFlashdata('error', 'File favicon tidak valid.');
            return redirect()->back()->withInput();
        }

        $extension = strtolower($favicon->getClientExtension());
        if (! in_array($extension, ['ico', 'png'], true)) {
            session()->setFlashdata('error', 'Favicon situs harus berformat PNG atau ICO.');
            return redirect()->back()->withInput();
        }

        $targetDir = FCPATH . 'assets/base/img/';
        if (! is_dir($targetDir)) {
            @mkdir($targetDir, 0775, true);
        }

        $targetPath = $targetDir . 'favicon.' . $extension;
        if (file_exists($targetPath) && ! is_writable($targetPath)) {
            session()->setFlashdata('error', 'Favicon situs tidak dapat diperbarui karena file tidak bisa ditulis.');
            return redirect()->back();
        }

        $content = @file_get_contents($favicon->getTempName());
        if ($content === false) {
            session()->setFlashdata('error', 'Gagal membaca file favicon yang diupload.');
            return redirect()->back();
        }

        if (@file_put_contents($targetPath, $content) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan favicon situs.');
            return redirect()->back();
        }

        $alternateExtension = $extension === 'png' ? 'ico' : 'png';
        $alternatePath = $targetDir . 'favicon.' . $alternateExtension;
        if (file_exists($alternatePath) && is_writable($alternatePath)) {
            @unlink($alternatePath);
        }

        session()->setFlashdata('success', 'Favicon situs berhasil diperbarui.');
        return redirect()->back();
    }

    public function delete_musik_library()
    {
        $trackKey = (string) $this->request->getPost('track_key');
        $track = $this->resolveMusicTrack($trackKey);

        if (! $track || ! empty($track['is_default'])) {
            session()->setFlashdata('error', 'Musik bawaan utama tidak dapat dihapus.');
            return redirect()->back();
        }

        if (file_exists($track['path'])) {
            @unlink($track['path']);
        }

        $titles = $this->readMusicLibraryTitles();
        unset($titles[$track['file']]);
        $this->writeMusicLibraryTitles($titles);

        session()->setFlashdata('success', 'Musik bawaan admin berhasil dihapus.');
        return redirect()->back();
    }

    public function add_quote_library()
    {
        $quoteText = trim((string) $this->request->getPost('quote_text'));
        $quoteSource = trim((string) $this->request->getPost('quote_source'));

        if ($quoteText === '') {
            session()->setFlashdata('error', 'Isi quote wajib diisi.');
            return redirect()->back()->withInput();
        }

        $items = $this->getQuoteLibraryItems();
        $items[] = [
            'id' => 'quote-' . time() . '-' . mt_rand(100, 999),
            'text' => $quoteText,
            'source' => $quoteSource,
        ];

        $this->writeQuoteLibraryItems($items);
        session()->setFlashdata('success', 'Quote bawaan admin berhasil ditambahkan.');
        return redirect()->back();
    }

    public function delete_quote_library()
    {
        $quoteId = (string) $this->request->getPost('quote_id');
        $items = array_values(array_filter($this->getQuoteLibraryItems(), static function ($item) use ($quoteId) {
            return ($item['id'] ?? '') !== $quoteId;
        }));

        $this->writeQuoteLibraryItems($items);
        session()->setFlashdata('success', 'Quote bawaan admin berhasil dihapus.');
        return redirect()->back();
    }

    public function do_update_setting_1(){
        $this->ensureMailSettingSchema();
        $provider = $this->request->getPost('wa_gateway');
        $enabled = $this->request->getPost('wa_gateway_enabled') === '1';
        $data['host_email'] = $this->request->getPost('host_email');
        $data['email'] = $this->request->getPost('email');
        $data['pass_email'] = $this->request->getPost('pass_email');
        $data['smtp_port'] = (int) ($this->request->getPost('smtp_port') ?: 587);
        $data['smtp_crypto'] = strtolower((string) ($this->request->getPost('smtp_crypto') ?: 'tls'));
        $data['incoming_host'] = $this->request->getPost('incoming_host');
        $data['incoming_port'] = $this->request->getPost('incoming_port') !== '' ? (int) $this->request->getPost('incoming_port') : null;
        $data['wa_gateway'] = $this->normalizeWaProvider($provider);
        $data['token_wa'] = $this->buildWaTokenValue($this->request->getPost('token_wa'), $enabled);
        $data['no_wa'] = $this->request->getPost('no_wa');
        $data['pesan_wa'] = $this->request->getPost('pesan_wa'); 
        $data['social_facebook'] = trim((string) $this->request->getPost('social_facebook'));
        $data['social_instagram'] = trim((string) $this->request->getPost('social_instagram'));
        $data['social_youtube'] = trim((string) $this->request->getPost('social_youtube'));
        $data['social_tiktok'] = trim((string) $this->request->getPost('social_tiktok'));
        $update = $this->AdminModel->update_setting($data);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Data Setting Berhasil diupdate");
            echo 'sukses';
        }else{ 
            $session = session();
            $session->setFlashdata("error", "Data Setting Gagal diupdate");
            echo 'gagal';
        }

    }

        public function do_update_setting_2(){
        $data['trial'] = $this->request->getPost('trial');
        $data['salam_pembuka'] = $this->request->getPost('salam_pembuka');
        $data['salam_wa_atas'] = $this->request->getPost('salam_wa_atas');
        $data['salam_wa_bawah'] = $this->request->getPost('salam_wa_bawah');            
        $update = $this->AdminModel->update_setting($data);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Data Setting Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Setting Gagal diupdate");
            echo 'gagal';
        }

    }

    public function setting_pembayaran(){
        $data['setting'] = $this->AdminModel->get_setting_pembayaran();
        $data['title'] = 'Setting Pembayaran';
        $data['view'] = 'admin/setting_pembayaran';
		return view('admin/layout', $data);
    }

    private function ensurePaymentMethodSchema()
    {
        try {
            $db = \Config\Database::connect();
            $result = $db->query("SHOW COLUMNS FROM `setting_pembayaran` LIKE 'metode_bayar'");
            $row = $result ? $result->getRow() : null;

            if ($row && isset($row->Type) && stripos($row->Type, 'manual_qris') === false) {
                $db->query("ALTER TABLE `setting_pembayaran` MODIFY `metode_bayar` ENUM('manual','manual_qris','midtrans','tripay') NOT NULL");
            }

            $merchantResult = $db->query("SHOW COLUMNS FROM `setting_pembayaran` LIKE 'merchant_qris_manual'");
            $merchantRow = $merchantResult ? $merchantResult->getRow() : null;

            if (! $merchantRow) {
                $db->query("ALTER TABLE `setting_pembayaran` ADD `merchant_qris_manual` VARCHAR(100) DEFAULT NULL AFTER `nama_manual`");
                $db->query("UPDATE `setting_pembayaran` SET `merchant_qris_manual` = `nama_manual` WHERE (`merchant_qris_manual` IS NULL OR `merchant_qris_manual` = '') AND `nama_manual` IS NOT NULL");
            }
        } catch (\Throwable $th) {
            log_message('error', 'Gagal menyesuaikan schema metode_bayar: {message}', ['message' => $th->getMessage()]);
        }
    }

    private function hasManualQrisAsset()
    {
        foreach (['png', 'jpg', 'jpeg', 'webp'] as $extension) {
            if (is_file(FCPATH . 'assets/base/img/qris-manual.' . $extension)) {
                return true;
            }
        }

        return false;
    }
    
    public function setting_paket(){
        $data['setting'] = $this->AdminModel->get_setting_paket();
        $data['title'] = 'Setting Paket Undangan';
        $data['view'] = 'admin/setting_paket';
		return view('admin/layout', $data);
    }

    public function do_update_setting_pembayaran_1(){
        $this->ensurePaymentMethodSchema();
        $data['bank_manual'] = $this->request->getPost('bank_manual');
        $data['norek_manual'] = $this->request->getPost('norek_manual');
        $data['nama_manual'] = $this->request->getPost('nama_manual');
        $data['merchant_qris_manual'] = $this->request->getPost('merchant_qris_manual');
        $data['url_midtrans'] = $this->request->getPost('url_midtrans');
        $data['serverkey_midtrans'] = $this->request->getPost('serverkey_midtrans');
        $data['clientkey_midtrans'] = $this->request->getPost('clientkey_midtrans');
        $data['midtrans_production'] = $this->request->getPost('midtrans_production');
        $data['url_tripay'] = $this->request->getPost('url_tripay');
        $data['apikey_tripay'] = $this->request->getPost('apikey_tripay');
        $data['privatekey_tripay'] = $this->request->getPost('privatekey_tripay');
        $data['merchantcode_tripay'] = $this->request->getPost('merchantcode_tripay');
        $qrisManualFile = $this->request->getFile('qris_manual_file');

        if ($qrisManualFile && $qrisManualFile->isValid() && ! $qrisManualFile->hasMoved()) {
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];
            $extension = strtolower($qrisManualFile->getExtension());

            if (! in_array($extension, $allowedExtensions, true) || $qrisManualFile->getSizeByUnit('mb') > 2) {
                $session = session();
                $session->setFlashdata("error", "QRIS manual harus berupa PNG/JPG/JPEG/WEBP maksimal 2MB");
                echo 'gagal';
                return;
            }

            foreach ($allowedExtensions as $oldExtension) {
                $oldPath = FCPATH . 'assets/base/img/qris-manual.' . $oldExtension;
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $qrisManualFile->move(FCPATH . 'assets/base/img', 'qris-manual.' . $extension, true);
        }

        $update = $this->AdminModel->update_setting_pembayaran($data);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Data Setting Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Setting Gagal diupdate");
            echo 'gagal';
        }

    }
    public function do_update_setting_pembayaran_2(){
        $this->ensurePaymentMethodSchema();
        $data['metode_bayar'] = $this->request->getPost('metode_bayar');

        if ($data['metode_bayar'] === 'manual_qris' && ! $this->hasManualQrisAsset()) {
            $session = session();
            $session->setFlashdata("error", "Upload gambar QRIS manual dulu sebelum mengaktifkan metode ini");
            echo 'gagal';
            return;
        }

        $update = $this->AdminModel->update_setting_pembayaran($data);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Data Setting Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Setting Gagal diupdate");
            echo 'gagal';
        }

    }
    
    public function do_update_paket(){
        $id = $this->request->getPost('id_paket');
        $data = $this->buildPaketPayload();
        
        $update = $this->AdminModel->update_paket($id, $data);
        if($update){
            $session = session();
            $session->setFlashdata("success", "Data Setting Paket Berhasil diupdate");
            echo 'sukses';
            return redirect()->to(base_url('admin/setting_paket'));
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Setting Paket Gagal diupdate");
            echo 'gagal';
            return redirect()->to(base_url('admin/setting_paket'));
        }

    }

    public function add_paket(){
        $data = $this->buildPaketPayload();

        $save = $this->AdminModel->add_paket($data);
        if($save){
            $session = session();
            $session->setFlashdata("success", "Paket undangan berhasil ditambahkan");
        }else{
            $session = session();
            $session->setFlashdata("error", "Paket undangan gagal ditambahkan");
        }

        return redirect()->to(base_url('admin/setting_paket'));
    }

    public function delete_paket(){
        $id = (int) $this->request->getPost('id');

        if($this->AdminModel->count_all_paket() <= 1){
            echo 'terakhir';
            return;
        }

        if($this->AdminModel->count_paket_usage($id) > 0){
            echo 'dipakai';
            return;
        }

        $delete = $this->AdminModel->delete_paket($id);
        if($delete){
            $session = session();
            $session->setFlashdata("success", "Paket undangan berhasil dihapus");
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }
    
    public function edit_pengguna(){

        if($this->request->getMethod() == 'post'){
            $id = $this->request->getPost('id');
            $this->session->set('id_usernya', $id);
        }
        $data['title'] = 'Edit Pengguna';
        $data['view'] = 'admin/edit_pengguna';

        $data['user'] = $this->AdminModel->get_user_by_id_user();
        $data['fitur'] = $this->AdminModel->get_fitur_by_id_user();
        $data['acara'] = $this->AdminModel->get_acara_by_id_user();
        $data['mempelai'] = $this->AdminModel->get_mempelai_by_id_user();
        $data['cerita'] = $this->AdminModel->get_cerita_by_id_user(); 
        $data['album'] = $this->AdminModel->get_album_by_id_user();
        $data['data'] = $this->AdminModel->get_data_by_id_user();
        $data['order'] = $this->AdminModel->get_order_by_id_user();
        return view('admin/layout', $data);

    }

    public function do_update_user(){

        $password = trim((string) $this->request->getPost('password'));
        if($password !== ''){
            if(strlen($password) < 8){
                echo 'password_min';
                return;
            }

            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $data['username'] = $this->request->getPost('username');
        $data['email'] = $this->request->getPost('email');
        $data['hp'] = $this->request->getPost('hp');

        $update = $this->AdminModel->update_user($data);
        if($update){
            $this->session->set('uname', $data['username']);
            echo 'sukses';
        }else{
            echo 'gagal';
        }
       
    }

    public function do_update_cerita(){

        //SEBAGAI ARRAY PENANDA
        $noTanggal = 0;
        $noJudul = 0;
        $noIsi = 0;
        
        //KITA KUMPULKAN DAN SIMPAN DATANYA DI SESSION DULU
        foreach ($this->request->getPost('tanggal_cerita') as $value) {
            if($value == "")
                continue;
            $this->session->set('tanggal_cerita'.$noTanggal++, $value); 
            
        }

        foreach ($this->request->getPost('judul_cerita') as $value) {
            if($value == "")
            continue;
            $this->session->set('judul_cerita'.$noJudul++, $value); 
        }

        foreach ($this->request->getPost('isi_cerita') as $value) {
            if($value == "")
            continue;
            $this->session->set('isi_cerita'.$noIsi++, $value); 
        }
        
        //KEMUDIAN HAPUS SEMUA DATA CERITA SEBULUMNYA
        $hpscerita = $this->AdminModel->hapus_cerita();

        //SETELAH ITU KITA SIMPAN KE DB
        for($i=0;$i<$noTanggal;$i++){
            $tanggal_cerita = $this->session->get('tanggal_cerita'.$i);
            $judul_cerita = $this->session->get('judul_cerita'.$i);
            $isi_cerita = $this->session->get('isi_cerita'.$i);

            $dataCerita = [
                'id_user' => $_SESSION['id_usernya'],
                'tanggal_cerita' => $tanggal_cerita,
                'judul_cerita' => $judul_cerita,
                'isi_cerita' => $isi_cerita
            ];

            $saveCerita = $this->AdminModel->save_cerita($dataCerita);
            //HAPUS DULU SESSION SEBELUMNYA
            $this->session->remove('tanggal_cerita'.$i);
            $this->session->remove('judul_cerita'.$i);
            $this->session->remove('isi_cerita'.$i);
        
        }
        $session = session();
        $session->setFlashdata("success", "Data Cerita Berhasil diupdate");
        echo 'sukses';
        return redirect()->to(base_url('admin/edit_pengguna'));

    }

    public function do_update_video(){
         
        $data['video'] = $this->request->getPost('video');

        $update = $this->AdminModel->update_video($data);
        if($update){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }

    // upload foto gallery
	public function do_update_gallery(){

        $avatar = $this->request->getFile('file');
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        
        //folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$kunci, 0777,true);
        }

        //nama file e
        for($i=1;$i<=10;$i++){
        	$pathName = 'assets/users/'.$kunci.'/album'.$i.'.png';
        	if(!file_exists($pathName)){
        		$ok = array("no"=>$i,"kunci"=>$kunci);
        		$avatar->move('assets/users/'.$kunci, 'album'.$i.'.png');
                echo json_encode($ok);
                
                //save to db
                $dataAlbum = [
                    'id_user' => $_SESSION['id_usernya'],
                    'album' => 'album'.$i
  
                ];
                $saveAlbum = $this->AdminModel->save_album($dataAlbum);
        		break;
        	} 
        }

    }

    public function do_del_gallery(){

       $id = $this->request->getPost('id');
       $kunci = $this->request->getPost('kunci');
       $file = 'assets/users/'.$kunci.'/album'.$id.'.png';
       $data['album'] = 'album'.$id;
       $data['id_user'] = $_SESSION['id_usernya'];
       $delete = $this->AdminModel->delete_album($data);
       unlink($file);
       echo json_encode("sukses");
    }


    public function do_update_acara(){
         //SEBAGAI ARRAY PENANDA
            $noNama = 0;
			$noTanggal = 0;
			$noMulai = 0;
			$noAkhir = 0;
			$noTempat = 0;
			$noAlamat = 0;
			$noMaps = 0;
            
            //KITA KUMPULKAN DAN SIMPAN DATANYA DI SESSION DULU
			foreach ($this->request->getPost('nama_acara') as $value) {
                if($value == "")
                    continue;
                $this->session->set('nama_acara'.$noNama++, $value); 
                
			}

			foreach ($this->request->getPost('tgl_acara') as $value) {
                if($value == "")
                continue;
                $this->session->set('tgl_acara'.$noTanggal++, $value); 
			}

			foreach ($this->request->getPost('waktu_mulai') as $value) {
                if($value == "")
                continue;
                $this->session->set('waktu_mulai'.$noMulai++, $value); 
            }
            foreach ($this->request->getPost('waktu_akhir') as $value) {
                if($value == "")
                    continue;
                $this->session->set('waktu_akhir'.$noAkhir++, $value); 
                
			}

			foreach ($this->request->getPost('tempat_acara') as $value) {
                if($value == "")
                continue;
                $this->session->set('tempat_acara'.$noTempat++, $value); 
			}

			foreach ($this->request->getPost('alamat_acara') as $value) {
                if($value == "")
                continue;
                $this->session->set('alamat_acara'.$noAlamat++, $value); 
            }
            foreach ($this->request->getPost('maps') as $value) {
                $this->session->set('maps'.$noMaps++, $value); 
            }
            
            //KEMUDIAN HAPUS SEMUA DATA CERITA SEBULUMNYA
            $hpsacara = $this->AdminModel->hapus_acara();

            //SETELAH ITU KITA SIMPAN KE DB
            for($i=0;$i<$noNama;$i++){
				$nama_acara = $this->session->get('nama_acara'.$i);
				$tgl_acara = $this->session->get('tgl_acara'.$i);
				$waktu_mulai = $this->session->get('waktu_mulai'.$i);
                $waktu_akhir = $this->session->get('waktu_akhir'.$i);
				$tempat_acara = $this->session->get('tempat_acara'.$i);
				$alamat_acara = $this->session->get('alamat_acara'.$i);
				$maps = $this->session->get('maps'.$i);
				$dataCerita = [
				    'id_user' => $_SESSION['id_usernya'],
					'nama_acara' => $nama_acara,
					'tgl_acara' => $tgl_acara,
					'waktu_mulai' => $waktu_mulai,
					'waktu_akhir' => $waktu_akhir,
					'tempat_acara' => $tempat_acara,
					'alamat_acara' => $alamat_acara,
					'maps' => $maps
				];

                $saveCerita = $this->AdminModel->save_acara($dataCerita);
                //HAPUS DULU SESSION SEBELUMNYA

                $this->session->remove('nama_acara'.$i);
                $this->session->remove('tgl_acara'.$i);
                $this->session->remove('waktu_mulai'.$i);
                $this->session->remove('waktu_akhir'.$i);
                $this->session->remove('tempat_acara'.$i);
                $this->session->remove('alamat_acara'.$i);
                $this->session->remove('maps'.$i);
            
            }
            $session = session();
            $session->setFlashdata("success", "Data Acara Berhasil diupdate");
            echo 'sukses';
            return redirect()->back()->withInput(); 
    }

    public function do_update_maps(){
         
        $data['maps'] = $this->request->getPost('maps');

        $update = $this->AdminModel->update_maps($data);
        if($update){
        $session = session();
            $session->setFlashdata("success", "Data Maps Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Maps Gagal diupdate");
            echo 'gagal';
        }
    }

    //upload foto mempelai
	public function do_update_foto_mempelai(){

        $groom = $this->request->getFile('foto_groom');
        $bride = $this->request->getFile('foto_bride');
        $sampul = $this->request->getFile('foto_sampul');
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        
        //cek folder e
        if(!file_exists($path)){
        	$create = mkdir('assets/users/'.$kunci, 0777,true);
        }
         
        if($groom != ''){ //cek dulu ini fotonya siapa
        	$avatar = $groom;
        	$pathName = 'assets/users/'.$kunci.'/groom.png';
        	if(file_exists($pathName)){
        		unlink($pathName); //hapus dulu foto yg lama
	    	} 
				$avatar->move('assets/users/'.$kunci, 'groom.png'); //upload yg baru
				echo 'uploadedgroom'; //give feedback ke jquery.. agar tampilan fotonya di ubah dgn yg baru
        }else if($bride != ''){
            $avatar = $bride;
            $pathName = 'assets/users/'.$kunci.'/bride.png';
            if(file_exists($pathName)){
                unlink($pathName);
            } 
            $avatar->move('assets/users/'.$kunci, 'bride.png');
            $this->session->set('foto_bride', 1);
            echo 'uploadedbride';
            
        }else{
            $avatar = $sampul;
            $pathName = 'assets/users/'.$kunci.'/kita.png';
            if(file_exists($pathName)){
                unlink($pathName);
            } 
            $avatar->move('assets/users/'.$kunci, 'kita.png');
            $this->session->set('foto_sampul', 1);
            echo 'uploadedsampul';
        } 	


    }
     
    public function do_update_mempelai(){
         
        $datanyaSiapa = $this->request->getPost('datanyaSiapa'); //cara cepat pake variabel :)
        $data["nama_".$datanyaSiapa] = $this->request->getPost('nama');
        $data['nama_panggilan_'.$datanyaSiapa] = $this->request->getPost('nama_panggilan');
        $data['nama_ayah_'.$datanyaSiapa] = $this->request->getPost('nama_ayah');
        $data['nama_ibu_'.$datanyaSiapa] = $this->request->getPost('nama_ibu');

        $update = $this->AdminModel->update_mempelai($data);
        if($update){
        $session = session();
            $session->setFlashdata("success", "Data Mempelai Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Mempelai Gagal diupdate");
            echo 'gagal';
        }
    }

    public function do_update_musik(){
        
        if (!$this->validate([
			'musik' => [
				'rules' => 'uploaded[musik]'
                            . '|mime_in[musik,audio/mpeg,audio/mpg,audio/x-mpeg,audio/mp3]'
                            . '|max_size[musik,2048]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa file mp3',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				],
 			]
		])) {
		    $errors = $this->validate->getError();
			session()->setFlashdata("error", $errors);
			return redirect()->back()->withInput(); 
		}
        $musik = $this->request->getFile('musik');
        $kunci = $this->request->getPost('kunci');
        $path = 'assets/users/'.$kunci;
        if(!file_exists($path)){
            $create = mkdir('assets/users/'.$kunci, 0777,true);
        }
        $pathName = 'assets/users/'.$kunci.'/musik.mp3';
        if(file_exists($pathName)){
            unlink($pathName);
        } 
        if ($musik->isValid() && !$musik->hasMoved())
		{
		    $musik->move('assets/users/'.$kunci,'musik.mp3');
		    $session = session();
		    $session->setFlashdata("success", "Musik Berhasil diperbarui");
		}else{
		    $session = session();
			$session->setFlashdata("error", "Musik Gagal diupdate");
		}
		return redirect()->back()->withInput(); 
	}

    private function getMusicLibraryDir()
    {
        return FCPATH . 'assets/musik/library';
    }

    private function getMusicLibraryManifestPath()
    {
        return $this->getMusicLibraryDir() . '/library.json';
    }

    private function ensureMusicLibraryStorage()
    {
        $dir = $this->getMusicLibraryDir();
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $manifest = $this->getMusicLibraryManifestPath();
        if (! file_exists($manifest)) {
            file_put_contents($manifest, json_encode(new \stdClass(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    private function readMusicLibraryTitles()
    {
        $this->ensureMusicLibraryStorage();
        $raw = @file_get_contents($this->getMusicLibraryManifestPath());
        $decoded = json_decode((string) $raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function writeMusicLibraryTitles(array $titles)
    {
        $this->ensureMusicLibraryStorage();
        ksort($titles);
        file_put_contents(
            $this->getMusicLibraryManifestPath(),
            json_encode($titles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }

    private function getMusicLibraryTracks()
    {
        $titles = $this->readMusicLibraryTitles();
        $tracks = [];

        $defaultPath = FCPATH . 'assets/musik/musik.mp3';
        if (file_exists($defaultPath)) {
            $tracks['musik.mp3'] = [
                'key' => 'musik.mp3',
                'file' => 'musik.mp3',
                'title' => 'Musik Default',
                'path' => $defaultPath,
                'url' => base_url('assets/musik/musik.mp3'),
                'is_default' => true,
            ];
        }

        foreach (glob($this->getMusicLibraryDir() . '/*.mp3') ?: [] as $filePath) {
            $fileName = basename($filePath);
            $tracks['library/' . $fileName] = [
                'key' => 'library/' . $fileName,
                'file' => $fileName,
                'title' => $titles[$fileName] ?? ucwords(str_replace(['-', '_'], ' ', pathinfo($fileName, PATHINFO_FILENAME))),
                'path' => $filePath,
                'url' => base_url('assets/musik/library/' . $fileName),
                'is_default' => false,
            ];
        }

        return $tracks;
    }

    private function resolveMusicTrack($trackKey)
    {
        $tracks = $this->getMusicLibraryTracks();
        return $tracks[$trackKey] ?? null;
    }

    private function getQuoteLibraryPath()
    {
        return WRITEPATH . 'diulem/quote-library.json';
    }

    private function ensureQuoteLibraryStorage()
    {
        $dir = dirname($this->getQuoteLibraryPath());
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $path = $this->getQuoteLibraryPath();
        if (! file_exists($path)) {
            file_put_contents($path, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    private function getQuoteLibraryItems()
    {
        $this->ensureQuoteLibraryStorage();
        $raw = @file_get_contents($this->getQuoteLibraryPath());
        $decoded = json_decode((string) $raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function writeQuoteLibraryItems(array $items)
    {
        $this->ensureQuoteLibraryStorage();
        file_put_contents(
            $this->getQuoteLibraryPath(),
            json_encode(array_values($items), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }

    public function do_update_fitur(){
        $data['cerita'] = $this->request->getPost('cerita');
        $data['gallery'] = $this->request->getPost('album');
        $data['komen'] = $this->request->getPost('ucapan');
        $data['lokasi'] = $this->request->getPost('lokasi');
        $data['qrcode'] = $this->request->getPost('qrcode');
        $data['prokes'] = $this->request->getPost('prokes');
        $data['hadiah'] = $this->request->getPost('hadiah');
        $update = $this->AdminModel->update_fitur($data);
        if($update){
        $session = session();
            $session->setFlashdata("success", "Data Fitur Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Fitur Gagal diupdate");
            echo 'gagal';
        }
    }

    public function do_update_domain(){
        $domain = $this->request->getPost('domain');

        if($domain != ''){
            $cek = $this->AdminModel->cek_domain($domain); //cek dulu domain yg direkuest jika sdh ada maka feedback error
            if(count($cek) > 0){
                echo 'gagal';
                exit;
            }else{
                $update = $this->AdminModel->update_domain($domain);
                if($update){
                $session = session();
            $session->setFlashdata("success", "Data Domain Berhasil diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Data Domain Gagal diupdate");
            echo 'gagal';
        }
            }   
        }
    }
    public function tema()
	{
	    $data['categories'] = $this->AdminModel->get_categoryTema();
        $data['tema'] = $this->AdminModel->get_all_themes(); 
        $dariDB = $this->AdminModel->create_code(); 
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 1, 3);
        $kodeBarangSekarang = $nourut +1;
        $data['kode'] = $kodeBarangSekarang; 
        $data['title'] = 'Tampilan Undangan';
        $data['view'] = 'admin/tampilan';
		//load view home
		return view('admin/layout', $data);
    }
    public function tema_video()
	{
	    $data['categories'] = $this->AdminModel->get_categoryVideo();
        $data['tema'] = $this->AdminModel->get_all_themes_video(); 
        $data['title'] = 'Tampilan Undangan';
        $data['view'] = 'admin/tema_video';
		//load view home
		return view('admin/layout', $data);
    }
    public function do_aktif_tema()
	{
        $id = $this->request->getPost('id');
        $ganti = $this->AdminModel->aktif_tema($id);
        if($ganti){
         $session = session();
            $session->setFlashdata("success", "Tema Berhasil diaktifkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal diaktifkan");
            echo 'gagal';
        }
    }
    public function do_nonaktif_tema()
	{
        $id= $this->request->getPost('id');
        $ganti = $this->AdminModel->nonaktif_tema($id);
        if($ganti){
         $session = session();
            $session->setFlashdata("success", "Tema Berhasil dinonaktifkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal dinonaktifkan");
            echo 'gagal';
        }
    }
    
    
    public function upload_theme(){
        $view = $this->request->getFile('viewfile');
        $asset = $this->request->getFile('assetfile');
        $namafolder = $this->request->getPost('namatema');
        $pathassets = 'assets/themes/'.$namafolder;
        $pathview = ROOTPATH.'app/Views/undangan/themes/';
        $namaasset= $asset->getName();
        helper('filesystem');
        //cek folder e
        if(!file_exists($pathassets)){
            $create = mkdir('assets/themes/'.$namafolder, 0777,true);
            $view->move($pathview, $namafolder.'.php');
            

        $asset->move('assets/themes/', $namafolder.'.zip');
        $zip = new ZipArchive;
             $res = $zip->open('assets/themes/'.$namafolder.'.zip');
             if ($res === TRUE) {

              // Unzip path
              //$extractpath = 'assets/themes';
              $extractpath = 'assets/themes/'.$namafolder;

              // Extract file
              $zip->extractTo($extractpath);
              $zip->close();
              //rename($extractpath.'/, 'assets/themes/'.$namafolder);
              unlink('assets/themes/'.$namafolder.'.zip');
              $data['nama_theme'] = $this->request->getPost('namatema');
             $data['kode_theme'] =$this->request->getPost('kodetema');
             $data['category_id'] =$this->request->getPost('categories');
           $save = $this->AdminModel->save_themes($data);
           $session = session();
            $session->setFlashdata("success", "Tema Berhail diupload");
        return redirect()->to(base_url('admin/tema'));
        }

     }   

    }
    public function delete_theme()
	{
        $id = $this->request->getPost('id');
        $nama = $this->AdminModel->get_theme($id);
        helper('filesystem'); // load the helper
        
        unlink(ROOTPATH.'app/Views/undangan/themes/'.$nama.'.php');
        delete_files('assets/themes/'.$nama, true);
        $remove = rmdir('assets/themes/'.$nama);
        $hapus = $this->AdminModel->delete_theme($id);
        
        //delete_files(ROOTPATH.'app/Views/undangan/themes/'.$nama.'.php');
        //rmdir('assets/themes/'.$nama);
        if($hapus){
        $session = session();
            $session->setFlashdata("success", "Tema Berhail dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal dihapus");
            echo 'gagal';
        }
    }
    public function upload_theme_video(){
        $view = $this->request->getFile('viewfile');
        $namafile = strtolower(str_replace(" ", "_", $this->request->getPost('namatema')));
        
        $pathasset = 'assets/themes_video/';
        helper('filesystem');
            $view->move($pathasset, $namafile.'.png');
            $data['nama_tema'] = $this->request->getPost('namatema');
            $data['harga'] = $this->request->getPost('hargatema');
            $data['preview'] = $namafile.'.png';
            $data['url_video'] =$this->request->getPost('urltema');
            $data['category_id'] =$this->request->getPost('categories');        
           $save = $this->AdminModel->save_themes_video($data);
           $session = session();
            $session->setFlashdata("success", "Tema Berhail diupload");
        return redirect()->to(base_url('admin/tema_video'));
        
    }
    public function update_theme_video(){
        $id = $this->request->getPost('idTema');
        $view = $this->request->getFile('viewFile');
        $namafile = strtolower(str_replace(" ", "_", $this->request->getPost('namaTema')));
        $pathasset = 'assets/themes_video/';
        helper('filesystem');
        if(!empty($view->getName())){
            unlink($pathasset.''.$namafile.'.png');
            $view->move($pathasset, $namafile.'.png');
            $data['preview'] = $namafile.'.png';
        }
            $data['nama_tema'] = $this->request->getPost('namaTema');
            $data['harga'] = $this->request->getPost('hargaTema');
            $data['category_id'] = $this->request->getPost('kategoriTema');
            $data['url_video'] =$this->request->getPost('urlTema');
           $save = $this->AdminModel->update_themes_video($id, $data);
           $session = session();
            $session->setFlashdata("success", "Tema Berhail diupdate");
        return redirect()->to(base_url('admin/tema_video'));
        
    }
    public function delete_theme_video()
	{
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        helper('filesystem'); // load the helper
        unlink('assets/themes_video/'.$nama);
        $hapus = $this->AdminModel->delete_theme_video($id);

        if($hapus){
        $session = session();
            $session->setFlashdata("success", "Tema Berhail dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Tema Gagal dihapus");
            echo 'gagal';
        }
    }
    public function category_tema()
    {
        $data['categories'] = $this->AdminModel->get_categoryTema();
        $data['title'] = 'Data Kategori Tema Web';
        $data['view'] = 'admin/category_tema';
        
        return view('admin/layout', $data);
    }
    public function category_video()
    {
        $data['categories'] = $this->AdminModel->get_categoryVideo();
        $data['title'] = 'Data Kategori Tema Video';
        $data['view'] = 'admin/category_video';
        
        return view('admin/layout', $data);
    }
    public function add_categoryVideo(){
        $data['name'] = $this->request->getPost('nama');
        $data['slug'] = $this->request->getPost('slug');
        
        $save = $this->AdminModel->add_categoryVideo($data);
        if($save){
           $session = session();
            $session->setFlashdata("success", "Kategori Berhail ditambahkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Kategori Gagal ditambahkan");
            echo 'gagal';
        }
        return redirect()->to(base_url('admin/category_video'));
    }
    public function add_categoryTema(){
        $data['name'] = $this->request->getPost('nama');
        $data['slug'] = $this->request->getPost('slug');
        
        $save = $this->AdminModel->add_categoryTema($data);
        if($save){
           $session = session();
            $session->setFlashdata("success", "Kategori Berhail ditambahkan");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Kategori Gagal ditambahkan");
            echo 'gagal';
        }
        return redirect()->to(base_url('admin/category_tema'));
    }
    public function update_categoryTema(){
        $id = $this->request->getPost('idKategori');
        $data['name'] = $this->request->getPost('namaKategori');
        $data['slug'] = $this->request->getPost('slugKategori');
        
        $save = $this->AdminModel->update_categoryTema($id, $data);
        if($save){
           $session = session();
            $session->setFlashdata("success", "Kategori Berhail diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Kategori Gagal diupdate");
            echo 'gagal';
        }
        return redirect()->to(base_url('admin/category_tema'));
        
    }
    public function update_categoryVideo(){
        $id = $this->request->getPost('idKategori');
        $data['name'] = $this->request->getPost('namaKategori');
        $data['slug'] = $this->request->getPost('slugKategori');
        
        $save = $this->AdminModel->update_categoryVideo($id, $data);
        if($save){
           $session = session();
            $session->setFlashdata("success", "Kategori Berhail diupdate");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Kategori Gagal diupdate");
            echo 'gagal';
        }
        return redirect()->to(base_url('admin/category_video'));
    }
    public function delete_categoryVideo()
	{
        $id = $this->request->getPost('id');

        $hapus = $this->AdminModel->delete_categoryVideo($id);

        if($hapus){
        $session = session();
            $session->setFlashdata("success", "Kategori Berhail dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Kategori Gagal dihapus");
            echo 'gagal';
        }
    }
    public function delete_categoryTema()
	{
        $id = $this->request->getPost('id');

        $hapus = $this->AdminModel->delete_categoryTema($id);

        if($hapus){
        $session = session();
            $session->setFlashdata("success", "Kategori Berhail dihapus");
            echo 'sukses';
        }else{
            $session = session();
            $session->setFlashdata("error", "Kategori Gagal dihapus");
            echo 'gagal';
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

    private function normalizeWaProvider($provider){
        return in_array($provider, ['nusagateway', 'starsender', 'onesender'], true) ? $provider : 'nusagateway';
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

    private function buildWaTokenValue($token, $enabled){
        $cleanToken = $this->parseWaTokenValue((string) $token);
        return $enabled ? $cleanToken : '__disabled__:' . $cleanToken;
    }

    private function buildPaketPayload(){
        return [
            'nama_paket' => $this->request->getPost('nama_paket'),
            'harga_paket' => $this->request->getPost('harga_paket'),
            'masa_aktif' => $this->request->getPost('masa_aktif'),
            'buku_tamu' => !empty($this->request->getPost('setTamu')) ? 1 : 0,
            'kirim_whatsapp' => !empty($this->request->getPost('setKirim')) ? 1 : 0,
            'tema_bebas' => !empty($this->request->getPost('setTema')) ? 1 : 0,
            'kirim_hadiah' => !empty($this->request->getPost('setHadiah')) ? 1 : 0,
            'import_datatamu' => !empty($this->request->getPost('setImport')) ? 1 : 0,
        ];
    }

    private function send_wa($token, $phone, $message){
        foreach ($this->AdminModel->get_setting() as $row){
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
