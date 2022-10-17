  <!-- jQuery  -->
  <script src="{{ asset('assets/cms/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/cms/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/cms/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/cms/js/modernizr.min.js') }}"></script>
  <script src="{{ asset('assets/cms/js/detect.js') }}"></script>
  <script src="{{ asset('assets/cms/js/fastclick.js') }}"></script>
  <script src="{{ asset('assets/cms/js/jquery.slimscroll.js') }}"></script>
  <script src="{{ asset('assets/cms/js/jquery.blockUI.js') }}"></script>
  <script src="{{ asset('assets/cms/js/waves.js') }}"></script>
  <script src="{{ asset('assets/cms/js/jquery.nicescroll.js') }}"></script>
  <script src="{{ asset('assets/cms/js/jquery.scrollTo.min.js') }}"></script>

  <script src="{{ asset('assets/cms/plugins/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/cms/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
  <!-- Alertify js -->
  <script src="{{ asset('assets/cms/plugins/alertify/js/alertify.js') }}"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- App js -->
  <script src="{{ asset('assets/cms/js/app.js') }}"></script>
  {{-- Fontawesome --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
      integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  {{-- Selec2 --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  {{-- Dropify --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
      integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  {{-- Mask Money --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
      integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  {{-- Jquery UI --}}
  <script src="{{ asset('assets/cms/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  {{-- SummerNote --}}
  <script src="{{ asset('assets/cms/plugins/summernote/summernote-bs4.min.js') }}"></script>
  {{-- Moment --}}
  <script src="{{ asset('assets/cms/plugins/moment/moment.js') }}"></script>
  {{-- Full Calendar --}}
  <script src='{{ asset('assets/cms/plugins/fullcalendar/js/fullcalendar.min.js') }}'></script>


  <script>
      alertify.logPosition("top right");
      $('.required').on('blur', function() {
          $(this).removeClass('error');
      })

      $('.form-group').not('.summernote').on('keyup', function(e) {
          if (e.keyCode === 13) {
              store()
          }
      })


      function overlay(state = false) {
          if (state) {
              $('#loading').show();
          } else {
              $('#loading').hide();
          }
      }

      function refreshState(el = null, clearing = true) {
          if (el == null) {
              $('.is-invalid').removeClass('is-invalid');
              $('.select2-container').removeClass('is-invalid');
          } else {

              $(el).find('.is-invalid').removeClass('is-invalid');
              $(el).find('.select2-container').removeClass('is-invalid');
              $(el).find('div').not('.readonly').removeClass('disabled');
          }
          $('.dropify-clear').click();
          $(el).find('.form-control').each(function() {
              $(this).removeClass('is-invalid');
          })

          if (clearing) {
              clear(el);
              $(el).find('.form-control').each(function() {
                  $(this).val('');
              })
          }

      }

      function debounce(func, wait, immediate) {
          var timeout;
          return function() {
              var context = this,
                  args = arguments;
              var later = function() {
                  timeout = null;
                  if (!immediate) func.apply(context, args);
              };
              var callNow = immediate && !timeout;
              clearTimeout(timeout);
              timeout = setTimeout(later, wait);
              if (callNow) func.apply(context, args);
          };
      };

      // Untuk menghapus value dengan class required
      function clear(el = null, removeId = true) {
          $('.required').each(function() {
              $(this).removeClass('is-invalid');
              $(this).val('');
          })

          if (el == null) {
              $('.select2').trigger('change.select2')
              $('.ajax-select').val(null).trigger('change');
          } else {
              $(el).find('.select2').trigger('change.select2')
              $(el).find('.ajax-select').val(null).trigger('change');
          }

          if (removeId) {
              $('#id').val('');
          }
      }

      $(document).on('focus', '.form-control', function() {
          $(this).removeClass('is-invalid');
      })

      $(document).on('change', '.select2', function() {
          var par = $(this).parents('.parent');
          $(this).removeClass('is-invalid');
          $(par).find('.select2-container').removeClass('is-invalid');
      })

      $(document).on('change', '.select2filter', function() {
          var par = $(this).parents('.parent');
          $(this).removeClass('is-invalid');
          $(par).find('.select2-container').removeClass('is-invalid');
      })
  </script>
