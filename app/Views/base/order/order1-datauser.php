<div class="konten order-page">
    <section class="fdb-block">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6 order-panel">
            <div class="order-hero">
              <div class="order-step-badge">Langkah 1 dari 6</div>
              <h1>Mulai Undangan</h1>
              <p>Masukkan data dasar akun dan pilih paket yang paling cocok dulu.</p>
            </div>

            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 8%;" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100">8%</div>
            </div>

            <?php if (!empty($order_email_notice)) { ?>
            <div class="order-inline-note" style="margin-bottom:18px;">
              <?= esc($order_email_notice) ?>
            </div>
            <?php } ?>

            <?php if (!empty($order_email_error)) { ?>
            <div class="order-inline-note" style="margin-bottom:18px;border-color:#fecaca;background:#fff1f2;color:#991b1b;">
              <?= esc($order_email_error) ?>
            </div>
            <?php } ?>

            <?php if (!empty($order_email_verified_notice)) { ?>
            <div class="order-inline-note" style="margin-bottom:18px;border-color:#bbf7d0;background:#f0fdf4;color:#166534;">
              <?= esc($order_email_verified_notice) ?>
            </div>
            <?php } ?>

            <?php if (!empty($order_form_error)) { ?>
            <div class="order-inline-note" style="margin-bottom:18px;border-color:#fecaca;background:#fff1f2;color:#991b1b;">
              <?= esc($order_form_error) ?>
            </div>
            <?php } ?>

            <form id="order-step1-form" action="<?php echo base_url('order/2') ?>" method="post">
            <div class="row align-items-center mt-3"> 
              <div class="col">
                <label>Paket Undangan</label>
                <select class="form-control" id="id_paket" name="id_paket" required>
                    <option value=''>--Pilihan Paket Undangan--</option>
                    <?php foreach ($paket as $row) : ?>
                <?php $hargaPaket = (int) $row->harga_paket; ?>
                    <?php if ($row->id_paket == $id_paket) { ?>
                    <option value="<?= $row->id_paket ?>" selected><?= $hargaPaket <= 0 ? '[GRATIS] ' : '' ?>Paket <?= $row->nama_paket ?> - Harga <?= $hargaPaket <= 0 ? 'Gratis' : 'Rp ' . number_format($hargaPaket) ?></option>
                        <?php } else { ?>
                    <option value="<?= $row->id_paket ?>"><?= $hargaPaket <= 0 ? '[GRATIS] ' : '' ?>Paket <?= $row->nama_paket ?> - Harga <?= $hargaPaket <= 0 ? 'Gratis' : 'Rp ' . number_format($hargaPaket) ?></option>
                        <?php
                            }
                    endforeach; ?>
                </select>
                <small class="form-text text-muted">Paket gratis akan langsung aktif tanpa pembayaran.</small>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col mt-4">
                <label>Nama Domain / URL Undangan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3"><?= DOMAIN_UNDANGAN ?>/</span>
                  </div>
                  <input name="domain" type="text" class="form-control" placeholder="akudandia"  value="<?php echo $domain; ?>"  onkeyup="nospaces(this)" required>
                </div>
                
              </div>
            </div>
            <div class="row align-items-center mt-3"> 
              <div class="col">
                <label>Email</label>
                <div class="input-group">
                  <input name="email" id="order-email-input" type="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" required>
                  <div class="input-group-append">
                    <button type="submit"
                            id="order-request-email-button"
                            class="btn btn-secondary"
                            formaction="<?= base_url('order/request-email-code') ?>"
                            formmethod="post">
                      <span class="order-btn-label">Verifikasi Email</span>
                    </button>
                  </div>
                </div>
                <small class="form-text text-muted">Kirim kode verifikasi ke email ini dulu sebelum lanjut ke langkah berikutnya.</small>
                <?php if (!empty($order_email_verified_current)) { ?>
                <small id="order-email-verified-state" class="form-text" style="color:#166534;font-weight:600;">Email ini sudah terverifikasi.</small>
                <?php } else { ?>
                <small id="order-email-verified-state" class="form-text text-muted">Email belum diverifikasi.</small>
                <?php } ?>
              </div>
            </div>
            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="Minimal 8 karakter" value="<?php echo $password; ?>" required>
                <small class="form-text text-muted">Password ini nanti dipakai untuk login ke dashboard undangan.</small>
              </div>
            </div>
            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Nomor HP / WhatsApp</label>
                <input name="hp" type="text" class="form-control" placeholder="Contoh: 628123456789" value="<?php echo $hp; ?>" required>
              </div>
            </div>
            <div class="row justify-content-start mt-4 order-actions">
              <div class="col">
                <div class="row">
                  <div class="col">
                    <input id="order-next-button"
                           class="btn btn-primary btn-order btn-block"
                           type="submit"
                           name="submit"
                           value="Lanjut"
                           <?= empty($order_email_verified_current) ? 'disabled' : '' ?>>
                  </div>
                </div>

                <div class="form-check mt-4 text-center">
                  <input class="form-check-input"
                         type="checkbox"
                         value="1"
                         id="agree_terms"
                         name="agree_terms">
                  <label class="form-check-label" for="agree_terms">
                      Saya menyetujui <a href="<?= base_url('syarat-ketentuan') ?>" target="_blank" rel="noopener noreferrer">syarat dan ketentuan</a>.
                  </label>
                </div>
                
              </div>
            </div>
            </form>

            <?php if (!empty($order_email_verification_pending) && !empty($order_email_verification_email)) { ?>
            <div class="order-code-card" style="margin-top:22px;">
              <div class="order-code-label">Verifikasi Email</div>
              <div class="text-muted" style="margin-bottom:14px;">Kami sudah mengirim kode 6 digit ke <strong><?= esc($order_email_verification_email) ?></strong>. Masukkan kodenya untuk lanjut ke langkah berikutnya.</div>
              <div id="order-email-countdown"
                   class="text-muted"
                   data-expires-at="<?= (int) $order_email_verification_expires_at ?>"
                   style="margin-bottom:14px;font-size:13px;">
                Kode verifikasi sedang disiapkan...
              </div>
              <form id="order-verify-email-form" action="<?= base_url('order/verify-email') ?>" method="post">
                <div class="row align-items-end">
                  <div class="col-sm-8">
                    <label>Kode Verifikasi</label>
                    <input type="text"
                           id="verification_code"
                           name="verification_code"
                           class="form-control"
                           placeholder="Masukkan 6 digit kode email"
                           inputmode="numeric"
                           autocomplete="one-time-code"
                           maxlength="6"
                           pattern="[0-9]{6}"
                           required>
                  </div>
                  <div class="col-sm-4" style="margin-top:12px;">
                    <button type="submit" id="order-verify-email-button" class="btn btn-primary btn-order btn-block">
                      <span class="order-btn-label">Verifikasi</span>
                    </button>
                  </div>
                </div>
              </form>
              <form id="order-resend-email-form" action="<?= base_url('order/resend-email-code') ?>" method="post" style="margin-top:12px;">
                <button type="submit" id="order-resend-email-button" class="btn btn-secondary btn-order btn-block">
                  <span class="order-btn-label">Kirim Ulang Kode</span>
                </button>
              </form>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var orderForm = document.getElementById('order-step1-form');
  var requestEmailButton = document.getElementById('order-request-email-button');
  var verifyEmailForm = document.getElementById('order-verify-email-form');
  var verifyEmailButton = document.getElementById('order-verify-email-button');
  var resendEmailForm = document.getElementById('order-resend-email-form');
  var resendEmailButton = document.getElementById('order-resend-email-button');
  var otpInput = document.getElementById('verification_code');
  var countdown = document.getElementById('order-email-countdown');
  var emailInput = document.getElementById('order-email-input');
  var nextButton = document.getElementById('order-next-button');
  var verifiedState = document.getElementById('order-email-verified-state');
  var agreeTerms = document.getElementById('agree_terms');
  var verifiedEmail = <?= json_encode((string) ($email ?? '')) ?>;
  var isVerified = <?= !empty($order_email_verified_current) ? 'true' : 'false' ?>;

  function setButtonLoading(button, loadingText, shouldDisable) {
    if (!button || button.disabled) {
      return;
    }

    if (shouldDisable !== false) {
      button.disabled = true;
    } else {
      button.style.pointerEvents = 'none';
      button.style.opacity = '0.85';
    }

    if (button.tagName === 'INPUT') {
      button.dataset.originalValue = button.value;
      button.value = loadingText;
      return;
    }

    var label = button.querySelector('.order-btn-label');
    if (label) {
      label.dataset.originalText = label.textContent;
      label.textContent = loadingText;
    } else {
      button.dataset.originalText = button.textContent;
      button.textContent = loadingText;
    }
  }

  function syncEmailVerificationState() {
    if (!emailInput || !nextButton || !verifiedState) {
      return;
    }

    var currentEmail = (emailInput.value || '').trim().toLowerCase();
    var verifiedCurrent = isVerified && currentEmail !== '' && currentEmail === verifiedEmail.toLowerCase();

    nextButton.disabled = !verifiedCurrent;
    if (verifiedCurrent) {
      verifiedState.textContent = 'Email ini sudah terverifikasi.';
      verifiedState.style.color = '#166534';
      verifiedState.style.fontWeight = '600';
    } else {
      verifiedState.textContent = 'Email belum diverifikasi.';
      verifiedState.style.color = '';
      verifiedState.style.fontWeight = '';
    }
  }

  if (emailInput) {
    emailInput.addEventListener('input', syncEmailVerificationState);
    syncEmailVerificationState();
  }

  if (orderForm) {
    orderForm.addEventListener('submit', function (event) {
      if (requestEmailButton && event.submitter === requestEmailButton) {
        setButtonLoading(requestEmailButton, 'Mengirim...', false);
        return;
      }

      if (!nextButton || event.submitter !== nextButton) {
        return;
      }

      if (nextButton.disabled) {
        event.preventDefault();
        return;
      }

      if (agreeTerms && !agreeTerms.checked) {
        event.preventDefault();
        agreeTerms.focus();
        alert('Centang dulu syarat dan ketentuan sebelum lanjut ya.');
        return;
      }

      setButtonLoading(nextButton, 'Memproses...');
    });
  }

  if (verifyEmailForm) {
    verifyEmailForm.addEventListener('submit', function () {
      setButtonLoading(verifyEmailButton, 'Memverifikasi...');
    });
  }

  if (resendEmailForm) {
    resendEmailForm.addEventListener('submit', function () {
      setButtonLoading(resendEmailButton, 'Mengirim Ulang...');
    });
  }

  if (otpInput) {
    otpInput.focus();
    otpInput.addEventListener('input', function () {
      this.value = this.value.replace(/\D/g, '').slice(0, 6);
    });
  }

  if (!countdown) {
    return;
  }

  var expiresAt = parseInt(countdown.getAttribute('data-expires-at') || '0', 10);
  if (!expiresAt) {
    countdown.textContent = 'Kode verifikasi aktif sementara. Silakan cek email kamu.';
    return;
  }

  function renderCountdown() {
    var remaining = expiresAt - Math.floor(Date.now() / 1000);

    if (remaining <= 0) {
      countdown.textContent = 'Kode verifikasi sudah kedaluwarsa. Klik "Kirim Ulang Kode" untuk meminta kode baru.';
      countdown.style.color = '#b91c1c';
      return false;
    }

    var minutes = Math.floor(remaining / 60);
    var seconds = remaining % 60;
    countdown.textContent = 'Kode berlaku ' + minutes + ':' + String(seconds).padStart(2, '0') + ' lagi.';
    return true;
  }

  if (renderCountdown()) {
    var timer = setInterval(function () {
      if (!renderCountdown()) {
        clearInterval(timer);
      }
    }, 1000);
  }
});
</script>
