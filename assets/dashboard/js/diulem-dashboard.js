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

    post: function (url, data, options) {
      var settings = $.extend({
        button: null,
        loadingText: '<i class="ti ti-loader me-2"></i>Menyimpan...',
        successMessage: 'Data berhasil disimpan.',
        errorMessage: 'Data gagal disimpan.',
        reload: true,
        dataType: 'html'
      }, options || {});
      var $button = settings.button ? $(settings.button) : null;

      this.setButtonLoading($button, true, settings.loadingText);

      return $.ajax({
        url: url,
        method: 'POST',
        data: data,
        async: true,
        dataType: settings.dataType
      }).done(function (result) {
        if (settings.reload) {
          DiulemDashboard.reloadAfterSuccess(result, settings.successMessage, settings.errorMessage);
          return;
        }

        if (DiulemDashboard.isSuccess(result)) {
          DiulemDashboard.notify('success', 'Berhasil', settings.successMessage);
          return;
        }

        DiulemDashboard.notify('error', 'Gagal', settings.errorMessage);
      }).fail(function () {
        DiulemDashboard.notify('error', 'Gagal', settings.errorMessage);
      }).always(function () {
        DiulemDashboard.setButtonLoading($button, false);
      });
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
