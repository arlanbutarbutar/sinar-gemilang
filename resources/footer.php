<!--  footer -->
<div class="footer">
  <div class="copyright">
    <div class="col-md-12">
      <small class="text-white">Copyright © <?= date('Y') ?> <a style="cursor: pointer;" onclick="window.open('https://netmedia-framecode.com', '_blank')">Netmedia Framecode</a> . All rights reserved. Powered by Mario Adelino Bere Taek</small>
    </div>
  </div>
</div>
<!-- end footer -->
<!-- Javascript files-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<!-- sidebar -->
<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
  const messageSuccess = $('.message-success').data('message-success');
  const messageInfo = $('.message-info').data('message-info');
  const messageWarning = $('.message-warning').data('message-warning');
  const messageDanger = $('.message-danger').data('message-danger');

  if (messageSuccess) {
    Swal.fire({
      icon: 'success',
      title: 'Berhasil Terkirim',
      text: messageSuccess,
    })
  }

  if (messageInfo) {
    Swal.fire({
      icon: 'info',
      title: 'For your information',
      text: messageInfo,
    })
  }
  if (messageWarning) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan!!',
      text: messageWarning,
    })
  }
  if (messageDanger) {
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan',
      text: messageDanger,
    })
  }
</script>
<script>
  function openNav() {
    document.getElementById('mySidepanel').style.width = '250px';
  }

  function closeNav() {
    document.getElementById('mySidepanel').style.width = '0';
  }
</script>