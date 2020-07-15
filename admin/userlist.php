<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>

        <?php
        if (isset($_GET['userId'])) {
            $delId = $_GET['userId'];
            $deleteQuery = "delete from tbl_user where id='$delId' ";
            $delData = $db->delete($deleteQuery);
            if ($delData) {

                echo "<span class='success'>User Deletd Successfully   !</span>";
            } else {
                echo "<span class='error'>User Not Deleted !! try again  !</span>";
            }
        }

        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th> Name</th>
                        <th> Username</th>
                        <th> Email</th>
                        <th> Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_user ";
                    $userList = $db->select($query);
                    if ($userList) {
                        $i = 0;
                        while ($result = $userList->fetch_assoc()) {
                            $i++;
                    ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['username']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $format->textShorten($result['details'], 40); ?></td>
                                <td>
                                    <?php
                                    if ($result['role'] == 0) {
                                        echo "ADMIN";
                                    } elseif ($result['role'] == 1) {
                                        echo "AUTHOR";
                                    } elseif ($result['role'] == 2) {
                                        echo "EDITOR";
                                    } else {
                                        echo "no Role";
                                    }

                                    ?>
                                </td>
                                <td>
                                    <a href="userdetails.php?userid=<?php echo $result['id']; ?>">View</a> 
                                    <?php
                                    if (Session::get('userRole') == '0') {
                                    ?>
                                       || <a onclick="return confirm('Are you sure to delete !!')" href="?userId=<?php echo $result['id']; ?>">Delete</a>
                                    <?php } ?>
                                    

                                </td>
                            </tr>

                    <?php }
                    } ?>
                </tbody>



            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>

<?php include 'inc/footer.php'; ?>