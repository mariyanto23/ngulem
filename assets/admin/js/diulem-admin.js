(function (window, $) {
  'use strict';

  var lastNotificationKey = null;
  var lastNotificationAt = 0;

  window.DiulemAdmin = {
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

      sessionStorage.setItem('diulemAdminSuppressFlash', JSON.stringify({
        type: type || '',
        text: text || '',
        suppressAnyText: true
      }));
    },

    shouldShowFlash: function (type, text) {
      if (!window.sessionStorage) {
        return true;
      }

      var raw = sessionStorage.getItem('diulemAdminSuppressFlash');
      if (!raw) {
        return true;
      }

      sessionStorage.removeItem('diulemAdminSuppressFlash');

      try {
        var saved = JSON.parse(raw);
        if (saved.type !== (type || '')) {
          return true;
        }

        if (saved.suppressAnyText) {
          return false;
        }

        return saved.text !== (text || '');
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

    enhanceTables: function (selectors) {
      var tableSelectors = Array.isArray(selectors) ? selectors : [selectors];

      tableSelectors.forEach(function (selector) {
        var table = document.querySelector(selector);

        if (!table || table.dataset.diulemEnhanced === 'true') {
          return;
        }

        var tbody = table.tBodies[0];
        if (!tbody) {
          return;
        }

        table.dataset.diulemEnhanced = 'true';

        var rows = Array.prototype.slice.call(tbody.rows);
        var state = {
          page: 1,
          perPage: 10,
          query: ''
        };

        var toolbar = document.createElement('div');
        toolbar.className = 'diulem-admin-table-toolbar';
        toolbar.innerHTML = [
          '<label class="diulem-admin-table-length">Tampilkan',
          '<select class="form-select form-select-sm" aria-label="Jumlah data">',
          '<option value="10">10</option>',
          '<option value="25">25</option>',
          '<option value="50">50</option>',
          '<option value="100">100</option>',
          '</select>',
          '<span>data</span>',
          '</label>',
          '<div class="input-icon diulem-admin-table-search">',
          '<span class="input-icon-addon"><i class="ti ti-search"></i></span>',
          '<input type="search" class="form-control form-control-sm" placeholder="Cari data..." aria-label="Cari data">',
          '</div>'
        ].join('');

        var footer = document.createElement('div');
        footer.className = 'diulem-admin-table-footer';
        footer.innerHTML = [
          '<div class="text-secondary small diulem-admin-table-info"></div>',
          '<div class="btn-list diulem-admin-table-pagination">',
          '<button type="button" class="btn btn-sm btn-outline-secondary" data-page="prev">Sebelumnya</button>',
          '<button type="button" class="btn btn-sm btn-outline-secondary" data-page="next">Selanjutnya</button>',
          '</div>'
        ].join('');

        var tableContainer = table.closest('.table-responsive') || table.parentNode;
        tableContainer.parentNode.insertBefore(toolbar, tableContainer);
        tableContainer.parentNode.insertBefore(footer, tableContainer.nextSibling);

        var lengthSelect = toolbar.querySelector('select');
        var searchInput = toolbar.querySelector('input');
        var info = footer.querySelector('.diulem-admin-table-info');
        var prevButton = footer.querySelector('[data-page="prev"]');
        var nextButton = footer.querySelector('[data-page="next"]');

        function render() {
          var filteredRows = rows.filter(function (row) {
            return row.textContent.toLowerCase().indexOf(state.query) !== -1;
          });
          var total = filteredRows.length;
          var totalPages = Math.max(1, Math.ceil(total / state.perPage));

          if (state.page > totalPages) {
            state.page = totalPages;
          }

          var start = total === 0 ? 0 : (state.page - 1) * state.perPage + 1;
          var end = Math.min(state.page * state.perPage, total);

          rows.forEach(function (row) {
            row.hidden = true;
          });

          filteredRows.slice(start ? start - 1 : 0, end).forEach(function (row) {
            row.hidden = false;
          });

          info.textContent = total === 0
            ? 'Belum ada data'
            : 'Menampilkan ' + start + ' sampai ' + end + ' dari ' + total + ' data';

          prevButton.disabled = state.page <= 1;
          nextButton.disabled = state.page >= totalPages;
        }

        lengthSelect.addEventListener('change', function () {
          state.perPage = parseInt(this.value, 10) || 10;
          state.page = 1;
          render();
        });

        searchInput.addEventListener('input', function () {
          state.query = this.value.trim().toLowerCase();
          state.page = 1;
          render();
        });

        prevButton.addEventListener('click', function () {
          if (state.page > 1) {
            state.page -= 1;
            render();
          }
        });

        nextButton.addEventListener('click', function () {
          state.page += 1;
          render();
        });

        render();
      });
    },

    reloadAfterSuccess: function (result, successMessage, errorMessage) {
      if (this.isSuccess(result)) {
        this.notify('success', 'Berhasil', successMessage).then(function () {
          DiulemAdmin.suppressNextFlash('success', successMessage);
          DiulemAdmin.reload();
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
      var ajaxOptions = {
        url: url,
        method: 'POST',
        data: data,
        async: true,
        dataType: settings.dataType
      };

      if (window.FormData && data instanceof FormData) {
        ajaxOptions.processData = false;
        ajaxOptions.contentType = false;
      }

      this.setButtonLoading($button, true, settings.loadingText);

      return $.ajax(ajaxOptions).done(function (result) {
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
