(function (window, $) {
  'use strict';

  window.DiulemDashboard = {
    isSuccess: function (result) {
      return $.trim(result) === 'sukses';
    },

    notify: function (type, title, text) {
      if (window.Swal) {
        return Swal.fire({
          icon: type,
          title: title,
          text: text
        });
      }

      alert(text || title);
      return $.Deferred().resolve().promise();
    },

    reloadAfterSuccess: function (result, successMessage, errorMessage) {
      if (this.isSuccess(result)) {
        this.notify('success', 'Berhasil', successMessage).then(function () {
          location.reload();
        });
        return true;
      }

      this.notify('error', 'Gagal', errorMessage);
      return false;
    },

    setButtonLoading: function ($button, isLoading, loadingText) {
      if (!$button || !$button.length) {
        return;
      }

      if (isLoading) {
        $button.data('original-html', $button.html());
        $button.prop('disabled', true).html(loadingText || 'Menyimpan...');
        return;
      }

      $button.prop('disabled', false);
      if ($button.data('original-html')) {
        $button.html($button.data('original-html'));
      }
    }
  };
})(window, jQuery);
