<?php $current_page = '/posts' ?>
<?php include '../../components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">ویرایش مقاله</h1>
  </div>

  <!-- Posts -->
  <div class="mt-4">
    <form class="row g-4">
      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">عنوان مقاله</label>
        <input type="text" class="form-control" value="لورم ایپسوم" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">نویسنده مقاله</label>
        <input type="text" class="form-control" value="علی شیخ" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">دسته بندی مقاله</label>
        <select class="form-select">
          <option value="1">طبیعت</option>
          <option value="2">گردشگری</option>
          <option value="3">تکنولوژی</option>
          <option value="4">متفرقه</option>
        </select>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label for="formFile" class="form-label">تصویر مقاله</label>
        <input class="form-control" type="file" />
      </div>

      <div class="col-12">
        <label for="formFile" class="form-label">متن مقاله</label>
        <textarea class="form-control" rows="8">
لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            </textarea>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <img class="rounded" src="../../assets/images/1.jpg" width="300" />
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-dark">ویرایش</button>
      </div>
    </form>
  </div>
</main>
<?php include '../../components/footer.php' ?>