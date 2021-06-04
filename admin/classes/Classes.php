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

        // Select all Brand
        public function getAllBrand(){
            $query  = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $select = $this->db->select($query);
            return $select;
        }

    } 
    /* ===========End of brand class ====================*/

    class Category{

        private $db;
        private $fm;

        function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        // Select all categories
        public function getAllCat(){
            $query  = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $select = $this->db->select($query);
            return $select;
        }
    }
    /* ===========End of category class ====================*/

    class Product{

        private $db;
        private $fm;

        function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        // Adding product into database
        public function addProduct($data, $file){

            $productName = $this->fm->validation($data['productName']);
            $catId       = $this->fm->validation($data['catId']);
            $brandId     = $this->fm->validation($data['brandId']);
            $price       = $this->fm->validation($data['price']);
            $type        = $this->fm->validation($data['type']);
            $body        = $data['body'];

            $productName = mysqli_real_escape_string($this->db->link, $productName);
            $catId       = mysqli_real_escape_string($this->db->link, $catId);
            $brandId     = mysqli_real_escape_string($this->db->link, $brandId);
            $price       = mysqli_real_escape_string($this->db->link, $price);
            $type        = mysqli_real_escape_string($this->db->link, $type);
            $body        = mysqli_real_escape_string($this->db->link, $body);

            $permitted   = array('jpg','png','jpeg','gif');
            $fileName    = $file['image']['name'];
            $fileSize    = $file['image']['size'];
            $file_temp   = $file['image']['tmp_name'];

            $div         = explode('.', $fileName);
            $file_ext    = strtolower(end($div));
            $unique_image= substr(md5(time()), 0, 20).'.'.$file_ext;
            $uploaded_img= "upload/".$unique_image;

            if ($productName == "" || $catId =="" || $brandId == "" || $price == "" || $type == "" || $body == '' || $fileName == "") {
                 $msg = "<div class='alert alert-warning'>Field must not be empty!</div>";
                    return $msg;
            }elseif (in_array($file_ext, $permitted) == false) {
                $msg = "<div class='alert alert-warning'>Image extenstion must be JPG,PNG,JPEG,GIF!</div>";
                    return $msg;
            }elseif ($fileSize > 1048567) {
               $msg = "<div class='alert alert-warning'>Image size must be less than 1MB!</div>";
                    return $msg;
            }else{
                move_uploaded_file($file_temp, $uploaded_img);
                $query = "INSERT INTO tbl_shop
                (productName,catId,brandId,body,price,image,type)
                VALUES
                ('$productName','$catId','$brandId','$body','$price','$uploaded_img','$type')";
                $insertProduct = $this->db->insert($query);
                if ($insertProduct) {
                    $msg = "<div class='alert alert-success'>Product Inserted Successfully!</div>";
                    return $msg;
                }else{
                     $msg = "<div class='alert alert-warning'>Product not inserted Successfully!</div>";
                    return $msg;
                }
            }
        }

        // Select products
        public function getProduct(){

            // Using Aliases
            $query = "SELECT p.*, c.catName, b.brandName 
            FROM tbl_shop as p, tbl_category as c, tbl_brand as b
            WHERE p.catId = c.catId AND p.brandId = b.brandId 
            ORDER BY p.productId DESC";

            /* Simple sql join */
            // $query = "SELECT tbl_shop.*,tbl_category.catName,tbl_brand.brandName 
            // FROM tbl_shop 
            // INNER JOIN tbl_category 
            // ON tbl_shop.catId = tbl_category.catId
            // INNER JOIN tbl_brand
            // ON tbl_shop.brandId = tbl_brand.brandId 
            // ORDER BY tbl_shop.productId DESC";

            $select = $this->db->select($query);
            return $select;
        }

        // Getting product by ID
        public function getProductByID($productID){
            $query = "SELECT * FROM tbl_shop WHERE productId='$productID'";
            $select = $this->db->select($query);
            return $select;
        }

        // Updating product
        public function productUpdate($data, $productID, $file){
            $productName = $this->fm->validation($data['productName']);
            $catId = $this->fm->validation($data['catId']);
            $brandId = $this->fm->validation($data['brandId']);
            $body = $this->fm->validation($data['body']);
            $price = $this->fm->validation($data['price']);
            $type = $this->fm->validation($data['type']);

            $fileName = $file['image']['name'];
            $file_temp = $file['image']['tmp_name'];
            $permitted = array('jpg','png','jpeg','gif');
            $div = explode('.', $fileName);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 20).".".$file_ext;
            $uploaded_img = "upload/".$unique_image;
            
            $productName = mysqli_real_escape_string($this->db->link, $productName);
            $catId  = mysqli_real_escape_string($this->db->link, $catId);
            $brandId = mysqli_real_escape_string($this->db->link, $brandId);
            $body = mysqli_real_escape_string($this->db->link, $body);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $type = mysqli_real_escape_string($this->db->link, $type);


            if (!empty($productName) && !empty($catId) && !empty($brandId) && !empty($body) && !empty($price)) {
               if ($fileName == '') {
                  
                  $query ="UPDATE tbl_shop
                          SET
                          productName = '$productName',
                          catId       = '$catId',
                          brandId     = '$brandId',
                          body        = '$body',
                          price       = '$price',
                          type        = '$type' WHERE productId = '$productID' ";

                  $update     = $this->db->update($query);
                  if ($update) {
                      $msg = "<div class='alert alert-success'>Product Updated Successfully!</div>";
                      return $msg;
                  }else{
                     $msg = "<div class='alert alert-warning'>Product not Updated Successfully!</div>";
                      return $msg;
                  }

               }else{

                  $selectExist = "SELECT image FROM tbl_shop WHERE productId='$productID'";
                  $result = $this->db->select($selectExist);
                  $checkImage = $result->fetch_assoc();
                  
                  if ($checkImage != false) {
                   unlink($checkImage['image']);
                  }

                  // Uploading new image
                  move_uploaded_file($file_temp, $uploaded_img);

                  $query ="UPDATE tbl_shop
                          SET
                          productName = '$productName',
                          catId       = '$catId',
                          brandId     = '$brandId',
                          body        = '$body',
                          price       = '$price',
                          image       = '$uploaded_img',
                          type        = '$type' WHERE productId = '$productID' ";

                  $update     = $this->db->update($query);
                  if ($update) {
                      $msg = "<div class='alert alert-success'>Product Updated Successfully!</div>";
                      return $msg;
                  }else{
                     $msg = "<div class='alert alert-warning'>Product not Updated Successfully!</div>";
                      return $msg;
                  }
               }
            }else{
                $msg = "<div class='alert alert-warning'>Fields Must not be empty!</div>";
                return $msg;
            }
        }

        // delete product by id

        public function deleteProductByID($deleteId){

            // Delete image from database and root folder
            $selectExist = "SELECT image FROM tbl_shop WHERE productId='$deleteId'";
            $result = $this->db->select($selectExist);
            $checkImage = $result->fetch_assoc();
            if ($checkImage) {
              unlink($checkImage['image']);
            }

            $query = "DELETE FROM tbl_shop WHERE productId = '$deleteId'";
            $delete = $this->db->delete($query);
            if ($delete) {
               $msg = "<div class='alert alert-success'>Product Deleted Successfully!</div>";
                return $msg;
            }
        }

        // Getting featured product

        public function getFproduct(){
          
        }



    } /* ===========End of Product class ====================*/