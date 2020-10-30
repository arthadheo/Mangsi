<div class="container">
    <h3>Coba test</h3>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone Number</th>
                <th>Address</th>
            </tr>
            <?php
            if($fetch_data->num_rows() > 0)
            {
                foreach($fetch_data->result() as $row)
                {
                    ?>
                    <tr>
                        <td><?php echo $row->full_name; ?></td>
                        <td><?php echo $row->email_pelanggan; ?></td>
                        <td><?php echo $row->gender; ?></td>
                        <td><?php echo $row->birthdate; ?></td>
                        <td><?php echo $row->nomor_telepon_pelanggan; ?></td>
                        <td><?php echo $row->alamat_pelanggan; ?></td>
                    </tr>
                }
            }
            else 
            {
                ?>
                <tr>
                    <td colspan="6">No Data Found  </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>