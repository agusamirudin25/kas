<?php
class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllData()
    {
        $allData = [];
        $this->db->query(" SELECT u.id_user, u.user_name, u.user_type, p.nama_pengurus 
            from user u, pengurus p WHERE u.no_pengurus = p.no_pengurus and u.user_type != 0  ORDER BY u.id_user DESC ");
        $allData = $this->db->resultset();
        for ($i = 0; $i < count($allData); $i++) {
            $user_type_loop = $allData[$i]["user_type"];
            if ($user_type_loop == ADMIN_USR) {
                $user_type_loop = "Admin";
            } else if ($user_type_loop == BENDAHARA_USR) {
                $user_type_loop = "Bendahara";
            } else if ($user_type_loop == KEPALA_USR) {
                $user_type_loop = "Pengurus";
            } else if ($user_type_loop == MASTER_USR) {
                $user_type_loop = "Master";
            } else {
                $user_type_loop = "Invalid Format";
            }
            $allData[$i]["user_type"] = $user_type_loop;
        }
        return $allData;
    }

    public function getOneDataById($id)
    {
        $this->db->query(" SELECT * from user WHERE id_user =:id_user  ");
        $this->db->bind('id_user', $id);
        return $this->db->single();
    }

    public function tambahData($data)
    {
        $query = " INSERT INTO user 
                    (id_user, user_name, password, user_type, no_pengurus)
                    VALUES
                    ('', :user_name, :password, :user_type, :no_pengurus)
                ";
        $this->db->query($query);
        $this->db->bind('user_name', $data['user_name']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('user_type', $data['user_type']);
        $this->db->bind('no_pengurus', $data['no_pengurus']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahData($data)
    {
        
        $query = " UPDATE user SET 
                        user_name   =:user_name,
                        password    =:password,
                        user_type   =:user_type,
                        no_pengurus  =:no_pengurus 
                    WHERE 
                    id_user  =:id_user
                ";

        $this->db->query($query);
        $this->db->bind('user_name', $data['user_name']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('user_type', $data['user_type']);
        $this->db->bind('no_pengurus', $data['no_pengurus']);
        $this->db->bind('id_user', $data['id_user']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusData($id_user)
    {
        $query = " DELETE FROM user WHERE id_user=:id_user ";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function prosessLogin($data)
    {
        $allData = [];
        $query = " SELECT count(*) AS CountData FROM user WHERE user_name =:user_name AND password =:password ";
        // $query = " SELECT * FROM user WHERE user_name =:user_name AND password =:password ";

        $this->db->query($query);
        $this->db->bind('user_name', $data['user_name']);
        $this->db->bind('password', $data['password']);
        $allData = $this->db->single();
        return $allData;
    }

    public function prosessLoginGetData($data)
    {
        $allData = [];
        // $query = " SELECT count(*) AS CountData FROM user WHERE user_name =:user_name AND password =:password ";
        $query = " SELECT * FROM user WHERE user_name =:user_name AND password =:password ";

        $this->db->query($query);
        $this->db->bind('user_name', $data['user_name']);
        $this->db->bind('password', $data['password']);
        $allData = $this->db->single();
        return $allData;
    }
}
