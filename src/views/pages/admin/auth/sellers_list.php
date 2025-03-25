<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Chỉnh Sửa</th>
        </tr>
    </thead>
    <tbody id="list-user">
        <?php $counter = 1;
        foreach ($data["Sellers"] as $seller): ?>
            <tr>
                <td><?= $counter++; ?></td>
                <td class="searchable"><?= $seller["Full_Name"] ?> </td> <!-- Thêm class này -->
                <td ><?= $seller["Phone_Number"] ?></td>
                <td><?= $seller["Email"] ?></td>
                <td><?= $seller["Status_Name"] ?></td>
                <td>
                    <a href="<?= APP_PATH ?>/admin/user_detail/<?= $seller['User_id']; ?>" class="btn btn-primary me-2">
                        <i class="fa fa-pencil"></i> Chỉnh sửa
                    </a> 
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>