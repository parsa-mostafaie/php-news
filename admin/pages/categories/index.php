<?php $current_page = '/cat' ?>
<?php include '../../components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">دسته بندی ها</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="./create.php" class="btn btn-sm btn-dark">
        ایجاد دسته بندی
      </a>
    </div>
  </div>

  <!-- Categories -->
  <div class="mt-4">
    <div class="table-responsive small">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>id</th>
            <th>عنوان</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>1</th>
            <td>طبیعت</td>
            <td>
              <a href="./edit.php" class="btn btn-sm btn-outline-dark">ویرایش</a>
              <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
            </td>
          </tr>
          <tr>
            <th>2</th>
            <td>گردشگری</td>
            <td>
              <a href="./edit.php" class="btn btn-sm btn-outline-dark">ویرایش</a>
              <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
            </td>
          </tr>
          <tr>
            <th>3</th>
            <td>متفرقه</td>
            <td>
              <a href="./edit.php" class="btn btn-sm btn-outline-dark">ویرایش</a>
              <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>
<?php include '../../components/footer.php' ?>