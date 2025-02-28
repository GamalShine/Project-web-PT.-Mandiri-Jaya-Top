<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <?php $this->load->view('partials/head'); // Include file head.php untuk mengambil semua elemen head ?>
</head>
<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo"></div>
    <div class="card">
      <div class="card-body login-card-body">
        <br>  
        <p class="login-box-msg">Selamat datang di Website penjualan PT. Madiri Jaya Top</p> <!-- Pesan selamat datang -->
        <br>
        <div class="alert alert-danger d-none"></div> <!-- Kotak peringatan kesalahan, awalnya disembunyikan -->
        <form>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required> <!-- Input username -->
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span> <!-- Ikon user -->
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required> <!-- Input password -->
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span> <!-- Ikon kunci -->
              </div>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-block btn-primary">Login</button> <!-- Tombol login -->
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $this->load->view('partials/footer'); // Include file footer.php untuk mengambil semua elemen footer ?>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script>
  // Validasi form menggunakan plugin jQuery Validate
  $('form').validate({
    errorElement: 'span',
    errorPlacement: (error, element) => {
      error.addClass('invalid-feedback');
      element.closest('.input-group').append(error);
    },
    submitHandler: () => {
      // Ajax request untuk mengirim data login
      $.ajax({
        url: '<?php echo site_url('login') ?>',
        type: 'post',
        dataType: 'json',
        data: $('form').serialize(),
        success: res => {
          if (res == 'tidakada') {
            $('.alert').html('Username tidak terdaftar'); // Menampilkan pesan kesalahan jika username tidak terdaftar
            $('.alert').removeClass('d-none');
          } else if (res == 'passwordsalah') {
            $('.alert').html('Password Salah'); // Menampilkan pesan kesalahan jika password salah
            $('.alert').removeClass('d-none');
          } else {
            $('.alert').html('Sukses');
            $('.alert').addClass('alert-success'); // Menampilkan pesan sukses jika login berhasil
            $('.alert').removeClass('d-none alert-danger');
            setTimeout(function() {
              window.location.reload(); // Reload halaman setelah 1 detik
            }, 1000);
          }
        },
        error: err => {
          console.log(err); // Log error jika terjadi kesalahan pada request
        }
      });
    }
  });
</script>
</body>
</html>
