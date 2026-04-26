(function (window, $) {
  'use strict';

  var lastNotificationKey = null;
  var lastNotificationAt = 0;

  window.DiulemDashboard = {
    isSuccess: function (result) {
      return $.trim(result) === 'sukses';
    },

    notify: function (type, title, text) {
      var notificationKey = [type || '', title || '', text || ''].join('|');
      var now = Date.now();

      if (lastNotificationKey === notificationKey && now - lastNotificationAt < 1500) {
        return $.Deferred().resolve().promise();
      }

      lastNotificationKey = notificationKey;
      lastNotificationAt = now;

      if (window.Swal) {
        if (Swal.isVisible()) {
          Swal.close();
        }

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

    suppressNextFlash: function (type, text) {
      if (!window.sessionStorage) {
        return;
      }

      sessionStorage.setItem('diulemDashboardSuppressFlash', JSON.stringify({
        type: type || '',
        text: text || ''
      }));
    },

    shouldShowFlash: function (type, text) {
      if (!window.sessionStorage) {
        return true;
      }

      var raw = sessionStorage.getItem('diulemDashboardSuppressFlash');
      if (!raw) {
        return true;
      }

      sessionStorage.removeItem('diulemDashboardSuppressFlash');

      try {
        var saved = JSON.parse(raw);
        return !(saved.type === (type || '') && saved.text === (text || ''));
      } catch (error) {
        return true;
      }
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

      if (!element) {
        return;
      }

      if (window.bootstrap && window.bootstrap.Modal) {
        bootstrap.Modal.getOrCreateInstance(element).show();
        return;
      }

      if (window.jQuery && typeof window.jQuery(element).modal === 'function') {
        window.jQuery(element).modal('show');
      }
    },

    hideModal: function (target) {
      var element = this.getElement(target);

      if (!element) {
        return;
      }

      if (window.bootstrap && window.bootstrap.Modal) {
        bootstrap.Modal.getOrCreateInstance(element).hide();
        return;
      }

      if (window.jQuery && typeof window.jQuery(element).modal === 'function') {
        window.jQuery(element).modal('hide');
      }
    },

    reloadAfterSuccess: function (result, successMessage, errorMessage) {
      if (this.isSuccess(result)) {
        this.notify('success', 'Berhasil', successMessage).then(function () {
          DiulemDashboard.suppressNextFlash('success', successMessage);
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

        if (typeof settings.onSuccess === 'function') {
          settings.onSuccess(result);
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
