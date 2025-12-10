    <?php
    $title = 'داشبورد';
    include_once('resources/views/layouts/header.php');
    ?>
    <script src="<?= asset('lib/chart.js') ?>"></script>

    <!-- Start content -->
    <div class="content">

      <!-- start report -->
      <div class="report">
        <div class="report-item">
          <div class="report-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ltr:mr-2 rtl:ml-2 -mt-1 bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
            </svg>
          </div>
          <div class="report-text">
            <span>تعداد آیتم <div class="d-flex color-orange">22 آیتم</div></span>
          </div>
        </div>

        <div class="report-item">
          <div class="report-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ltr:mr-2 rtl:ml-2 -mt-1 bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
            </svg>
          </div>
          <div class="report-text">
            <span>تعداد ایتم<div class="d-flex color-orange">22 آیتم</div></span>
          </div>
        </div>
        <div class="report-item">
          <div class="report-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ltr:mr-2 rtl:ml-2 -mt-1 bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
            </svg>
          </div>
          <div class="report-text">
            <span>تعداد ایتم<div class="d-flex color-orange">22 آیتم</div></span>
          </div>
        </div>
        <div class="report-item">
          <div class="report-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="inline-block ltr:mr-2 rtl:ml-2 -mt-1 bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
            </svg>
          </div>
          <div class="report-text">
            <span>تعداد آیتم <div class="d-flex color-orange">22 آیتم</div> </span>
          </div>
        </div>
      </div>
      <!-- end report -->

      <div class="parent-dash-chart mmw mt20">
        <div class="dash-chart">
          <canvas id="myChart"></canvas>
        </div>
        <div class="dash-chart">
          <canvas id="myChart2"></canvas>
        </div>
      </div>

    </div>
    <!-- End content -->

    <script>
      const daysFa = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'];

      function getPersianDay(dateStr) {
        const date = new Date(dateStr);
        let dayNumber = date.getDay();
        dayNumber = (dayNumber + 1) % 7;
        return daysFa[dayNumber];
      }

      function createBarChart(canvasId, rawLabels, datasets) {
        const labels = rawLabels.map(getPersianDay);
        const ctx = document.getElementById(canvasId).getContext('2d');

        return new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: datasets
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      }

      const rawLabels = <?= json_encode(array_keys($data)) ?>;
      const dataValues = <?= json_encode(array_values($data)) ?>;
      createBarChart('myChart', rawLabels, [{
        label: 'تعداد نسخه‌ها',
        data: dataValues,
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1,
        maxBarThickness: 20
      }]);

      const rawDates = <?= json_encode($dates) ?>;
      const dataMale = <?= json_encode(array_values($dataMale)) ?>;
      const dataFemale = <?= json_encode(array_values($dataFemale)) ?>;
      createBarChart('myChart2', rawDates, [{
          label: 'آقایان',
          data: dataMale,
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          maxBarThickness: 20
        },
        {
          label: 'خانم‌ها',
          data: dataFemale,
          backgroundColor: 'rgba(255, 99, 132, 0.6)',
          maxBarThickness: 20
        }
      ]);
    </script>

    <?php include_once('resources/views/layouts/footer.php') ?>