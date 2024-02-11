<?php

include_once 'lib/Database.php';

class Register
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function addRegister($data, $file)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];


        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['photo']['name'];
        $file_size = $file['photo']['size'];
        $file_temp = $file['photo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "upload/" . $unique_image;

        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($file_name)) {
            $msg = "fields must not be empty";
            return $msg;
        } elseif ($file_size > 1048567) {
            $msg = "File size must be less than 1 mb";
            return $msg;
        } elseif (in_array($file_ext, $permited) == false) {
            $msg = "You can only upload" . implode(', ', $permited);
            return $msg;
        } else {
            move_uploaded_file($file_temp, $upload_image);
            $query = "INSERT INTO `tbl_register`(`name`, `email`, `phone`, `photo`, `address`) VALUES ('$name','$email','$phone','$upload_image','$address')";

            $result = $this->db->insert($query);

            if ($result) {
                $msg = 'Registration successfull';
                return $msg;
            } else {
                $msg = 'Registration failed';
                return $msg;
            }

        }
    }
    public function allStudent()
    {
        $query = "SELECT * FROM `tbl_register` ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getStdyId($id)
    {
        $query = "SELECT * FROM `tbl_register` WHERE id='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function UpdateStudent($data, $file, $id)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];


        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['photo']['name'];
        $file_size = $file['photo']['size'];
        $file_temp = $file['photo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "upload/" . $unique_image;

        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $msg = "fields must not be empty";
            return $msg;
        }
        if (!empty($file_name)) {
            if ($file_size > 1048567) {
                $msg = "File size must be less than 1 mb";
                return $msg;
            } elseif (in_array($file_ext, $permited) == false) {
                $msg = "You can only upload" . implode(', ', $permited);
                return $msg;
            } else {


                $img_query = "SELECT * FROM tbl_register WHERE id='$id'";
                $img_res = $this->db->select($img_query);
                if ($img_res) {
                    while ($row = mysqli_fetch_assoc($img_res)) {
                        $photo = $row['photo'];
                        unlink($photo);
                    }
                }

                move_uploaded_file($file_temp, $upload_image);

                $query = "UPDATE tbl_register SET name='$name',email='$email',phone = '$phone',photo = '$upload_image',address = '$address' WHERE id = '$id'";

                $result = $this->db->update($query);

                if ($result) {
                    $msg = 'Student Update successfull';
                    return $msg;
                } else {
                    $msg = 'Student Update failed';
                    return $msg;
                }
            }
        } else {


            $query = "UPDATE tbl_register SET name='$name',email='$email',phone = '$phone',address = '$address' WHERE id = '$id'";

            $result = $this->db->update($query);

            if ($result) {
                $msg = 'Student Update successfull';
                return $msg;
            } else {
                $msg = 'Student Update failed';
                return $msg;
            }
        }

    }


    // Delete Student

    public function delStudent($id)
    {
        $img_query = "SELECT * FROM tbl_register WHERE id='$id'";
        $img_res = $this->db->select($img_query);
        if ($img_res) {
            while ($row = mysqli_fetch_assoc($img_res)) {
                $photo = $row['photo'];
                unlink($photo);
            }
        }
        $del_query = "DELETE FROM tbl_register WHERE id='$id'";
        $del = $this->db->delete($del_query);
        if ($del) {
            $msg = 'Student Delete successfull';
            return $msg;
        } else {
            $msg = 'Delete failed';
            return $msg;
        }
    }
}


?>