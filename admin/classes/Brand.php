<?php 
    include 'lib/Database.php';
    include '../helpers/Format.php';
 ?>

<?php 
    
    class Brand{
        private $db;
        private $fm;
        function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }


        // Insert brand Item into Database
        public function brandInsert($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if (empty($brandName)) {
                $msg = "<div class='alert alert-warning'>Field must not be empty!</div>";
                return $msg;
            }else{

                $selectExist = "SELECT * FROM tbl_brand WHERE brandName='$brandName'";
                $result      = $this->db->select($selectExist);
                if ($result != false) {
                    $msg = "<div class='alert alert-warning'>Your Brand already exist</div>";
                    return $msg;
                }else{
                    $query  = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                    $insert = $this->db->insert($query);
                    if ($insert) {
                        $msg = "<div class='alert alert-success'>Brand inserted Successfully!</div>";
                        return $msg;
                    }else{
                        $msg = "Category Not inserted Successfully";
                        return $msg;
                    }
                }
            }
        }


        // Select all Brand
        public function getAllBrand(){
            $query  = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $select = $this->db->select($query);
            return $select;
        }

        // Update Brand
        public function brandUpdate($brandName, $brandId){
            $select = "SELECT * FROM tbl_brand WHERE brandName='$brandName'";
            $result = $this->db->select($select);
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if ($result != false) {
                $msg = "<div class='alert alert-warning'>This Brand name already exist</div>";
                    return $msg;
            }else{
                if ($brandName == '') {
                    $msg = "<div class='alert alert-warning'>Field must not be empty!</div>";
                    return $msg;
                }else{
                    $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$brandId'";
                    $update = $this->db->update($query);
                    if ($update) {
                        $msg = "<div class='alert alert-success'>Brand Updated Successfully!</div>";
                        return $msg;
                    }
                }
            }
        }

        // Get brand by ID
        public function getBrandById($brandId){
            $query = "SELECT * FROM tbl_brand WHERE brandId='$brandId'";
            $result = $this->db->select($query);
                return $result;
        }

        // Delete Brand from Database by id

        public function deleteBrand($delbrand){
            $query = "DELETE FROM tbl_brand WHERE brandId='$delbrand'";
            $delete = $this->db->delete($query);
            if ($delete) {
                 $msg = "<div class='alert alert-success'>Brand Deleted Successfully!</div>";
                return $msg;
            }
        }
    }