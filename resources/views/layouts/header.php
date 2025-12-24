<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= asset('public/assets/style/style.css') ?>" media="screen" />
  <link rel="stylesheet" href="<?= asset('public/assets/style/main.css') ?>" media="screen" />
  <link rel="stylesheet" href="<?= asset('public/assets/style/print.css') ?>" media="screen" />
  <link rel="stylesheet" href="<?= asset('public/assets/style/print.css') ?>" media="print" />
  <script src="<?= asset('public/assets/js/sweetAlert.js') ?>"></script>
  <script src="<?= asset('public/assets/js/jquery.min.js') ?>"></script>
  <link rel="icon" href="<?= asset('public/assets/img/fav.png') ?>">
  <link href="<?= asset('lib/datePicker/datePicker.min.css') ?>" rel="stylesheet" />

  <title><?= $title ?></title>
</head>

<body>
  <input type="text" id="menu-toggle" />
  <input type="text" id="left-menu-active" />

  <!-- start sidebar -->
  <div class="sidebar">
    <div class="sidebar-section">
      <div class="brand-name fs14">مدیریت شفاخانه <span class="color-orange fs18 bold">صــحـت‌یـــار</span></div>
      <div class="avatar">
        <!-- avatar photo -->
        <div class="img-avatar">
          <?php
          $defaultImage = asset('public/assets/img/profile.png');
          $image = $defaultImage;
          if (isset($_SESSION['hms_admin'])) {

            if (!empty($_SESSION['hms_admin']['image'])) {
              $image = asset('public/images/employees/' . $_SESSION['hms_admin']['image']);
            }
          } elseif (isset($_SESSION['hms_employee'])) {

            if (!empty($_SESSION['hms_employee']['image'])) {
              $image = asset('public/images/employees/' . $_SESSION['hms_employee']['image']);
            }
          }
          ?>
          <img src="<?= $image ?>" alt="Profile" />
        </div>
        <div class="info-avatar">
          <div class="text-avatar">
            <div>
              <?php
              if (isset($_SESSION['hms_admin'])) {
                echo $_SESSION['hms_admin']['name'];
              } else {
                echo $_SESSION['hms_employee']['name'];
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="sidebar-item">

        <ul>

          <!-- dashboard -->
          <li class="sidebar-menu">
            <a href="<?= url('/') ?>" class="d-flex align-center justify-between">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 16 16">
                  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                </svg>
                <span class="mr5">داشبورد</span>
              </span>
            </a>
          </li>

          <!-- prescriptions -->
          <?php if ($this->hasAccess('parentAdmission')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-6 2c0-2.67 3.33-4 6-4s6 1.33 6 4v1h-12v-1zm10-9h-2V5h-4v1H8V5H6v2h12V5z" />
                  </svg>
                  <span class="mr5">پذیرش</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('addAdmission')): ?>
                  <a href="<?= url('admission/create') ?>">
                    <li class="sidebar-dropdown-menu-item">پذیرش مریض</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('showAdmissions')): ?>
                  <a href="<?= url('admissions') ?>">
                    <li class="sidebar-dropdown-menu-item">لیست پذیرش‌ها</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <!-- prescriptions -->
          <?php if ($this->hasAccess('parentPrescription')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-6 2c0-2.67 3.33-4 6-4s6 1.33 6 4v1h-12v-1zm10-9h-2V5h-4v1H8V5H6v2h12V5z" />
                  </svg>
                  <span class="mr5">مدیریت نسخه‌ها</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('addPrescription')): ?>
                  <a href="<?= url('add-prescription') ?>">
                    <li class="sidebar-dropdown-menu-item">ثبت نسخه</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('showPrescription')): ?>
                  <a href="<?= url('prescriptions') ?>">
                    <li class="sidebar-dropdown-menu-item">نمایش نسخه‌ها</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <!-- departments -->
          <?php if ($this->hasAccess('parentDepartment')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-6 2c0-2.67 3.33-4 6-4s6 1.33 6 4v1h-12v-1zm10-9h-2V5h-4v1H8V5H6v2h12V5z" />
                  </svg>
                  <span class="mr5">مدیریت دپارتمنت‌ها</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('addDepartment')): ?>
                  <a href="<?= url('departments') ?>">
                    <li class="sidebar-dropdown-menu-item">دپارتمنت‌ها</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('showDepartment')): ?>
                  <a href="<?= url('departments') ?>">
                    <li class="sidebar-dropdown-menu-item">جزئیات دپارتمنت‌ها</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <!-- print -->
          <!-- <?php if ($this->hasAccess('prescriptionPrint')): ?>
            <li class="sidebar-menu">
              <a href="<?= url('prescription-print') ?>" class="d-flex align-center justify-between">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                  </svg>
                  <span class="mr5">چاپ خودکار نسخه‌ها</span>
                </span>
              </a>
            </li>
          <?php endif; ?> -->

          <!-- users -->
          <?php if ($this->hasAccess('parentPatients')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-6 2c0-2.67 3.33-4 6-4s6 1.33 6 4v1h-12v-1zm10-9h-2V5h-4v1H8V5H6v2h12V5z" />
                  </svg>
                  <span class="mr5">مدیریت مریضان</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('addPatient')): ?>
                  <a href="<?= url('add-user') ?>">
                    <li class="sidebar-dropdown-menu-item">ثبت مریض</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('showPatients')): ?>
                  <a href="<?= url('patients') ?>">
                    <li class="sidebar-dropdown-menu-item">نمایش مریضان</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <!-- employees -->
          <!-- <?php if ($this->hasAccess('parentEmployee')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-6 2c0-2.67 3.33-4 6-4s6 1.33 6 4v1h-12v-1zm10-9h-2V5h-4v1H8V5H6v2h12V5z" />
                  </svg>
                  <span class="mr5">کارمندان</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('addEmployee')): ?>
                  <a href="<?= url('add-employee') ?>">
                    <li class="sidebar-dropdown-menu-item">ثبت کارمند جدید</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('showEmployees')): ?>
                  <a href="<?= url('employees') ?>">
                    <li class="sidebar-dropdown-menu-item">نمایش کارمندان</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('positions')): ?>
                  <a href="<?= url('positions') ?>">
                    <li class="sidebar-dropdown-menu-item">مدیریت وظایف کارمندان</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?> -->

          <!-- Drug -->
          <?php if ($this->hasAccess('parentDrug')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-6 2c0-2.67 3.33-4 6-4s6 1.33 6 4v1h-12v-1zm10-9h-2V5h-4v1H8V5H6v2h12V5z" />
                  </svg>
                  <span class="mr5">مدیریت داروها</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('addDrug')): ?>
                  <a href="<?= url('add-drug') ?>">
                    <li class="sidebar-dropdown-menu-item">ثبت دارو</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('showDrugs')): ?>
                  <a href="<?= url('drugs') ?>">
                    <li class="sidebar-dropdown-menu-item">نمایش داروها</li>
                  </a>
                <?php endif; ?>

                <?php if ($this->hasAccess('catDrug')): ?>
                  <a href="<?= url('drug-categories') ?>">
                    <li class="sidebar-dropdown-menu-item">مدیریت دسته بندی‌ها</li>
                  </a>
                <?php endif; ?>
                <?php if ($this->hasAccess('unitDrug')): ?>
                  <a href="<?= url('units') ?>">
                    <li class="sidebar-dropdown-menu-item">واحدهای شمارش</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <!-- manage sections -->
          <?php if ($this->hasAccess('parentSetting')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                  </svg>
                  <span class="mr5">مدیریت بخش‌ها</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('numberDrugs')): ?>
                  <a href="<?= url('number-drugs') ?>">
                    <li class="sidebar-dropdown-menu-item">تنظیمات تعداد دارو</li>
                  </a>
                <?php endif; ?>
                <?php if ($this->hasAccess('intakeTime')): ?>
                  <a href="<?= url('intake-times') ?>">
                    <li class="sidebar-dropdown-menu-item">مدیریت زمان مصرف</li>
                  </a>
                <?php endif; ?>
                <?php if ($this->hasAccess('dosage')): ?>
                  <a href="<?= url('dosage') ?>">
                    <li class="sidebar-dropdown-menu-item">مدیریت مقدار مصرف</li>
                  </a>
                <?php endif; ?>
                <?php if ($this->hasAccess('intakeInstructions')): ?>
                  <a href="<?= url('intake-instructions') ?>">
                    <li class="sidebar-dropdown-menu-item">مدیریت طریقه مصرف</li>
                  </a>
                <?php endif; ?>
                <?php if ($this->hasAccess('tests')): ?>
                  <a href="<?= url('tests') ?>">
                    <li class="sidebar-dropdown-menu-item">مدیریت آزمایشات</li>
                  </a>
                <?php endif; ?>
                <?php if ($this->hasAccess('prescriptionSettings')): ?>
                  <a href="<?= url('prescription-settings') ?>">
                    <li class="sidebar-dropdown-menu-item">تنظیمات نسخه</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <!-- settings -->
          <!-- <?php if ($this->hasAccess('parentDrug')): ?>
            <li class="sidebar-menu ri-dashboard-line sidebar-menu-item has-dropdown">
              <a href="#" class="d-flex align-center justify-between dddd">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-6 2c0-2.67 3.33-4 6-4s6 1.33 6 4v1h-12v-1zm10-9h-2V5h-4v1H8V5H6v2h12V5z" />
                  </svg>
                  <span class="mr5">تنظیمات</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w14 sidebar-arrow" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
              </a>
              <ul class="sidebar-dropdown-menu">
                <?php if ($this->hasAccess('addDrug')): ?>
                  <a href="<?= url('pre-print-settings') ?>">
                    <li class="sidebar-dropdown-menu-item">تنظیمات چاپ و نسخه</li>
                  </a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?> -->

          <!-- profile -->
          <li class="sidebar-menu">
            <a href="<?= url('profile') ?>" class="d-flex align-center justify-between">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 16 16">
                  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                </svg>
                <span class="mr5">تنظیمات حساب</span>
              </span>
            </a>
          </li>

          <!-- exit -->
          <li class="sidebar-menu">
            <a href="<?= url('logout') ?>" class="d-flex align-center justify-between">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w17" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg>
                <span class="mr5">خروج</span>
              </span>
            </a>
          </li>

        </ul>
      </div>
    </div>
  </div>
  <!-- end sidebar -->

  <!-- start appbar  -->
  <div class="d-flex justify-between align-center appbar">
    <div class="d-flex align-center">
      <!-- humber icon -->
      <span class="hamber cursor-p">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w20 ml-10" viewBox="0 0 16 16">
          <path d="M2.5 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1h-11zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6zm0 3a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6zm0 3a.5.5 0 0 0 0 1h11a.5.5 0 0 0 0-1h-11zm10.113-5.373a6.59 6.59 0 0 0-.445-.275l.21-.352c.122.074.272.17.452.287.18.117.35.26.51.428.156.164.289.351.398.562.11.207.164.438.164.692 0 .36-.072.65-.216.873-.145.219-.385.328-.721.328-.215 0-.383-.07-.504-.211a.697.697 0 0 1-.188-.463c0-.23.07-.404.211-.521.137-.121.326-.182.569-.182h.281a1.686 1.686 0 0 0-.123-.498 1.379 1.379 0 0 0-.252-.37 1.94 1.94 0 0 0-.346-.298zm-2.168 0A6.59 6.59 0 0 0 10 6.352L10.21 6c.122.074.272.17.452.287.18.117.35.26.51.428.156.164.289.351.398.562.11.207.164.438.164.692 0 .36-.072.65-.216.873-.145.219-.385.328-.721.328-.215 0-.383-.07-.504-.211a.697.697 0 0 1-.188-.463c0-.23.07-.404.211-.521.137-.121.327-.182.569-.182h.281a1.749 1.749 0 0 0-.117-.492 1.402 1.402 0 0 0-.258-.375 1.94 1.94 0 0 0-.346-.3z"></path>
        </svg>
      </span>

      <!-- search box -->
      <div class="d-flex border appbar-search">
        <form action="">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-10 search-icon w17">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" class="p5 fs15 input" placeholder="search..." />
        </form>
      </div>
    </div>

    <div class="w60 d-flex justify-between ml-20">


      <!-- setting icon -->
      <span class="temp-settings cursor-p">
        <svg x-description="Icon closed" x-state:on="Menu open" x-state:off="Menu closed" class="w20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"></path>
          <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"></path>
        </svg>
      </span>

    </div>
  </div>
  <!-- end appbar -->

  <!-- left sidebar -->
  <div class="setting">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="closeLeftMenu w17 cursor-p" viewBox="0 0 16 16" id="x-lg">
      <path d="M1.293 1.293a1 1 0 011.414 0L8 6.586l5.293-5.293a1 1 0 111.414 1.414L9.414 8l5.293 5.293a1 1 0 01-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 01-1.414-1.414L6.586 8 1.293 2.707a1 1 0 010-1.414z"></path>
    </svg>
    <div class="center">settings</div>
    <div class="mode">
      <label class="switch">
        <input type="checkbox" onclick="toggleDarkMode()" />
        <span class="slider"></span>
      </label>
      <span>تغییر تم</span>
    </div>
  </div>
  <br />
  <br />
  <br />