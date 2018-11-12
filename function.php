<?php
    //membuat koneksi
    $conn=mysqli_connect("localhost","root","","phpdatabase");
    //Cek koneksi
    if(!$conn)
    {
        die('Koneksi Error : '.mysqli_connect_errno()
        .' - '.mysqli_connect_error());
    }
    //ambil data dari tabel mahasiswa/query data mahasiswa
    $result=mysqli_query($conn,"SELECT * FROM mahasiswa1 ");
    
    //function query
    function query($query_kedua)
    {
        global $conn;
        $result = mysqli_query($conn,$query_kedua);
        $rows =[];
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[]=$row;
        }
        return $rows;
    }

    function tambah($data)
    {
        global $conn;

        $nama=$_POST["nama"];
        $nim=$_POST["nim"];
        $email=$_POST["email"];
        $jurusan=$_POST["jurusan"];
        $gambar=$_POST["gambar"];

        $query= "INSERT INTO mahasiswa1 VALUES
                ('','$nama','$nim','$email','$jurusan','$gambar')";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }

    function Hapus($id)
    {
        global $conn;
        mysqli_query($conn,"DELETE FROM mahasiswa1 WHERE id=$id ");
        return mysqli_affected_rows($conn);
    }

    function edit($data)
    {
        global $conn;

        $id=$data["id"];
        $nama=htmlspecialchars($data["nama"]);
        $nim=htmlspecialchars($data["nim"]);
        $email=htmlspecialchars($data["email"]);
        $jurusan=htmlspecialchars($data["jurusan"]);
        $gambar=htmlspecialchars($data["gambar"]);

        $query = " UPDATE mahasiswa1 SET
                    nama = '$nama',
                    nim = '$nim',
                    email = '$email', 
                    jurusan = '$jurusan', 
                    gambar = '$gambar' 
                    where id = $id ";
        mysqli_query($conn,$query);

        return mysqli_affected_rows($conn);
    }

    function cari($keyword)
    {
        $sql="SELECT * FROM mahasiswa1
              WHERE 
              nama like '%$keyword%' OR
              nim like '%$keyword%' OR
              email like '%$keyword%' OR
              jurusan like '%$keyword%' 
              ";
        return query($sql);
    }
?>