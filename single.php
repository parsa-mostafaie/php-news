<?php include ('components/header.php') ?>
<!-- Content -->
<section class="mt-4">
  <div class="row">
    <!-- Posts & Comments Content -->
    <div class="col-lg-8">
      <div class="row justify-content-center">
        <!-- Post Section -->
        <div class="col">
          <div class="card">
            <img src="./assets/images/6.jpg" class="card-img-top" alt="post-image" />
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <h5 class="card-title fw-bold">لورم ایپسوم</h5>
                <div>
                  <span class="badge text-bg-secondary">طبیعت</span>
                </div>
              </div>
              <p class="card-text text-secondary text-justify pt-3">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون
                بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با
                هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت
                و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و
                متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را
                برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ
                پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید
                داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط
                سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی
                دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود
                طراحی اساسا مورد استفاده قرار گیرد.لورم ایپسوم متن
                ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود
                ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد
                گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می
                طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان
                رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان
                فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و
                دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان
                رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و
                جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد
                استفاده قرار گیرد.هدف بهبود
              </p>
              <div>
                <p class="fs-6 mt-5 mb-0">نویسنده : علی شیخ</p>
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-4" />

        <!-- Comment Section -->
        <div class="col">
          <!-- Comment Form -->
          <div class="card">
            <div class="card-body">
              <p class="fw-bold fs-5">ارسال کامنت</p>

              <form>
                <div class="mb-3">
                  <label class="form-label">نام</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="mb-3">
                  <label class="form-label">متن کامنت</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-dark">
                  ارسال
                </button>
              </form>
            </div>
          </div>

          <hr class="mt-4" />
          <!-- Comment Content -->
          <p class="fw-bold fs-6">تعداد کامنت : 3</p>

          <div class="card bg-light-subtle mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <img src="./assets/images/profile.png" width="45" height="45" alt="user-profle" />

                <h5 class="card-title me-2 mb-0">محمد صالحی</h5>
              </div>

              <p class="card-text pt-3 pr-3">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                چاپ و با استفاده از طراحان گرافیک است.
              </p>
            </div>
          </div>

          <div class="card bg-light-subtle mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <img src="./assets/images/profile.png" width="45" height="45" alt="user-profle" />

                <h5 class="card-title me-2 mb-0">متین سیدی</h5>
              </div>

              <p class="card-text pt-3 pr-3">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                چاپ
              </p>
            </div>
          </div>

          <div class="card bg-light-subtle mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <img src="./assets/images/profile.png" width="45" height="45" alt="user-profle" />

                <h5 class="card-title me-2 mb-0">زهرا عزیزی</h5>
              </div>

              <p class="card-text pt-3 pr-3">
                لورم ایپسوم متن ساختگی با تولید سادگی
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include ('components/sidebar.php') ?>
  </div>
</section>
<?php include ('components/footer.php') ?>