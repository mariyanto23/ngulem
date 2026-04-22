(function (window, $) {
  'use strict';

  window.DiulemAdmin = {
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

    confirm: function (options) {
      var settings = $.extend({
        title: 'Konfirmasi',
        text: 'Apakah kamu yakin?',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        icon: 'warning'
      }, options || {});

      if (window.Swal) {
        return Swal.fire({
          title: settings.title,
          text: settings.text,
          icon: settings.icon,
          showCancelButton: true,
          confirmButtonColor: '#0f766e',
          cancelButtonColor: '#dc2626',
          confirmButtonText: settings.confirmButtonText,
          cancelButtonText: settings.cancelButtonText
        });
      }

      return $.Deferred().resolve({ value: confirm(settings.text) }).promise();
    },

    reload: function () {
      location.reload();
    },

    getElement: function (target) {
      if (!target) {
        return null;
      }

      if (target instanceof Element) {
        return target;
      }

      return document.querySelector(target.charAt(0) === '#' ? target : '#' + target);
    },

    showModal: function (target) {
      var element = this.getElement(target);

      if (!element || !window.bootstrap) {
        return;
      }

      bootstrap.Modal.getOrCreateInstance(element).show();
    },

    hideModal: function (target) {
      var element = this.getElement(target);

      if (!element || !window.bootstrap) {
        return;
      }

      bootstrap.Modal.getOrCreateInstance(element).hide();
    },

    reloadAfterSuccess: function (result, successMessage, errorMessage) {
      if (this.isSuccess(result)) {
        this.notify('success', 'Berhasil', successMessage).then(this.reload);
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
        $button.prop('disabled', true).html(loadingText || 'Memproses...');
        return;
      }

      $button.prop('disabled', false);
      if ($button.data('original-html')) {
        $button.html($button.data('original-html'));
      }
    },

    post: function (url, data, options) {
      var settings = $.extend({
        button: null,
        loadingText: '<i class="ti ti-loader me-2"></i>Memproses...',
        successMessage: 'Data berhasil diproses.',
        errorMessage: 'Data gagal diproses.',
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
          DiulemAdmin.reloadAfterSuccess(result, settings.successMessage, settings.errorMessage);
          return;
        }

        if (typeof settings.onSuccess === 'function') {
          settings.onSuccess(result);
          return;
        }

        if (DiulemAdmin.isSuccess(result)) {
          DiulemAdmin.notify('success', 'Berhasil', settings.successMessage);
          return;
        }

        DiulemAdmin.notify('error', 'Gagal', settings.errorMessage);
      }).fail(function () {
        DiulemAdmin.notify('error', 'Gagal', settings.errorMessage);
      }).always(function () {
        DiulemAdmin.setButtonLoading($button, false);
      });
    }
  };
})(window, jQuery);
