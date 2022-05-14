<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.css'); ?>">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Halaman <?= $judul; ?></title>
</head>

<body>

    <?= $this->include('layout/navbar'); ?>

    <?= $this->renderSection('content'); ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('/js/jquery-3.6.0.min.js'); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="<?= base_url('/js/bootstrap.min.js'); ?>"></script>

    <!-- My Js -->
    <script>
        function previewImg() {
            const Sampul = document.querySelector('#sampul');
            const sampulLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            // menjalankan function upload gambar
            sampulLabel.textContent = sampul.files[0].name;

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }

        }
    </script>

</body>

</html>