<!-- Sidebar Section -->
<div class="col-lg-4 mt-3">
  <!-- Sesrch Section -->
  <div class="card">
    <div class="card-body">
      <p class="fw-bold fs-6">جستجو در وبلاگ</p>
      <form action="<?= c_url('/search.php') ?>" method='get'>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name='search' placeholder="جستجو ..."
            value="<?= $_GET['search'] ?? '' ?>" />
          <button class="btn btn-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Categories Section -->
  <div class="card mt-4">
    <div class="fw-bold fs-6 card-header">دسته بندی ها</div>
    <?php categories_list() ?>
  </div>

  <!-- Subscribue Section -->
  <div class="card mt-4">
    <div class="card-body">
      <p class="fw-bold fs-6">عضویت در خبرنامه</p>

      <form action='<?= c_url("/auth/signup.html") ?>' method="get">
        <div class="mb-3">
          <label class="form-label">نام</label>
          <input type="text" class="form-control" name="name" id='username' autocomplete='username' />
        </div>
        <div class="mb-3">
          <label class="form-label">ایمیل</label>
          <input type="email" class="form-control" name="mail" id="email" autocomplete='email' />
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-secondary">
            ارسال
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- About Section -->
  <div class="card mt-4">
    <div class="card-body">
      <p class="fw-bold fs-6">درباره ما</p>
      <p class="text-justify">
        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
        با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه
        و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
        تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
        کاربردی می باشد.
      </p>
    </div>
  </div>
</div>