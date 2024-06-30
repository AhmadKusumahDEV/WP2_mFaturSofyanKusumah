<html>

<head>
    <title>Form Input Matakuliah</title>
</head>

<body>
    <center>
        <form action="<?= base_url('/biodata/save'); ?>" method="post">
            <table>
                <tr>
                    <th colspan="3">
                        Form Input Data BioData
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <th>nim</th>
                    <th>:</th>
                    <td>
                        <input type="text" name="nim" id="kode">
                    </td>
                </tr>
                <tr>
                    <th>Nama </th>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama" id="nama">
                    </td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>
                        <input type="text" name="alamat" id="nama">
                    </td>
                </tr>
                <tr>
                    <th>email</th>
                    <td>:</td>
                    <td>
                        <input type="text" name="email" id="nama">
                    </td>
                </tr>
                <tr>
                    <th>Hobby</th>
                    <td>:</td>
                    <td>
                        <select name="hobby" id="sks">
                            <option value="">Pilih hobby</option>
                            <option value="olahraga">olahraga</option>
                            <option value="jalan-jalan">jalan-jalan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" value="Simpan">
                        <td colspan="3" align="center">
                    <a href="<?= base_url('biodata');?>">batal </a>
                </td>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>

</html>