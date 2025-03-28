<!-- Button trigger modal -->
<div class="d-flex mb-3">
    <input type="text" id="searchInput" class="form-control me-2" placeholder="Tìm kiếm tác giả...">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        style="white-space: nowrap;">
        THÊM TÁC GIẢ
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Tác Giả</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">
                            Thêm thủ công
                        </button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                            Thêm từ file
                        </button>
                    </div>
                </nav>
                <div class="tab-content mt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <form class="row g-3 needs-validation" method="POST" action="" novalidate
                            enctype="multipart/form-data">
                            <!-- Trường Tên tác giả -->
                            <div class="col-md-6">
                                <label class="form-label fs-6"><strong>Tên tác giả*</strong></label>
                                <input type="text" class="form-control" name="author_name" id="author_name"
                                    placeholder="Nhập tên tác giả" required>
                                <div class="invalid-feedback">
                                    Tên tác giả không được bỏ trống.
                                </div>
                            </div>

                            <!-- Trường Quốc tịch -->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Quốc tịch</strong></label>
                                <select class="form-control select2" name="nationality" id="nationality" required>
                                    <option value="">Chọn quốc tịch</option>
                                    <?php foreach ($data["Nationality"] as $nation): ?>
                                        <option value="<?= $nation['id'] ?>"><?= $nation['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Quốc tịch không được bỏ trống.</div>
                            </div>

                            <!-- Trường Ngày sinh -->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Ngày sinh</strong></label>
                                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                    required>
                                <div class="invalid-feedback">
                                    Ngày sinh không được bỏ trống.
                                </div>
                            </div>

                            <!-- Trường Hình ảnh tác giả -->
                            <div class="col-md-6">
                                <label class="form-label"><strong>Hình ảnh tác giả</strong></label>
                                <input type="file" class="form-control" name="author_image" id="author_image"
                                    accept="image/*" required>
                                <div class="invalid-feedback">
                                    Vui lòng chọn hình ảnh tác giả.
                                </div>
                            </div>

                            <!-- Trường Tiểu sử -->
                            <div class="col-md-12">
                                <label class="form-label"><strong>Tiểu sử</strong></label>
                                <textarea class="form-control" name="biography" id="biography" rows="4"
                                    placeholder="Nhập tiểu sử của tác giả" required></textarea>
                                <div class="invalid-feedback">
                                    Tiểu sử không được bỏ trống.
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" class="btn btn-primary" name="addAuthor" value="Thêm Tác Giả">
                                    Thêm Tác Giả
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Tab thêm từ file -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Table-->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="col">ID</th>
            <th scope="col" class="col">Hình ảnh</th>
            <th scope="col" class="col">Tác giả</th>
            <th scope="col" class="col-3">Tiểu sử của tác giả</th>
            <th scope="col" class="col">Năm sinh</th>
            <th scope="col" class="col">Quốc tịch</th>
            <th scope="col" class="col">Số lượng sách</th>
            <th scope="col" class="col">Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody id="bookTable">
        <?php $counter = 1;
        foreach ($data["Authors"] as $authors): ?>
            <tr>
                <td><?= $counter++; ?></td>
                <td>
                    <img src="<?php echo $this->image_author($authors["Img_Author"]); ?>" alt="<?= $authors["Name"] ?>"
                        width="100" height="100">
                </td>
                <td><?= $authors["Name"] ?> </td>
                <td>
                    <?php
                    $bio = htmlspecialchars_decode($authors["Biography"]); // Chuyển HTML Entities thành ký tự thường
                
                    $maxLength = 80;
                    if (mb_strlen($bio, 'UTF-8') > $maxLength) {
                        $shortBio = mb_substr($bio, 0, mb_strrpos(mb_substr($bio, 0, $maxLength, 'UTF-8'), ' '), 'UTF-8') . '...';
                    } else {
                        $shortBio = $bio;
                    }
                    echo $shortBio;
                    ?>
                </td>
                <td><?= date("d/m/Y", strtotime($authors["Date_of_Birth"])) ?></td>
                <td> <?= $authors["Nationality"] ?></td>
                <td class="text-center">
                    <?= $authors["book_count"] ?>
                </td>
                <td>
                    <div class="d-flex align-items-center" style="white-space: nowrap;">
                        <a href="<?= APP_PATH ?>/admin/author_detail/<?= $authors["Author_id"]; ?>"
                            class="btn btn-primary d-flex justify-content-center align-items-center">
                            <i class="fa fa-pencil me-2"></i> Chỉnh sửa
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>